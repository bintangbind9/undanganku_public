@extends('layouts.master')
@section('title',$section_header)
@push('pages-style')
  <style>
  </style>
@endpush

@php
  $is_error = false;
  foreach ($template_users as $tu_no => $tu) {
    if ($errors->hasBag(strtolower($tu->template_category->name))) {
      $is_error = true;
      break;
    }
  }
@endphp

@section('content')
  <div class="section-body">
    {{--
      <h2 class="section-title">{{$section_header}}</h2>
      <p class="section-lead">
        Beberapa pilihan dapat diatur di sini.
      </p>
    --}}
    @include('layouts.alert')
    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h4>Kategori</h4>
          </div>
          <div class="card-body">
            <ul id="category-tab" class="nav nav-pills flex-column" role="tablist">
              @foreach ($template_users as $tu_no => $tu)
                <li class="nav-item">
                  <a class="nav-link {{$is_error ? ($errors->hasBag(strtolower($tu->template_category->name)) ? 'active show' : null) : (session('tab') ? (session('tab') == strtolower($tu->template_category->name) ? 'active show' : null) : ($tu_no <= 0 ? 'active show' : null))}}" id="{{strtolower($tu->template_category->name)}}-category-tab" data-toggle="tab" href="#{{strtolower($tu->template_category->name)}}-category-content" role="tab" aria-controls="{{strtolower($tu->template_category->name)}}" aria-selected="true">
                    {{$tu->template_category->name}}
                  </a>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="tab-content no-padding" id="category-content">
          @foreach ($template_users as $tu_no => $tu)
            <div class="tab-pane fade {{$is_error ? ($errors->hasBag(strtolower($tu->template_category->name)) ? 'active show' : null) : (session('tab') ? (session('tab') == strtolower($tu->template_category->name) ? 'active show' : null) : ($tu_no <= 0 ? 'active show' : null))}}" id="{{strtolower($tu->template_category->name)}}-category-content" role="tabpanel" aria-labelledby="{{strtolower($tu->template_category->name)}}-tab">
              <form id="{{strtolower($tu->template_category->name)}}-setting-form" action="{{route('setting.update',$tu->id)}}" method="POST">
                @csrf
                @method('patch')
                <div class="card" id="{{strtolower($tu->template_category->name)}}-setting-card">
                  <div class="card-header">
                    <h4>{{$tu->template_category->name}}</h4>
                  </div>
                  <div class="card-body">
                    {{-- <p class="text-muted">General</p> --}}
                    <div class="form-group row align-items-center">
                      <label for="{{strtolower($tu->template_category->name)}}-user-url" class="form-control-label col-sm-3 text-md-right">User URL</label>
                      <div class="col-sm-6 col-md-9">
                        <input type="text" name="{{strtolower($tu->template_category->name)}}_user_url" class="form-control input-user-url" id="{{strtolower($tu->template_category->name)}}-user-url" value="{{ old(strtolower($tu->template_category->name).'_user_url') ?? $tu->user_url }}">
                        <small>Your URL Address will be <u class="text-primary">{{route('invitation.index',[strtolower($tu->template_category->name),''])}}/<span id="{{strtolower($tu->template_category->name)}}_user_url_val">{{ old(strtolower($tu->template_category->name).'_user_url') ?? $tu->user_url }}</span></u></small>
                        @error(strtolower($tu->template_category->name) . '_user_url', strtolower($tu->template_category->name))
                          <p class="text-danger" style="font-size:12px;"><strong>{{ $message }}</strong></p>
                        @enderror
                      </div>
                    </div>
                    {{-- <p class="text-muted">Greeting</p> --}}
                    <div class="form-group row align-items-center">
                      <label for="{{strtolower($tu->template_category->name)}}-is-greeting-auto-apv" class="form-control-label col-sm-3 text-md-right">Greeting Auto Approved</label>
                      <div class="col-sm-6 col-md-9">
                        <label class="custom-switch" style="padding: 0px;">
                            <input type="checkbox" name="{{strtolower($tu->template_category->name)}}_is_greeting_auto_apv" id="{{strtolower($tu->template_category->name)}}-is-greeting-auto-apv" class="custom-switch-input" @if($tu->is_greeting_auto_approved == Constant::TRUE_CONDITION) checked @endif>
                            <span class="custom-switch-indicator"></span>
                            @error(strtolower($tu->template_category->name) . '_is_greeting_auto_apv', strtolower($tu->template_category->name))
                                <span class="custom-switch-description text-danger" style="font-size:12px;">{{ $message }}</span>
                            @enderror
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer bg-whitesmoke text-md-right">
                    {{--<button class="btn btn-outline-secondary btn-reset" type="reset" data-category="{{strtolower($tu->template_category->name)}}">Reset</button>--}}
                    <button class="btn btn-primary" onclick="$(this).addClass('btn-progress');">Simpan</button>
                  </div>
                </div>
              </form>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection

@section('modal')
@endsection

@push('page-script')
  <script>
    "use strict";

    //Update URL Invitation on input
    $('.input-user-url').on('input', function () {
      var pre_text = $(this).attr('name');
      $('#' + pre_text + '_val').text($(this).val());
    });
  </script>
@endpush
