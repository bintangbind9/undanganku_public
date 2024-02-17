@extends('layouts.master')
@section('title','Order')
@push('pages-style')
<style>
  .cursor-pointer {cursor: pointer;}
  @media only screen and (
    /* max-width : 480px */
    max-width : 522px
    ) {
    #order-tab {
        height: 88px;
        overflow: auto;
    }
  }
  @media only screen and (
    max-width : 575px
    ) {
    .display-none-max-width-575 {
        display: none;
    }
  }
  @media only screen and (
    min-width : 576px
    ) {
    .display-none-min-width-576 {
        display: none;
    }
  }
  @media only screen and (
    max-width : 660px
    ) {
    .display-none-max-width-660 {
        display: none;
    }
  }
</style>
@endpush

@section('content')
    @if (session('message')) 
    <div class="alert alert-success alert-dismissible show fade">
      <div class="alert-body">
        <button class="close" data-dismiss="alert">
          <span>×</span>
        </button>
        {{session('message')}}
      </div>
    </div>
    @endif

    @if (session('warning')) 
    <div class="alert alert-warning alert-dismissible show fade">
      <div class="alert-body">
        <button class="close" data-dismiss="alert">
          <span>×</span>
        </button>
        {{session('warning')}}
      </div>
    </div>
    @endif

    @if (session('fail')) 
    <div class="alert alert-danger alert-dismissible show fade">
      <div class="alert-body">
        <button class="close" data-dismiss="alert">
          <span>×</span>
        </button>
        {{session('fail')}}
      </div>
    </div>
    @endif

    <div class="section-body">
        <h2 class="section-title">Pesanan Saya</h2>
        <div class="card">
          <div class="card-body">
            <ul class="nav nav-pills mb-4" id="order-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link {{session('tab') == 'notyetpaid' ? 'active' : null}}" id="notyetpaid-tab" data-toggle="tab" href="#notyetpaid" role="tab" aria-controls="notyetpaid" aria-selected="true"><i class="fas fa-wallet"></i> Belum Bayar @if (count($notyetpaids) > 0) <span class="badge badge-light">{{count($notyetpaids)}}</span> @endif</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{session('tab') == 'lesspaid' ? 'active' : null}}" id="lesspaid-tab" data-toggle="tab" href="#lesspaid" role="tab" aria-controls="lesspaid" aria-selected="false"><i class="fas fa-coins"></i> Kurang Bayar @if (count($lesspaids) > 0) <span class="badge badge-light">{{count($lesspaids)}}</span> @endif</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{session('tab') == 'confirmation' ? 'active' : null}}" id="confirmation-tab" data-toggle="tab" href="#confirmation" role="tab" aria-controls="confirmation" aria-selected="false"><i class="fas fa-question"></i> Konfirmasi @if (count($waiting_to_be_confirmeds) > 0) <span class="badge badge-light">{{count($waiting_to_be_confirmeds)}}</span> @endif</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{session('tab') == 'active' ? 'active' : null}}" id="active-tab" data-toggle="tab" href="#active" role="tab" aria-controls="active" aria-selected="false"><i class="fas fa-check"></i> Aktif @if (count($activateds) > 0) <span class="badge badge-light">{{count($activateds)}}</span> @endif</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{session('tab') == 'expired' ? 'active' : null}}" id="expired-tab" data-toggle="tab" href="#expired" role="tab" aria-controls="expired" aria-selected="false"><i class="fas fa-hourglass-end"></i> Kedaluwarsa @if (count($expireds) > 0) <span class="badge badge-light">{{count($expireds)}}</span> @endif</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{session('tab') == 'cancel' ? 'active' : null}}" id="cancel-tab" data-toggle="tab" href="#cancel" role="tab" aria-controls="cancel" aria-selected="false"><i class="fas fa-times"></i> Batal @if (count($canceleds) > 0) <span class="badge badge-light">{{count($canceleds)}}</span> @endif</a>
              </li>
            </ul>
            <div class="tab-content" id="content-tab">
              <div class="tab-pane fade {{session('tab') == 'notyetpaid' ? 'show active' : null}}" id="notyetpaid" role="tabpanel" aria-labelledby="notyetpaid-tab">
                @if ($notyetpaids->count() > 0)
                  <ul class="list-unstyled user-progress list-unstyled-border list-unstyled-noborder" style="overflow:auto;">
                    @foreach ($notyetpaids as $nyp_no => $nyp)
                    <li class="media">
                      <img alt="{{$nyp->invoice_type->invoice_level->name}}" class="mr-3 rounded-circle" width="50" src="{{asset('assets/img/levels/'.$nyp->invoice_type->invoice_level->image)}}">
                      <div class="media-body">
                        <div class="media-title">{{$nyp->invoice_type->name}} ({{$nyp->invoice_type->expired_day}} hari)</div>
                        <div class="media-title">{{ $nyp->invoice_type->amount == 0 ? 'Gratis' : 'Rp ' . number_format($nyp->invoice_type->amount, 2, ',', '.') }}</div>
                        <div class="text-job">{{$nyp->code}}</div>
                        <div class="text-job">{{ Carbon\Carbon::parse($nyp->created_at)->format('d-M-Y H:i:s') }}</div>
                      </div>
                      <div class="media-progressbar ml-3 display-none-max-width-660 {{$nyp->invoice_type->amount == 0 ? 'd-none' : null}}">
                        <div class="text-job text-muted">Metode Pembayaran</div>
                        <div class="media">
                          <img alt="{{$nyp->bank_account->bank_master->name}}" class="mr-3" width="70" src="{{asset('assets/img/banks/'.$nyp->bank_account->bank_master->image)}}">
                          <div class="media-body">
                            <div class="media-title">{{$nyp->bank_account->bank_master->name}}</div>
                            <div class="media-title">{{$nyp->bank_account->number}} ({{$nyp->bank_account->currency->code}})</div>
                            <div class="text-job">{{$nyp->bank_account->name}}</div>
                          </div>
                        </div>
                      </div>
                      <div class="media-progressbar ml-3 display-none-max-width-575">
                        <div class="text-job text-muted {{$nyp->invoice_type->amount == 0 ? 'd-none' : null}}">Dibayar</div>
                        <div class="media-title {{$nyp->invoice_type->amount == 0 ? 'd-none' : null}}">{{number_format($nyp->amount, 2, ',', '.')}} {{$nyp->bank_account->currency->code}}</div>
                        <div class="text-job text-muted">Kedaluwarsa</div>
                        <div id="exp-{{$nyp->code}}-1" class="media-title exp-countdown" data-expired="{{$nyp->expired}}">{{ Carbon\Carbon::parse($nyp->expired)->format('d-M-Y H:i:s') }}</div>
                      </div>
                      <div class="media-cta">
                        <span class="btn btn-outline-primary" data-url="{{route('order.show',$nyp->id)}}" onclick="$('#viewInvoiceContent').empty(); $('#viewInvoiceContent').load($(this).data('url')); $('#viewInvoiceModal').modal('show');">Detail</span>
                        <a href="{{route('order.edit',$nyp->id)}}" class="btn btn-primary">Bayar</a>
                      </div>
                    </li>
                    @endforeach
                  </ul>
                @else
                  <h4 class="text-center">Tidak ada data</h4>
                @endif
              </div>
              <div class="tab-pane fade {{session('tab') == 'lesspaid' ? 'show active' : null}}" id="lesspaid" role="tabpanel" aria-labelledby="lesspaid-tab">
                @if ($lesspaids->count() > 0)
                  <ul class="list-unstyled user-progress list-unstyled-border list-unstyled-noborder" style="overflow:auto;">
                    @foreach ($lesspaids as $lp_no => $lp)
                    <li class="media">
                      <img alt="{{$lp->invoice_type->invoice_level->name}}" class="mr-3 rounded-circle" width="50" src="{{asset('assets/img/levels/'.$lp->invoice_type->invoice_level->image)}}">
                      <div class="media-body">
                        <div class="media-title">{{$lp->invoice_type->name}} ({{$lp->invoice_type->expired_day}} hari)</div>
                        <div class="media-title">{{ $lp->invoice_type->amount == 0 ? 'Gratis' : 'Rp ' . number_format($lp->invoice_type->amount, 2, ',', '.') }}</div>
                        <div class="text-job">{{$lp->code}}</div>
                        <div class="text-job">{{ Carbon\Carbon::parse($lp->created_at)->format('d-M-Y H:i:s') }}</div>
                      </div>
                      <div class="media-progressbar ml-3 display-none-max-width-660 {{$lp->invoice_type->amount == 0 ? 'd-none' : null}}">
                        <div class="text-job text-muted">Metode Pembayaran</div>
                        <div class="media">
                          <img alt="{{$lp->bank_account->bank_master->name}}" class="mr-3" width="70" src="{{asset('assets/img/banks/'.$lp->bank_account->bank_master->image)}}">
                          <div class="media-body">
                            <div class="media-title">{{$lp->bank_account->bank_master->name}}</div>
                            <div class="media-title">{{$lp->bank_account->number}} ({{$lp->bank_account->currency->code}})</div>
                            <div class="text-job">{{$lp->bank_account->name}}</div>
                          </div>
                        </div>
                      </div>
                      <div class="media-progressbar ml-3 display-none-max-width-575">
                        <div class="text-job text-muted {{$lp->invoice_type->amount == 0 ? 'd-none' : null}}">Dibayar</div>
                        <div class="media-title {{$lp->invoice_type->amount == 0 ? 'd-none' : null}}">{{number_format($lp->amount, 2, ',', '.')}} {{$lp->bank_account->currency->code}}</div>
                        <div class="text-job text-muted">Kedaluwarsa</div>
                        <div id="exp-{{$lp->code}}-1" class="media-title exp-countdown" data-expired="{{$lp->expired}}">{{ Carbon\Carbon::parse($lp->expired)->format('d-M-Y H:i:s') }}</div>
                      </div>
                      <div class="media-cta">
                        <span class="btn btn-outline-primary" data-url="{{route('order.show',$lp->id)}}" onclick="$('#viewInvoiceContent').empty(); $('#viewInvoiceContent').load($(this).data('url')); $('#viewInvoiceModal').modal('show');">Detail</span>
                        <a href="{{route('order.edit',$lp->id)}}" class="btn btn-primary">Bayar</a>
                      </div>
                    </li>
                    @endforeach
                  </ul>
                @else
                  <h4 class="text-center">Tidak ada data</h4>
                @endif
              </div>
              <div class="tab-pane fade {{session('tab') == 'confirmation' ? 'show active' : null}}" id="confirmation" role="tabpanel" aria-labelledby="confirmation-tab">
                @if ($waiting_to_be_confirmeds->count() > 0)
                  <ul class="list-unstyled user-progress list-unstyled-border list-unstyled-noborder" style="overflow:auto;">
                    @foreach ($waiting_to_be_confirmeds as $wtc_no => $wtc)
                    <li class="media">
                      <img alt="{{$wtc->invoice->invoice_type->invoice_level->name}}" class="mr-3 rounded-circle" width="50" src="{{asset('assets/img/levels/'.$wtc->invoice->invoice_type->invoice_level->image)}}">
                      <div class="media-body">
                        <div class="media-title">{{$wtc->invoice->invoice_type->name}} ({{$wtc->invoice->invoice_type->expired_day}} hari)</div>
                        <div class="media-title">{{ $wtc->invoice->invoice_type->amount == 0 ? 'Gratis' : 'Rp ' . number_format($wtc->invoice->invoice_type->amount, 2, ',', '.') }}</div>
                        <div class="text-job">{{$wtc->invoice->code}}</div>
                        <div class="text-job">{{ Carbon\Carbon::parse($wtc->invoice->created_at)->format('d-M-Y H:i:s') }}</div>
                        {{-- COPY --}}
                        <div class="display-none-min-width-576">
                          <div class="text-job text-muted">Dibayar Tanggal</div>
                          <div class="text-job">{{ Carbon\Carbon::parse($wtc->date)->format('d-M-Y H:i:s') }}</div>
                          <div class="text-job text-muted">Lampiran</div>
                          @if (pathinfo($wtc->attachment, PATHINFO_EXTENSION) == 'pdf')
                          <a href="{{asset('assets/img/wedding/attachment/'.$wtc->attachment)}}" target="_blank">PDF File</a>
                          @else
                          <div class="text-job"><img src="{{asset('assets/img/wedding/attachment/'.$wtc->attachment)}}" height="20px" onclick="$('#viewPictImage').attr('src',$(this).attr('src')); $('#viewPictModal').modal('show');" style="cursor: pointer"></div>
                          @endif
                        </div>
                        {{-- END COPY --}}
                      </div>
                      <div class="media-progressbar ml-3 display-none-max-width-660 {{$wtc->invoice->invoice_type->amount == 0 ? 'd-none' : null}}">
                        <div class="text-job text-muted">Metode Pembayaran</div>
                        <div class="media">
                          <img alt="{{$wtc->invoice->bank_account->bank_master->name}}" class="mr-3" width="70" src="{{asset('assets/img/banks/'.$wtc->invoice->bank_account->bank_master->image)}}">
                          <div class="media-body">
                            <div class="media-title">{{$wtc->invoice->bank_account->bank_master->name}}</div>
                            <div class="media-title">{{$wtc->invoice->bank_account->number}} ({{$wtc->invoice->bank_account->currency->code}})</div>
                            <div class="text-job">{{$wtc->invoice->bank_account->name}}</div>
                          </div>
                        </div>
                      </div>
                      <div class="media-progressbar ml-3 display-none-max-width-575">
                        <div class="text-job text-muted">Dibayar Tanggal</div>
                        <div class="media-title">{{ Carbon\Carbon::parse($wtc->date)->format('d-M-Y H:i:s') }}</div>
                        <div class="text-job text-muted">Lampiran</div>
                        @if (pathinfo($wtc->attachment, PATHINFO_EXTENSION) == 'pdf')
                        <a href="{{asset('assets/img/wedding/attachment/'.$wtc->attachment)}}" target="_blank">PDF File</a>
                        @else
                        <div class="media-title"><img src="{{asset('assets/img/wedding/attachment/'.$wtc->attachment)}}" height="20px" onclick="$('#viewPictImage').attr('src',$(this).attr('src')); $('#viewPictModal').modal('show');" style="cursor: pointer"></div>
                        @endif
                      </div>
                      <div class="media-cta">
                        <span class="btn btn-outline-primary" data-url="{{route('order.show',$wtc->invoice_id)}}" onclick="$('#viewInvoiceContent').empty(); $('#viewInvoiceContent').load($(this).data('url')); $('#viewInvoiceModal').modal('show');">Detail</span>
                        <span class="btn btn-outline-danger" onclick="$('#form-wtc-delete-{{$wtc->id}}').submit();">
                          <form action="{{route('invoicepayment.destroy',$wtc->id)}}" id="form-wtc-delete-{{$wtc->id}}" method="POST">
                            @csrf
                            @method('delete')
                          </form>
                          Batal
                        </span>
                      </div>
                    </li>
                    @endforeach
                  </ul>
                @else
                  <h4 class="text-center">Tidak ada data</h4>
                @endif
              </div>
              <div class="tab-pane fade {{session('tab') == 'active' ? 'show active' : null}}" id="active" role="tabpanel" aria-labelledby="active-tab">
                @if ($activateds->count() > 0)
                  <ul class="list-unstyled user-progress list-unstyled-border list-unstyled-noborder" style="overflow:auto;">
                    @foreach ($activateds as $actv_no => $actv)
                    <li class="media">
                      <img alt="{{$actv->invoice_type->invoice_level->name}}" class="mr-3 rounded-circle" width="50" src="{{asset('assets/img/levels/'.$actv->invoice_type->invoice_level->image)}}">
                      <div class="media-body">
                        <div class="media-title">{{$actv->invoice_type->name}} ({{$actv->invoice_type->expired_day}} hari)</div>
                        <div class="media-title">{{ $actv->invoice_type->amount == 0 ? 'Gratis' : 'Rp ' . number_format($actv->invoice_type->amount, 2, ',', '.') }}</div>
                        <div class="text-job">{{$actv->code}}</div>
                        <div class="text-job">{{ Carbon\Carbon::parse($actv->created_at)->format('d-M-Y H:i:s') }}</div>
                      </div>
                      <div class="media-progressbar ml-3 display-none-max-width-660 {{$actv->invoice_type->amount == 0 ? 'd-none' : null}}">
                        <div class="text-job text-muted">Metode Pembayaran</div>
                        <div class="media">
                          <img alt="{{$actv->bank_account->bank_master->name}}" class="mr-3" width="70" src="{{asset('assets/img/banks/'.$actv->bank_account->bank_master->image)}}">
                          <div class="media-body">
                            <div class="media-title">{{$actv->bank_account->bank_master->name}}</div>
                            <div class="media-title">{{$actv->bank_account->number}} ({{$actv->bank_account->currency->code}})</div>
                            <div class="text-job">{{$actv->bank_account->name}}</div>
                          </div>
                        </div>
                      </div>
                      <div class="media-progressbar ml-3 display-none-max-width-575">
                        <div class="text-job text-muted {{$actv->invoice_type->amount == 0 ? 'd-none' : null}}">Dibayar</div>
                        <div class="media-title {{$actv->invoice_type->amount == 0 ? 'd-none' : null}}">{{number_format($actv->amount, 2, ',', '.')}} {{$actv->bank_account->currency->code}}</div>
                        <div class="text-job text-muted">Kedaluwarsa</div>
                        <div id="exp-{{$actv->code}}-1" class="media-title exp-countdown" data-expired="{{$actv->expired}}">{{ Carbon\Carbon::parse($actv->expired)->format('d-M-Y H:i:s') }}</div>
                      </div>
                      <div class="media-cta">
                        <span class="btn btn-outline-primary" data-url="{{route('order.show',$actv->id)}}" onclick="$('#viewInvoiceContent').empty(); $('#viewInvoiceContent').load($(this).data('url')); $('#viewInvoiceModal').modal('show');">Detail</span>
                      </div>
                    </li>
                    @endforeach
                  </ul>
                @else 
                <h4 class="text-center">Tidak ada data</h4>
                @endif
              </div>
              <div class="tab-pane fade {{session('tab') == 'expired' ? 'show active' : null}}" id="expired" role="tabpanel" aria-labelledby="expired-tab">
                @if ($expireds->count() > 0)
                  <ul class="list-unstyled user-progress list-unstyled-border list-unstyled-noborder" style="overflow:auto;">
                    @foreach ($expireds as $exp_no => $exp)
                    <li class="media">
                      <img alt="{{$exp->invoice_type->invoice_level->name}}" class="mr-3 rounded-circle" width="50" src="{{asset('assets/img/levels/'.$exp->invoice_type->invoice_level->image)}}">
                      <div class="media-body">
                        <div class="media-title">{{$exp->invoice_type->name}} ({{$exp->invoice_type->expired_day}} hari)</div>
                        <div class="media-title">{{ $exp->invoice_type->amount == 0 ? 'Gratis' : 'Rp ' . number_format($exp->invoice_type->amount, 2, ',', '.') }}</div>
                        <div class="text-job">{{$exp->code}}</div>
                        <div class="text-job">{{ Carbon\Carbon::parse($exp->created_at)->format('d-M-Y H:i:s') }}</div>
                      </div>
                      <div class="media-progressbar ml-3 display-none-max-width-660 {{$exp->invoice_type->amount == 0 ? 'd-none' : null}}">
                        <div class="text-job text-muted">Metode Pembayaran</div>
                        <div class="media">
                          <img alt="{{$exp->bank_account->bank_master->name}}" class="mr-3" width="70" src="{{asset('assets/img/banks/'.$exp->bank_account->bank_master->image)}}">
                          <div class="media-body">
                            <div class="media-title">{{$exp->bank_account->bank_master->name}}</div>
                            <div class="media-title">{{$exp->bank_account->number}} ({{$exp->bank_account->currency->code}})</div>
                            <div class="text-job">{{$exp->bank_account->name}}</div>
                          </div>
                        </div>
                      </div>
                      <div class="media-progressbar ml-3 display-none-max-width-575">
                        <div class="text-job text-muted {{$exp->invoice_type->amount == 0 ? 'd-none' : null}}">Dibayar</div>
                        <div class="media-title {{$exp->invoice_type->amount == 0 ? 'd-none' : null}}">{{number_format($exp->amount, 2, ',', '.')}} {{$exp->bank_account->currency->code}}</div>
                        <div class="text-job text-muted">Kedaluwarsa</div>
                        <div class="media-title">{{ Carbon\Carbon::parse($exp->expired)->format('d-M-Y H:i:s') }}</div>
                      </div>
                      <div class="media-cta">
                        <span class="btn btn-outline-primary" data-url="{{route('order.show',$exp->id)}}" onclick="$('#viewInvoiceContent').empty(); $('#viewInvoiceContent').load($(this).data('url')); $('#viewInvoiceModal').modal('show');">Detail</span>
                        <a href="{{route('subscribe.index.package_id',$exp->invoice_type_id)}}" class="btn btn-primary">{{$exp->invoice_type->amount == 0 ? 'Aktifkan' : 'Pesan lagi'}}</a>
                      </div>
                    </li>
                    @endforeach
                  </ul>
                @else
                  <h4 class="text-center">Tidak ada data</h4>
                @endif
              </div>
              <div class="tab-pane fade {{session('tab') == 'cancel' ? 'show active' : null}}" id="cancel" role="tabpanel" aria-labelledby="cancel-tab">
                @if ($canceleds->count() > 0)
                  <ul class="list-unstyled user-progress list-unstyled-border list-unstyled-noborder" style="overflow:auto;">
                    @foreach ($canceleds as $canceled_no => $canceled)
                    <li class="media">
                      <img alt="{{$canceled->invoice_type->invoice_level->name}}" class="mr-3 rounded-circle" width="50" src="{{asset('assets/img/levels/'.$canceled->invoice_type->invoice_level->image)}}">
                      <div class="media-body">
                        <div class="media-title">{{$canceled->invoice_type->name}} ({{$canceled->invoice_type->expired_day}} hari)</div>
                        <div class="media-title">{{ $canceled->invoice_type->amount == 0 ? 'Gratis' : 'Rp ' . number_format($canceled->invoice_type->amount, 2, ',', '.') }}</div>
                        <div class="text-job">{{$canceled->code}}</div>
                        <div class="text-job">{{ Carbon\Carbon::parse($canceled->created_at)->format('d-M-Y H:i:s') }}</div>
                      </div>
                      <div class="media-progressbar ml-3 display-none-max-width-660 {{$canceled->invoice_type->amount == 0 ? 'd-none' : null}}">
                        <div class="text-job text-muted">Metode Pembayaran</div>
                        <div class="media">
                          <img alt="{{$canceled->bank_account->bank_master->name}}" class="mr-3" width="70" src="{{asset('assets/img/banks/'.$canceled->bank_account->bank_master->image)}}">
                          <div class="media-body">
                            <div class="media-title">{{$canceled->bank_account->bank_master->name}}</div>
                            <div class="media-title">{{$canceled->bank_account->number}} ({{$canceled->bank_account->currency->code}})</div>
                            <div class="text-job">{{$canceled->bank_account->name}}</div>
                          </div>
                        </div>
                      </div>
                      <div class="media-progressbar ml-3 display-none-max-width-575">
                        <div class="text-job text-muted {{$canceled->invoice_type->amount == 0 ? 'd-none' : null}}">Dibayar</div>
                        <div class="media-title {{$canceled->invoice_type->amount == 0 ? 'd-none' : null}}">{{number_format($canceled->amount, 2, ',', '.')}} {{$canceled->bank_account->currency->code}}</div>
                        <div class="text-job text-muted">Kedaluwarsa</div>
                        <div class="media-title">{{ Carbon\Carbon::parse($canceled->expired)->format('d-M-Y H:i:s') }}</div>
                      </div>
                      <div class="media-cta">
                        <span class="btn btn-outline-primary" data-url="{{route('order.show',$canceled->id)}}" onclick="$('#viewInvoiceContent').empty(); $('#viewInvoiceContent').load($(this).data('url')); $('#viewInvoiceModal').modal('show');">Detail</span>
                        <a href="{{route('subscribe.index.package_id',$canceled->invoice_type_id)}}" class="btn btn-primary">{{$canceled->invoice_type->amount == 0 ? 'Aktifkan' : 'Pesan lagi'}}</a>
                      </div>
                    </li>
                    @endforeach
                  </ul>
                @else
                  <h4 class="text-center">Tidak ada data</h4>
                @endif
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection

