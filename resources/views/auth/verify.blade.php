@extends('layouts.master')
@section('title','Verifikasi')
@section('content')
@php $section_header = 'Verifikasi E-Mail'; @endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">{{ __('Verifikasi Email Anda Untuk Mengaktifkan Fitur ' . config('app.name')) }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Tautan verifikasi baru telah dikirim ke alamat Email Anda.') }}
                        </div>
                    @endif

                    {{ __('Harap periksa Email Anda untuk mendapatkan link tautan verifikasi.') }}
                    {{ __('Jika Anda tidak menerima Email, Silahkan klik tombol berikut untuk mengirim ulang tautan verifikasi.') }}
                    <form method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button id="btn-resend" type="submit" class="btn btn-primary btn-sm btn-block mt-2">{{ __('Kirim ulang tautan verifikasi') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('page-script')
  <script>
    "use strict";
    $('button#btn-resend').on('click', function () {
        $(this).addClass('btn-progress');
    });
  </script>
@endpush