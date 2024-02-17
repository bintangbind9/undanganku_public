
@extends('layouts.master')
@extends('layouts.header')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Verifikasi Email Anda</h4>
                </div>
                    <div class="card-body">
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('Resend Email Berhasil.') }}
                                </div>
                            @endif
                                <div class="empty-state" data-height="400">
                                    <div class="empty-state-icon">
                                            <i class="fa fa-envelope"></i>
                                    </div>
                                        <h2>Cek email anda , dan lakukan verifikasi agar akses menu terbuka</h2>
                                        <p class="lead">
                                            Jika anda tidak menerima email , harap tekan button resend dibawah ini.
                                        </p>
                                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                            @csrf
                                                <button class="btn btn-primary mt-4 baseline">Resend Email</button>
                                        </form>
                                {{-- <a href="#" class="mt-4 bb">Need Help?</a> --}}
                                </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
