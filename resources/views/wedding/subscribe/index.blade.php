@extends('layouts.master')
@section('title','Subscribe')
@push('pages-style')
<style>
  .cursor-pointer {cursor: pointer;}
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
        <h2 class="section-title">Paket</h2>
        <p class="section-lead">Berlangganan paket {{config('app.name')}} untuk dapatkan fitur lebih.</p>
        <div class="row">
            @foreach ($invoice_types as $no => $invtype)
              <div class="col-12 col-md-4 col-lg-4 pricing-subscribe" data-id="{{$invtype->id}}">
                <div class="{{ $invtype->highlight == 'Y' ? 'pricing pricing-highlight' : 'pricing' }}">
                  <div class="pricing-title">
                    {{$invtype->name}}
                  </div>
                  <div class="pricing-padding">
                    <div class="pricing-price">
                      <img class="pricing-image" width="100px" src="{{asset('assets/img/levels/'.$invtype->invoice_level->image)}}">
                      <h3 class="mt-4 pricing-item-price" data-amount="{{$invtype->amount}}">{{ $invtype->amount == 0 ? 'Gratis!' : 'Rp ' . number_format($invtype->amount, 2, ',', '.') }}</h3>
                      <div class="pricing-expired-day">{{$invtype->expired_day}} Hari</div>
                    </div>
                    <div class="pricing-details">

                      {{-- Catatan --}}
                      {{-- @for ($i = 0; $i < count($rules); $i++)
                        <p>{{$rules[$i]->name}}</p>
                        @for ($j = 0; $j < count($rules[$i]->rule_value); $j++)
                          <p>{{$rules[$i]->rule_value[$j]->value}}</p>
                        @endfor
                      @endfor --}}

                      @foreach ($rules as $no_rule => $r)
                        @foreach ($r->rule_value as $no_rule_value => $rv)
                          @if ($rv->invoice_type_id == $invtype->id)
                            <div class="pricing-item">
                              <div class="{{ $rv->value == '0' ? 'pricing-item-icon bg-danger text-white' : 'pricing-item-icon' }}"><i class="{{ $rv->value == '0' ? 'fas fa-times' : 'fas fa-check' }}"></i></div>
                              <div class="pricing-item-label">@if ($rv->value == '0') {{$r->name}} @else <strong>{{$r->name}}</strong> @endif {{$r->countable == 'Y' ? '(' . ($rv->value == Constant::CODE_UNLIMITED ? "unlimited" : $rv->value) . ')' : null }}</div>
                            </div>
                          @endif
                        @endforeach
                      @endforeach
                    </div>
                  </div>
                  <div class="pricing-cta">
                    <a class="cursor-pointer btn-subscribe" data-id="{{$invtype->id}}">{{$invtype->amount == 0 ? 'Aktifkan' : 'Pesan'}} <i class="fas fa-arrow-right"></i></a>
                  </div>
                </div>
              </div>
            @endforeach
        </div>
    </div>
@endsection

@section('modal')
<div class="modal fade" id="modal-subscribe" tabindex="-1" role="dialog" aria-labelledby="modal-subscribe-label" aria-hidden="true">
  <div id="modal-subscribe-type" class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-subscribe-label">Buat Pesanan Paket Wedding</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div id="modal-invoice-item" class="col-12 col-sm-12 col-md-12 col-lg-6">
            <div class="form-group">
              <label>Paket Wedding</label>
              <div class="media">
                <img id="modal-subscribe-img" alt="" class="mr-3 rounded-circle" width="50" src="">
                <div class="media-body">
                  <div id="modal-subscribe-item-title" class="media-title"></div>
                  <div id="modal-subscribe-item-price" class="media-title"></div>
                </div>
              </div>
              <div class="tab-content" id="tab-content-feature">
              @foreach ($invoice_types as $no => $invtype)
                <div class="tab-pane fade" id="tab-level-{{$invtype->id}}" role="tabpanel" aria-labelledby="level-{{$invtype->id}}-tab">
                  @foreach ($rules as $no_rule => $r)
                    @foreach ($r->rule_value as $no_rule_value => $rv)
                      @if ($rv->invoice_type_id == $invtype->id)
                      <span class="badge {{ $rv->value == '0' ? 'badge-danger text-white' : 'badge-primary' }}"><i class="{{ $rv->value == '0' ? 'fas fa-times' : 'fas fa-check' }}"></i> {{$r->name}} {{$r->countable == 'Y' ? '(' . ($rv->value == Constant::CODE_UNLIMITED ? "unlimited" : $rv->value) . ')' : null }}</span>
                      @endif
                    @endforeach
                  @endforeach
                </div>
              @endforeach
              </div>
            </div>
          </div>
          <div id="modal-select-payment" class="col-12 col-sm-12 col-md-12 col-lg-6">
            <div class="form-group">
              <label>Pembayaran</label>
              <select id="select-payment" class="mb-3 form-control @error('bank_account_id') is-invalid @enderror" name="bank_account_id" required>
                <option value="" selected disabled hidden>Pilih Bank</option>
                @foreach ($bank_accounts as $bc_no => $bc)
                <option class="opt-bank" value="{{$bc->id}}" data-bank-img="{{asset('assets/img/banks/'.$bc->bank_master->image)}}" data-bank-name="{{$bc->bank_master->name}}" data-bank-currency="{{$bc->currency->code}}" data-bank-number="{{$bc->number}}" data-bank-account-name="{{$bc->name}}">{{$bc->bank_master->code}} {{$bc->number}} ({{$bc->currency->code}})</option>
                @endforeach
              </select>
              <div class="media">
                <img id="modal-bank-img" alt="" class="mr-3" width="70" src="">
                <div class="media-body">
                  <div id="modal-bank-name" class="media-title"></div>
                  <div id="modal-bank-number" class="media-title"></div>
                  <div id="modal-bank-account-name" class="text-job"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btn-modal-order" class="btn btn-outline-primary btn-modal-save">Pesan, bayar nanti</button>
        <button type="button" id="btn-modal-pay" class="btn btn-primary btn-modal-save">Bayar sekarang</button>
        <button type="button" id="btn-modal-activate" class="btn btn-primary btn-modal-save">Aktifkan</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('page-script')

