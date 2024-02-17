@extends('layouts.master')
@section('title','Pembayaran Masuk')
@push('pages-style')
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

    @if ($errors->any())
      @foreach ($errors->all() as $error)
      <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
          <button class="close" data-dismiss="alert">
            <span>×</span>
          </button>
          {{$error}}
        </div>
      </div>
      @endforeach
    @endif

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Pembayaran masuk yang belum dikonfirmasi</h4>
            </div>

            <div class="card-body">
                @if($invoice_payments->count() > 0)
                <div class="table-responsive">
                <table class="table table-striped text-center" id="table-invoice-payment">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User</th>
                            <th scope="col">Paket</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Bank</th>
                            <th scope="col">Lampiran</th>
                            <th scope="col">Konfirmasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoice_payments as $no => $inv_pay)
                        <tr id="tr_{{$inv_pay->id}}" data-id="{{$inv_pay->id}}">
                            <td class="inv_pay-code" data-template_category_id="{{$inv_pay->invoice->template_category_id}}" data-inv_id="{{$inv_pay->invoice_id}}" data-invcode="{{$inv_pay->invoice->code}}">{{++$no}}</td>
                            <td class="inv_pay-user" data-user_id="{{$inv_pay->invoice->user_id}}" data-email="{{$inv_pay->invoice->user->email}}">{{$inv_pay->invoice->user->name}}</td>
                            <td class="inv_pay-paket" data-invoice_type_id="{{$inv_pay->invoice->invoice_type_id}}" data-paid="{{$inv_pay->invoice->amount}}" data-harga="{{$inv_pay->invoice->invoice_type->amount}}" data-image="{{asset('assets/img/levels/'.$inv_pay->invoice->invoice_type->invoice_level->image)}}" data-hari="{{$inv_pay->invoice->invoice_type->expired_day}}">{{$inv_pay->invoice->template_category->name}} - {{$inv_pay->invoice->invoice_type->name}}</td>
                            <td class="inv_pay-tgl">{{Carbon\Carbon::parse($inv_pay->date)->format(Constant::FORMAT_DATE_TIME)}}</td>
                            <td class="inv_pay-bank" data-bank_account_id="{{$inv_pay->invoice->bank_account_id}}" data-bank-img="{{asset('assets/img/banks/'.$inv_pay->invoice->bank_account->bank_master->image)}}" data-bank-name="{{$inv_pay->invoice->bank_account->bank_master->name}}" data-acc-number="{{$inv_pay->invoice->bank_account->number}}" data-curr="{{$inv_pay->invoice->bank_account->currency->code}}" data-acc-name="{{$inv_pay->invoice->bank_account->name}}">{{$inv_pay->invoice->bank_account->bank_master->code}} {{$inv_pay->invoice->bank_account->number}} ({{$inv_pay->invoice->bank_account->currency->code}}) {{$inv_pay->invoice->bank_account->name}}</td>
                            <td class="inv_pay-attachment" data-attachment="{{asset('assets/img/wedding/attachment/'.$inv_pay->attachment)}}">
                                @if (pathinfo($inv_pay->attachment, PATHINFO_EXTENSION) == 'pdf')
                                <a href="{{asset('assets/img/wedding/attachment/'.$inv_pay->attachment)}}" target="_blank">PDF File</a>
                                @else
                                <img src="{{asset('assets/img/wedding/attachment/'.$inv_pay->attachment)}}" height="20px" onclick="$('#viewPictImage').attr('src',$(this).attr('src')); $('#viewPictModal').modal('show');" style="cursor: pointer">
                                @endif
                            </td>
                            <td>
                                <span data-id="{{$inv_pay->id}}" class="btn btn-primary btn-sm btn-process" data-toggle="tooltip" title="Proses"><i class="fas fa-arrow-right"></i></span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                @else
                <div class="empty-state">
                    <div class="empty-state-icon"><i class="fas fa-question"></i></div>
                    <h2>Tidak ada pembayaran masuk</h2>
                    <p class="lead">Semua pembayaran masuk yang perlu dikonfirmasi akan ditampilkan di sini.</p>
                </div>
                @endif
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

{{-- modal-confirmation --}}
<div class="modal fade" id="modal-confirmation" tabindex="-1" role="dialog" aria-labelledby="modal-confirmation-label" aria-hidden="true">
  <div id="modal-confirmation-type" class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-confirmation-label"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="modal-form" action="" method="POST">
      @csrf
      @method('put')
      <div class="modal-body">
        <div class="row">
          <div class="col-12 col-sm-6 col-md-6 col-lg-6">
            <address>
              <strong id="modal-username"></strong>
              <div id="modal-useremail"></div>
            </address>
          </div>
          <div class="col-12 col-sm-6 col-md-6 col-lg-6 text-md-right">
            <address>
              <strong id="modal-date-payment"></strong>
            </address>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-sm-6 col-md-6 col-lg-6">
            <div class="media">
              <img id="modal-paket-img" alt="" class="mr-3" width="50" src="">
              <div class="media-body">
                <div id="modal-paket-name" class="media-title"></div>
                <div id="modal-paket-price" class="media-title"></div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-6 col-lg-6">
            <div class="media">
              <img id="modal-bank-img" alt="" class="mr-3" width="70" src="">
              <div class="media-body">
                <div id="modal-bank-name" class="media-title"></div>
                <div id="modal-bank-acc-number" class="media-title"></div>
                <div id="modal-bank-acc-name" class="text-job"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-12 col-sm-6 col-md-6 col-lg-6">
            <address>
              <strong>Pembayaran dikonfirmasi</strong>
              <div id="modal-paid"></div>
            </address>
          </div>
          <div class="col-12 col-sm-6 col-md-6 col-lg-6">
            <address>
              <strong>Kurang bayar</strong>
              <div id="modal-lesspaid"></div>
            </address>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-sm-6 col-md-6 col-lg-6">
            <a id="modal-attachment" href="" target="_blank">Buka Lampiran <i class="fas fa-chevron-right"></i></a>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
              <label @error('amount') class="text-danger" @enderror>Amount* @error('amount') | {{$message}} @enderror</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div id="modal-currency-code" class="input-group-text"></div>
                </div>
                <input id="user_id" type="hidden" name="user_id" value="">
                <input id="invoice_id" type="hidden" name="invoice_id" value="">
                <input id="template_category_id" type="hidden" name="template_category_id" value="">
                <input id="invoice_type_id" type="hidden" name="invoice_type_id" value="">
                <input id="bank_account_id" type="hidden" name="bank_account_id" value="">
                <input id="invoice_code" type="hidden" name="invoice_code" value="">
                <input id="amount" type="number" name="amount" class="form-control currency d-none" value="0" min="0">
                <input id="amount_txt" type="text" name="amount_txt" class="form-control" value="0" required>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <span id="modal-btn-confirm" type="submit" class="btn btn-primary swal-confrim">Konfirmasi</span>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('page-script')
