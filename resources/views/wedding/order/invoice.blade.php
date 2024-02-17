@extends('layouts.master')
@section('title',"Invoice '" . $invoice_edit_item->code . "'")
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
      <div class="invoice">
        <div class="invoice-print">
          <div class="row">
            <div class="col-lg-12">
              <div class="invoice-title">
                <div class="row">
                  <div class="col-md-6">
                    <h2>Invoice</h2>
                  </div>
                  <div class="col-md-6">
                    <h5 class="float-right">{{$invoice_edit_item->code}}</h5>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-6">
                  <address>
                    <strong>Ditagih ke:</strong><br>
                    {{config('app.name')}}<br>
                    DKI Jakarta, Indonesia
                  </address>
                </div>
                <div class="col-md-6 text-md-right">
                  <address>
                    <strong>Penerima:</strong><br>
                    {{$invoice_edit_item->user->name}}<br>
                    {{$invoice_edit_item->user->email}}
                  </address>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <address>
                    <strong>Pembayaran Transfer Bank ke:</strong><br>
                    {{$invoice_edit_item->bank_account->bank_master->name}}<br>
                    {{$invoice_edit_item->bank_account->number}} ({{$invoice_edit_item->bank_account->currency->code}})<br>
                    {{$invoice_edit_item->bank_account->name}}<br>
                  </address>
                </div>
                <div class="col-md-6 text-md-right">
                  <address>
                    <strong>Tanggal Pesanan:</strong><br>
                    {{Carbon\Carbon::parse($invoice_edit_item->created_at)->format('d-M-Y H:i')}}<br><br>
                    <strong>Kedaluwarsa:</strong><br>
                    {{Carbon\Carbon::parse($invoice_edit_item->expired)->format('d-M-Y H:i')}}<br>
                  </address>
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-4">
            <div class="col-md-12">
              <div class="section-title">Ringkasan Pesanan</div>
                  <ul class="list-unstyled user-progress list-unstyled-border list-unstyled-noborder" style="overflow:auto;">
                    <li class="media">
                      <img alt="{{$invoice_edit_item->invoice_type->invoice_level->name}}" class="mr-3 rounded-circle" width="36" src="{{asset('assets/img/levels/'.$invoice_edit_item->invoice_type->invoice_level->image)}}">
                      <div class="media-body">
                        <div class="text-job text-muted">Paket</div>
                        <div class="media-title">{{$invoice_edit_item->invoice_type->name}} ({{$invoice_edit_item->invoice_type->expired_day}} hari)</div>
                      </div>
                      <div class="media-progressbar ml-3">
                        <div class="text-job text-muted">Harga</div>
                        <div class="media-title">{{'Rp ' . number_format($invoice_edit_item->invoice_type->amount, 2, ',', '.')}}</div>
                      </div>
                      <div class="media-progressbar ml-3">
                        <div class="text-job text-muted">Quantity</div>
                        <div class="media-title">1</div>
                      </div>
                      <div class="media-cta">
                        <div class="text-job text-muted">Total</div>
                        <div class="media-title">{{'Rp ' . number_format($invoice_edit_item->invoice_type->amount * 1, 2, ',', '.')}}</div>
                      </div>
                    </li>
                  </ul>

                  @if (count($invoice_payments) > 0)
                    <div class="section-title">Rincian Pembayaran Anda</div>

                    <ul class="list-unstyled user-progress list-unstyled-border list-unstyled-noborder" style="overflow:auto;">
                      @foreach ($invoice_payments as $inv_pay_no => $inv_pay)
                        <li class="media">
                          <div class="media-body">
                            <div class="text-job text-muted">Tanggal</div>
                            <div class="media-title">{{Carbon\Carbon::parse($inv_pay->date)->format(Constant::FORMAT_DATE_TIME)}}</div>
                          </div>
                          <div class="media-progressbar ml-3">
                            <div class="text-job text-muted">Lampiran</div>
                            @if (pathinfo($inv_pay->attachment, PATHINFO_EXTENSION) == 'pdf')
                            <a href="{{asset('assets/img/wedding/attachment/'.$inv_pay->attachment)}}" target="_blank">PDF File</a>
                            @else
                            <div class="media-title"><img src="{{asset('assets/img/wedding/attachment/'.$inv_pay->attachment)}}" height="20px" onclick="$('#viewPictImage').attr('src',$(this).attr('src')); $('#viewPictModal').modal('show');" style="cursor: pointer;"></div>
                            @endif
                          </div>
                          <div class="media-progressbar ml-3">
                            <div class="text-job text-muted">Jumlah</div>
                            <div class="media-title">{{'Rp ' . number_format($inv_pay->amount, 2, ',', '.')}}</div>
                          </div>
                          <div class="media-progressbar ml-3">
                            <div class="text-job text-muted">Tanggal dikonfirmasi</div>
                            <div class="media-title">{{$inv_pay->is_confirmed == Constant::TRUE_CONDITION ? Carbon\Carbon::parse($inv_pay->updated_at)->format(Constant::FORMAT_DATE_TIME) : '-'}}</div>
                          </div>
                          <div class="media-progressbar ml-3">
                            <div class="text-job text-muted">Status</div>
                            <span class="{{$inv_pay->is_confirmed == Constant::TRUE_CONDITION ? 'badge badge-primary' : 'badge badge-warning'}}">{{$inv_pay->is_confirmed == Constant::TRUE_CONDITION ? 'Dikonfirmasi' : 'Menunggu'}}</span>
                            @if($inv_pay->is_confirmed == Constant::FALSE_CONDITION)
                            <span class="" title="Hapus" onclick="$('#form-inv_pay-delete-{{$inv_pay->id}}').submit();" style="cursor:pointer;"><i class="fas fa-trash"></i></span>
                            <form action="{{route('invoicepayment.destroy',$inv_pay->id)}}" id="form-inv_pay-delete-{{$inv_pay->id}}" method="POST">
                              @csrf
                              @method('delete')
                            </form>
                            @endif
                          </div>
                        </li>
                      @endforeach
                    </ul>
                  @endif

              <div class="row mt-4">
                <div class="col-lg-8">
                  <div class="section-title">Rekening Tujuan untuk Pembayaran</div>
                  <img alt="{{$invoice_edit_item->bank_account->bank_master->name}}" class="mr-3 d-block d-sm-none" width="70" src="{{asset('assets/img/banks/'.$invoice_edit_item->bank_account->bank_master->image)}}">
                  <div class="media">
                    <img alt="{{$invoice_edit_item->bank_account->bank_master->name}}" class="mr-3 d-none d-sm-block" width="70" src="{{asset('assets/img/banks/'.$invoice_edit_item->bank_account->bank_master->image)}}">
                    <div class="media-body">
                      <div class="media-title">{{$invoice_edit_item->bank_account->bank_master->name}}</div>
                      <div class="media-title">{{$invoice_edit_item->bank_account->number}} ({{$invoice_edit_item->bank_account->currency->code}})</div>
                      <div class="text-job">{{$invoice_edit_item->bank_account->name}}</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 text-right mt-4">
                  <div class="invoice-detail-item">
                    <div class="invoice-detail-name">Subtotal item</div>
                    <div class="invoice-detail-value">{{'Rp ' . number_format($invoice_edit_item->invoice_type->amount * 1, 2, ',', '.')}}</div>
                  </div>
                  <div class="invoice-detail-item">
                    <div class="invoice-detail-name">Pembayaran dikonfirmasi</div>
                    <div class="invoice-detail-value">{{'Rp ' . number_format($amount_confirmed, 2, ',', '.')}}</div>
                  </div>
                  <hr class="mt-2 mb-2">
                  <div class="invoice-detail-item">
                    <div class="invoice-detail-name {{$amount_must_be_paid <= 0 ? 'd-none' : null }}">Total kurang bayar</div>
                    <div class="invoice-detail-value invoice-detail-value-lg {{$amount_must_be_paid <= 0 ? 'text-primary' : null }}">{{$amount_must_be_paid <= 0 ? 'LUNAS' : 'Rp ' . number_format($amount_must_be_paid, 2, ',', '.')}}</div>
                  </div>
                  @if ($invoice_edit_item->expired < Carbon\Carbon::now() && $invoice_edit_item->status == Constant::FALSE_CONDITION)
                    <div class="invoice-detail-item">
                      <div class="invoice-detail-value invoice-detail-value-lg text-danger">BATAL</div>
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="text-md-right">
          <div class="float-lg-left mb-lg-0 mb-3">
            <a href="{{route('order.print_invoice',$invoice_edit_item->id)}}" class="btn btn-outline-primary btn-icon icon-left" target="_blank"><i class="fas fa-print"></i> Cetak</a>
          </div>
          <a href="{{route('order.redirect','notyetpaid')}}" class="btn btn-warning btn-icon icon-left"><i class="fas fa-arrow-left"></i> Kembali</a>
          <button class="btn btn-primary btn-icon icon-left" onclick="$('#modal-payment').modal('show');"><i class="fas fa-credit-card"></i> Bayar</button>
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

