@extends('layouts.master_user')
@section('title','Undangan Tidak Valid')
@push('pages-style')
<style></style>
@endpush

@section('content')
    @include('layouts.alert')
@endsection

@section('modal')
            <div class="row">
              <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h4>{{config('app.name')}}</h4>
                  </div>
                  <div class="card-body">
                    <div class="empty-state" data-height="400" style="height: 400px;">
                      <div class="empty-state-icon {{$icon_bg}}">
                        <i class="{{$icon_name}}"></i>
                      </div>
                      <h2>{{$error_title}}</h2>
                      <p class="lead">
                        {!!$error_msg!!}
                      </p>
                      <a href="{{$btn_link}}" class="btn btn-primary mt-4">{{$btn_txt}}</a>
                      {{-- <a href="#" class="mt-4 bb">Cancel</a> --}}
                    </div>
                  </div>
                </div>
              </div>
            </div>
@endsection

@push('page-script')
<script></script>
@endpush