@section('modal')
{{-- modal view image --}}
<div class="modal fade" tabindex="-1" role="dialog" id="viewPictModal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="viewPictTitle" class="modal-title">Lampiran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <img id="viewPictImage" src="" style="width: 100%">
            </div>
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

{{-- modal view invoice --}}
<div class="modal fade" tabindex="-1" role="dialog" id="viewInvoiceModal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div id="viewInvoiceContent"></div>
        </div>
        <div class="modal-footer bg-whitesmoke">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="btn-print-invoice" class="btn btn-outline-primary btn-icon icon-left"><i class="fas fa-print"></i> Cetak</button>
        </div>
      </div>
    </div>
</div>
@endsection

@push('page-script')

<script>
  $(document).ready(function() {
    countdownTimeStartAll('exp-countdown');
  });

function countdownTimeStartAll(class_name) {
  var all_comp_countdown = $("." + class_name).map(function() {
    return $(this).attr('id');
  }).get();

  jQuery.each( all_comp_countdown, function( i, id_comp_val ) {
    countdownTimeStart($('#' + id_comp_val));
  });
}

// Set the date we're counting down to
function countdownTimeStart(selector) {
  var countDownDate = new Date(selector.data('expired')).getTime();

  // Update the count down every 1 second
  var x = setInterval(function() {
    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor((distance / (1000 * 60 * 60 * 24)));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element
    selector.text(days + "d " + hours + "h " + minutes + "m " + seconds + "s");
    
    // If the count down is over, write some text 
    if (distance < 0) {
      clearInterval(x);
      selector.text("EXPIRED");
    }
  }, 1000);
}

$('#btn-print-invoice').click(function () {
  var id_inv = $('.invoice-print').data('id');
  // window.location.href = "{{route('order.print_invoice','')}}" + "/" + id_inv;
  window.open("{{route('order.print_invoice','')}}" + "/" + id_inv, '_blank');
});
//   @if($errors->has('title') || $errors->has('date') || $errors->has('desc'))
//     setModalViewEdit('{{Cookie::get("type-global")}}');
//     setRouteAndMethod('{{Cookie::get("type-global")}}', '{{Cookie::get("story-id")}}');
//     $('#btnSaveEdit').data('id','{{Cookie::get("story-id")}}');
//     $('#modalViewEdit').modal('show');
//   @endif
</script>
@endpush