{{-- modal-payment --}}
<div class="modal fade" id="modal-payment" tabindex="-1" role="dialog" aria-labelledby="modal-payment-label" aria-hidden="true">
  <div id="modal-payment-type" class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-payment-label">Upload Bukti Transfer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('invoicepayment.store')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-body">
        <div class="row">
          <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
              @error('invoice_id')<label class="text-danger">{{$message}}</label><br>@enderror
              <label @error('attachment') class="text-danger" @enderror>Bukti Transfer* @error('attachment') | {{$message}} @enderror</label>
              <div class="custom-file">
                <input type="file" id="file-attachment" name="attachment" class="custom-file-input" accept=".jpg, .jpeg, .png, .pdf" required>
                <label class="custom-file-label" for="file-attachment">Pilih berkas</label>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <input type="hidden" name="invoice_id" value="{{$invoice_edit_item->id}}">
            <img id="attachment-image" src="" width="100%">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary btn-add">Upload</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('page-script')

<script>
  $(document).ready(function() {});

  function setFileNull() {
    $('#file-attachment').val(null);
    $('#attachment-image').attr('src',null);
    $('.custom-file-label[for="file-attachment"]').text('Pilih berkas');
  }

  $('#modal-payment').on('hidden.bs.modal', function () {
    setFileNull();
  });

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#attachment-image').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $('#file-attachment').change(function () {
    if ($(this).val() != "") {
      const allowedExtensions =  ['jpg','jpeg','png','pdf'],
      sizeLimit = '{{Constant::MAX_FILE_SIZE_LIMIT}}';
      const { name:fileName, size:fileSize } = this.files[0];
      const fileExt = fileName.split(".").pop().toLowerCase();
      // const fileName = $(this).val().split('\\').pop().toLowerCase();

      if (!allowedExtensions.includes(fileExt)) {
        Swal.fire({ title: 'Format file harus .jpg, .jpeg, .png, atau .pdf!', icon: 'warning' });
        // this.value = null;
        setFileNull();
        return false;
      } else if (fileSize > sizeLimit) {
        Swal.fire({ title: 'Ukuran file maksimal ' + sizeLimit / 1000000 + 'MB!', icon: 'warning' });
        // this.value = null;
        setFileNull();
        return false;
      } else {
        if (fileExt == "pdf") {
          $('#attachment-image').attr('src',null);
        } else {
          readURL(this);
        }
        $('.custom-file-label[for="file-attachment"]').text(fileName);
      }
    } else {
      setFileNull();
    }
  });

  @if($errors->has('invoice_id') || $errors->has('attachment'))
    $('#modal-payment').modal('show');
  @endif
</script>
@endpush