<script src="{{asset('assets/js/page/modules-datatables.js')}}"></script>
<script src="{{asset('assets/js/jquery.mask.js')}}"></script>
<script>

const mask_string = '{{Constant::MASK_CURRENCY}}';

$(document).ready(function() {
  $('#table-invoice-payment').DataTable();
  $('#amount_txt').mask(mask_string, {reverse: true});
});

function convertToNumb(txt) {
  var numb_array = [];
  if (mask_string.includes('.')) {
    numb_array = txt.split('.');
  } else {
    numb_array = txt.split(',');
  }
  return numb_array.join('');
}

$('input[type="text"]').keypress(function (e) {
  if (e.which == 13) {
    $('#modal-btn-confirm').click();
    // return false;
  }
});

$('#amount_txt').change(function () {
  $('#amount').val(Number(convertToNumb($(this).val())));
});

$('.btn-process').click(function(e) {
  var data_id = $(this).data('id');
  var object_tr = $('#tr_' + data_id);
  var url_update = "{{route('admininvoicepayment.update','')}}" + "/" + data_id;
  var lesspaid = object_tr.find('.inv_pay-paket').data('harga') - object_tr.find('.inv_pay-paket').data('paid');
  lesspaid = lesspaid < 0 ? 0 : lesspaid;
  $('#modal-form').attr('action',url_update);
  $('#modal-confirmation-label').text('Konfirmasi Pembayaran ' + object_tr.find('.inv_pay-code').data('invcode'));
  $('#modal-username').text(object_tr.find('.inv_pay-user').text());
  $('#modal-useremail').text(object_tr.find('.inv_pay-user').data('email'));
  $('#modal-date-payment').text(object_tr.find('.inv_pay-tgl').text());
  $('#modal-paket-img').attr('src',object_tr.find('.inv_pay-paket').data('image'));
  $('#modal-paket-img').attr('alt',object_tr.find('.inv_pay-paket').text());
  $('#modal-paket-name').text((object_tr.find('.inv_pay-paket').text().split(' ')).pop() + " (" + object_tr.find('.inv_pay-paket').data('hari') + " hari)");
  $('#modal-paket-price').text("Rp " + object_tr.find('.inv_pay-paket').data('harga').toLocaleString('id-ID'));
  $('#modal-bank-img').attr('src',object_tr.find('.inv_pay-bank').data('bank-img'));
  $('#modal-bank-img').attr('alt',object_tr.find('.inv_pay-bank').data('bank-name'));
  $('#modal-bank-name').text(object_tr.find('.inv_pay-bank').data('bank-name'));
  $('#modal-bank-acc-number').text(object_tr.find('.inv_pay-bank').data('acc-number') + " (" + object_tr.find('.inv_pay-bank').data('curr') + ")");
  $('#modal-bank-acc-name').text(object_tr.find('.inv_pay-bank').data('acc-name'));
  $('#modal-paid').text("Rp " + object_tr.find('.inv_pay-paket').data('paid').toLocaleString('id-ID'));
  $('#modal-lesspaid').text("Rp " + lesspaid.toLocaleString('id-ID'));
  $('#modal-attachment').attr('href',object_tr.find('.inv_pay-attachment').data('attachment'));
  $('#modal-currency-code').text(object_tr.find('.inv_pay-bank').data('curr'));
  // input
  $('#user_id').val(object_tr.find('.inv_pay-user').data('user_id'));
  $('#invoice_id').val(object_tr.find('.inv_pay-code').data('inv_id'));
  $('#template_category_id').val(object_tr.find('.inv_pay-code').data('template_category_id'));
  $('#invoice_type_id').val(object_tr.find('.inv_pay-paket').data('invoice_type_id'));
  $('#bank_account_id').val(object_tr.find('.inv_pay-bank').data('bank_account_id'));
  $('#invoice_code').val(object_tr.find('.inv_pay-code').data('invcode'));
  $('#modal-confirmation').modal('show');
});

$(".swal-confrim").click(function(e) {
    id = e.target.dataset.id; // ambil targeet id dari element dataset(data-id)
    Swal.fire({
        title: 'Konfirmasi Pembayaran?',
        text: "Anda tidak akan dapat mengembalikan ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal',
        reverseButtons: true
    })
    .then((result) => {
        if (result.isConfirmed) {
            // Swal.fire({ title: 'Success', icon: 'success' });
            $('#modal-form').submit();
        }
    });
});
</script>
@endpush