<script>
  var inv_type_id = 0;
  // var inv_type_amount = 0;

  $(document).ready(function() {});

  $('.btn-subscribe').click(function() {
    var obj_pricing = $('.pricing-subscribe[data-id="' + $(this).data("id") + '"]');
    inv_type_id = $(this).data("id");
    // inv_type_amount = Number(obj_pricing.find('.pricing-item-price').data('amount'));

    $('#modal-subscribe-img').attr('alt',obj_pricing.find('.pricing-title').text().trim());
    $('#modal-subscribe-img').attr('src',obj_pricing.find('.pricing-image').attr('src'));
    $('#modal-subscribe-item-title').text(obj_pricing.find('.pricing-title').text().trim() + ' (' + obj_pricing.find('.pricing-expired-day').text().trim() + ')');
    $('#modal-subscribe-item-price').text(obj_pricing.find('.pricing-item-price').text().trim());
    $('.btn-modal-save').removeClass('d-none');
    if (Number(obj_pricing.find('.pricing-item-price').data('amount')) == 0)
    {
      $('#modal-subscribe-label').text('Aktifkan Paket Wedding');
      $('#select-payment').val() == null ? $('#select-payment').val('{{$bank_accounts[0]->id}}').change() : null;
      $('div#modal-subscribe-type').removeClass('modal-lg');
      $('div#modal-invoice-item').removeClass('col-lg-6');
      $('div#modal-invoice-item').addClass('col-lg-12');
      $('div#modal-select-payment').addClass('d-none');
      $('#btn-modal-order').addClass('d-none');
      $('#btn-modal-pay').addClass('d-none');
    }
    else
    {
      $('#modal-subscribe-label').text('Buat Pesanan Paket Wedding');
      $('div#modal-subscribe-type').addClass('modal-lg');
      $('div#modal-invoice-item').removeClass('col-lg-12');
      $('div#modal-invoice-item').addClass('col-lg-6');
      $('div#modal-select-payment').removeClass('d-none');
      $('#btn-modal-activate').addClass('d-none');
    }
    $('.tab-pane').removeClass('show active');
    $('.tab-pane[id="tab-level-' + $(this).data("id") + '"]').addClass('show active');
    $('#modal-subscribe').modal('show');
  });

  $('#select-payment').on('change', function() {
    $('#modal-bank-img').attr('alt',$('.opt-bank[value="' + this.value + '"]').data('bank-name'));
    $('#modal-bank-img').attr('src',$('.opt-bank[value="' + this.value + '"]').data('bank-img'));
    $('#modal-bank-name').text($('.opt-bank[value="' + this.value + '"]').data('bank-name'));
    $('#modal-bank-number').text($('.opt-bank[value="' + this.value + '"]').data('bank-number'));
    $('#modal-bank-account-name').text($('.opt-bank[value="' + this.value + '"]').data('bank-account-name'));
  });

  $('.btn-modal-save').click(function() {
    $.ajax({
      url: "{{route('subscribe.store')}}",
      type: 'POST',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: {invoice_type_id: inv_type_id, bank_account_id: $('select#select-payment').val(), btn_modal_save_id: $(this).attr('id')},
      success: function (data) {
        if (data['success']) {
          Swal.fire({ title: data['success'], icon: 'success' });
        } else if (data['warning']) {
          Swal.fire({ title: data['warning'], icon: 'warning' });
        } else if (data['error']) {
          Swal.fire({ title: data['error'], icon: 'error' });
        } else if (data['redirect']) {
          window.location.replace(data['redirect']);
        } else {
          Swal.fire('Whoops Something went wrong!!');
        }
      },
      error: function (data) {
        // Swal.fire(data.responseText);
        // Swal.fire('Whoops Something went wrong!!\n\n' + data.responseText);
        Swal.fire({ title: 'Maaf, terjadi kesalahan!', icon: 'error' });
        // location.reload();
      }
    });
  });

@if (session('package_id'))
  var package_id = "{{session('package_id')}}";
  $('.btn-subscribe[data-id="' + package_id + '"]').click();
@endif

//   @if($errors->has('title') || $errors->has('date') || $errors->has('desc'))
//     setModalViewEdit('{{Cookie::get("type-global")}}');
//     setRouteAndMethod('{{Cookie::get("type-global")}}', '{{Cookie::get("story-id")}}');
//     $('#btnSaveEdit').data('id','{{Cookie::get("story-id")}}');
//     $('#modalViewEdit').modal('show');
//   @endif
</script>
@endpush
