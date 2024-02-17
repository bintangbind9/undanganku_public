<div class="invoice">
    <div data-id="{{$invoice_show_item->id}}" class="invoice-print">
        <div class="row">
            <div class="col-lg-12">
                <div class="invoice-title">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Invoice</h2>
                        </div>
                        <div class="col-md-6">
                            <h5 class="float-right">{{$invoice_show_item->code}}</h5>
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
                            {{$invoice_show_item->user->name}}<br>
                            {{$invoice_show_item->user->email}}
                        </address>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <address>
                            <strong>Pembayaran Transfer Bank ke:</strong><br>
                            {{$invoice_show_item->bank_account->bank_master->name}}<br>
                            {{$invoice_show_item->bank_account->number}} ({{$invoice_show_item->bank_account->currency->code}})<br>
                            {{$invoice_show_item->bank_account->name}}<br>
                        </address>
                    </div>
                    <div class="col-md-6 text-md-right">
                        <address>
                            <strong>Tanggal Pesanan:</strong><br>
                            {{Carbon\Carbon::parse($invoice_show_item->created_at)->format(Constant::FORMAT_DATE_TIME)}}<br><br>
                            <strong>Kedaluwarsa:</strong><br>
                            {{Carbon\Carbon::parse($invoice_show_item->expired)->format(Constant::FORMAT_DATE_TIME)}}<br>
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
                        <img alt="{{$invoice_show_item->invoice_type->invoice_level->name}}" class="mr-3 rounded-circle" width="36" src="{{asset('assets/img/levels/'.$invoice_show_item->invoice_type->invoice_level->image)}}">
                        <div class="media-body">
                            <div class="text-job text-muted">Paket</div>
                            <div class="media-title">{{$invoice_show_item->invoice_type->name}} ({{$invoice_show_item->invoice_type->expired_day}} hari)</div>
                        </div>
                        <div class="media-progressbar ml-3">
                            <div class="text-job text-muted">Harga</div>
                            <div class="media-title">{{'Rp ' . number_format($invoice_show_item->invoice_type->amount, 2, ',', '.')}}</div>
                        </div>
                        <div class="media-progressbar ml-3">
                            <div class="text-job text-muted">Quantity</div>
                            <div class="media-title">1</div>
                        </div>
                        <div class="media-cta">
                            <div class="text-job text-muted">Total</div>
                            <div class="media-title">{{'Rp ' . number_format($invoice_show_item->invoice_type->amount * 1, 2, ',', '.')}}</div>
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
                                <a href="{{asset('assets/img/wedding/attachment/'.$inv_pay->attachment)}}" target="_blank">Buka Lampiran</a>
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
                            </div>
                        </li>
                        @endforeach
                    </ul>
                @endif

                <div class="row mt-4">
                    <div class="col-lg-8">
                        <div class="section-title">Rekening Tujuan untuk Pembayaran</div>
                        <img alt="{{$invoice_show_item->bank_account->bank_master->name}}" class="mr-3 d-block d-sm-none" width="70" src="{{asset('assets/img/banks/'.$invoice_show_item->bank_account->bank_master->image)}}">
                        <div class="media">
                            <img alt="{{$invoice_show_item->bank_account->bank_master->name}}" class="mr-3 d-none d-sm-block" width="70" src="{{asset('assets/img/banks/'.$invoice_show_item->bank_account->bank_master->image)}}">
                            <div class="media-body">
                                <div class="media-title">{{$invoice_show_item->bank_account->bank_master->name}}</div>
                                <div class="media-title">{{$invoice_show_item->bank_account->number}} ({{$invoice_show_item->bank_account->currency->code}})</div>
                                <div class="text-job">{{$invoice_show_item->bank_account->name}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-right mt-4">
                        <div class="invoice-detail-item">
                            <div class="invoice-detail-name">Subtotal item</div>
                            <div class="invoice-detail-value">{{'Rp ' . number_format($invoice_show_item->invoice_type->amount * 1, 2, ',', '.')}}</div>
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
                        @if ($invoice_show_item->expired < Carbon\Carbon::now() && $invoice_show_item->status == Constant::FALSE_CONDITION)
                            <div class="invoice-detail-item">
                                <div class="invoice-detail-value invoice-detail-value-lg text-danger">BATAL</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>