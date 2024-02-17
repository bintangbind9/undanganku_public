@component('mail::message')
# Invoice {{$details['invoice']['code']}}

@component('mail::table')
| Dari                                       | Kepada                                      |
|:------------------------------------------ | -------------------------------------------:|
| {{config('app.name')}}.com                 | {{$details['invoice']->user->name}}         |
| {{Constant::DEFAULT_SUPPORT_EMAIL}}        | {{$details['invoice']->user->email}}        |
| {{Constant::DEFAULT_OFFICE_LOCATION}}      |                                             |
@endcomponent

Paket yang dipilih:
@component('mail::table')
| Paket                                                                                          | Tanggal Kedaluwarsa                                                                                                                         | Harga Paket                                                                                                                         |
|:---------------------------------------------------------------------------------------------- |:-------------------------------------------------------------------------------------------------------------------------------------------:| -----------------------------------------------------------------------------------------------------------------------------------:|
| {{$details['invoice']->template_category->name}} - {{$details['invoice']->invoice_type->name}} | {{Carbon\Carbon::parse($details['invoice']['expired'])->locale(Constant::DEFAULT_COUNTRY_CODE)->isoFormat(Constant::ISO_FORMAT_DATE_TIME)}} | {{$details['invoice']->bank_account->currency->code . ' ' . number_format($details['invoice']->invoice_type->amount, 2, ',', '.')}} |
@endcomponent

Pembayaran dikonfirmasi:
@component('mail::table')
| No | Tanggal Bayar | Tanggal Dikonfirmasi | Jumlah |
|:-- |:-------------:|:--------------------:| ------:|
@foreach ($details['invoice_payments'] as $ip_no => $ip)
| {{++$ip_no}} | {{Carbon\Carbon::parse($ip->date)->locale(Constant::DEFAULT_COUNTRY_CODE)->isoFormat(Constant::ISO_FORMAT_DATE_TIME)}} | {{Carbon\Carbon::parse($ip->updated_at)->locale(Constant::DEFAULT_COUNTRY_CODE)->isoFormat(Constant::ISO_FORMAT_DATE_TIME)}} | {{$details['invoice']->bank_account->currency->code . ' ' . number_format($ip->amount, 2, ',', '.')}} |
@endforeach
@endcomponent

@component('mail::panel')
Status: {{$details['status'] == Constant::TRUE_CONDITION ? 'Lunas (Paket Anda telah aktif)' : 'Kurang Bayar'}}
@endcomponent

@component('mail::button', ['url' => $details['url'], 'color' => 'primary'])
Lihat Pesanan Anda
@endcomponent

Terimakasih telah memilih {{config('app.name')}} sebagai platform Undangan Digital Anda untuk menyebarkan Kebahagian

Salam,<br>
{{ config('app.name') }}
@endcomponent