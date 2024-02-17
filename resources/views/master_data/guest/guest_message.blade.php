@extends('layouts.master')
@section('title',$section_header)
@section('content')
    <div class="section-body">
        @include('layouts.alert')
        <div class="card">
            <div class="card-header">
                <h4>Pesan Untuk Tamu Undangan {{$template_category->name}} Anda</h4>
                <div class="card-header-action">
                    <button class="btn btn-icon btn-primary collapsed" type="button" data-toggle="collapse" data-target="#collapseHelp" aria-expanded="false" aria-controls="collapseHelp">
                        <i class="fas fa-question"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="collapse" id="collapseHelp">
                            <div class="card">
                                <div class="card-body">
                                    <div class="section-title mt-0">Bantuan</div>
                                    <p>Gunakan <i><u>Keyword</u></i> berikut untuk mendefinisikan Kata atau Kalimat tertentu.</p>
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">Keyword</th>
                                                <th scope="col">Definisi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{Constant::TEXT_CODE_GUEST}}</td>
                                                <td>Nama Tamu</td>
                                            </tr>
                                            <tr>
                                                <td>{{Constant::TEXT_CODE_GROOM}}</td>
                                                <td>Nama Pengantin Pria</td>
                                            </tr>
                                            <tr>
                                                <td>{{Constant::TEXT_CODE_BRIDE}}</td>
                                                <td>Nama Pengantin Wanita</td>
                                            </tr>
                                            <tr>
                                                <td>{{Constant::TEXT_CODE_START_DAY}}</td>
                                                <td>Hari acara dimulai</td>
                                            </tr>
                                            <tr>
                                                <td>{{Constant::TEXT_CODE_END_DAY}}</td>
                                                <td>Hari acara selesai</td>
                                            </tr>
                                            <tr>
                                                <td>{{Constant::TEXT_CODE_START_DATE}}</td>
                                                <td>Tanggal acara dimulai</td>
                                            </tr>
                                            <tr>
                                                <td>{{Constant::TEXT_CODE_END_DATE}}</td>
                                                <td>Tanggal acara selesai</td>
                                            </tr>
                                            <tr>
                                                <td>{{Constant::TEXT_CODE_START_TIME}}</td>
                                                <td>Waktu acara dimulai</td>
                                            </tr>
                                            <tr>
                                                <td>{{Constant::TEXT_CODE_END_TIME}}</td>
                                                <td>Waktu acara selesai</td>
                                            </tr>
                                            <tr>
                                                <td>{{Constant::TEXT_CODE_LOCATION}}</td>
                                                <td>Lokasi acara</td>
                                            </tr>
                                            <tr>
                                                <td>{{Constant::TEXT_CODE_LINK}}</td>
                                                <td>Link Undangan Tamu</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route('guest.message_update')}}" method="post">
                            @csrf
                            @method('patch')
                            <textarea id="summernote" name="message_guest">{{$template_user->message_guest ?? Constant::DEFAULT_GUEST_MESSAGE}}</textarea>
                            <div class="float-right">
                                <a href="{{route('guest.index')}}" class="btn btn-outline-secondary mr-1">Batal</a>
                                <button id="btn-reset" class="btn btn-outline-secondary mr-1" type="button" data-content="{{$template_user->message_guest ?? Constant::DEFAULT_GUEST_MESSAGE}}">Reset</button>
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
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

    $(document).ready(function() {
        $('#summernote').summernote({
            height: 350,
            toolbar: [
                ['style', ['bold', 'italic']],
                ['font', ['strikethrough']],
                ['view', [
                    'undo',
                    'redo',
                    // 'codeview'
                ]]
            ],
            placeholder: 'Tulis pesan untuk Tamu Anda di sini...',
            focus: true
        });
    });

    $('#btn-reset').on('click', function() {
        $('#summernote').summernote('code',$(this).data('content'));
    });
</script>
@endpush