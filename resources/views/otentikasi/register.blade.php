@extends('otentikasi.master')
@section('title','Register')
@section('content')
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
              <img src="{{asset('assets/img/Undanganajib.com-login.png')}}" alt="logo" width="50%">
            </div>

            <div class="card card-primary">
              <div class="card-header">
                <h4>Register</h4>
              </div>

              <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                  @csrf
                  <div class="row">
                    <div class="form-group col-lg-8 col-md-6 col-sm-6">
                      <label for="user_url">User URL</label>
                      <input id="user_url" type="text" class="form-control @error('user_url') is-invalid @enderror" name="user_url" value="{{ old('user_url') ?? $user_url }}" required autocomplete="user_url" autofocus placeholder="akudandia">
                      <small>Your URL Address will be <u class="text-primary">{{route('invitation.index',[strtolower(Constant::CODE_WEDDING),''])}}/<span id="user_url_val">{{ old('user_url') ?? $user_url }}</span></u></small>
                                @error('user_url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                      {{--
                        <label for="user_url">Your URL Address</label>
                        <div class="input-group">
                          <div class="input-group-prepend text-truncate">
                            <div class="input-group-text">{{route('invitation.index',[strtolower(Constant::CODE_WEDDING),''])}}/</div>
                          </div>
                          <input id="user_url" type="text" class="form-control @error('user_url') is-invalid @enderror" name="user_url" value="{{ old('user_url') ?? $user_url }}" required autocomplete="user_url" autofocus placeholder="akudandia">
                                  @error('user_url')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                        </div>
                      --}}
                    </div>

                    <div class="form-group col-lg-4 col-md-6 col-sm-6">
                      <label for="template_category_id">Category</label>
                      <select class="form-control @error('template_category_id') is-invalid @enderror" name="template_category_id" required @if (count($templateCategory) <= 1) disabled @endif>
                        @foreach ($templateCategory as $t)
                          <option value="{{$t->id}}" @if (old('template_category_id') == $t->id) selected @endif>{{$t->name}}</option>
                        @endforeach
                      </select>
                      @if (count($templateCategory) <= 1)
                        <input type="hidden" name="template_category_id" value="" readonly required>
                      @endif
                                @error('template_category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-lg-6 col-md-6 col-sm-6">
                      <label for="name">Name</label>
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nama Kamu">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-6">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        <div class="invalid-feedback">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-lg-6 col-md-6 col-sm-6">
                      <label for="password" class="d-block">Password</label>
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                      @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                      <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                      </div>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-6">
                      <label for="password-confirm" class="d-block">Password Confirmation</label>
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="agree" class="custom-control-input" id="agree" required>
                      <label class="custom-control-label" for="agree"><a href="#" data-toggle="modal" data-target="#tnc_register">Saya Setuju dengan Syarat dan Ketentuan</a></label>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Register
                    </button>
                  </div>
                  <div class="mt-5 text-muted text-center">
                    Already have an account?<a href="{{ route('login') }}"> Login</a>
                  </div>
                </form>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; <script>document.write(new Date().getFullYear());</script><a href="#">
                <i class="fa fa-at"></i> {{config('app.name')}}</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@section('modal')
  <div class="modal fade" id="tnc_register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Syarat dan Ketentuan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {!! Constant::TNC_HTML_CONTENT !!}
        </div>
        <div class="modal-footer">
          <button id="btn-tnc-ok" type="button" class="btn btn-primary btn-sm" data-dismiss="modal">OK</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('page-script')
  <!-- Page Specific JS File -->
  <!-- <script src="{{asset('assets/js/page/auth-register.js')}}"></script> -->
  <!-- JS Libraies -->
  <script src="{{asset('assets/stisla/jquery-pwstrength/jquery.pwstrength.min.js')}}"></script>
  <script src="{{asset('assets/stisla/selectric/public/jquery.selectric.min.js')}}"></script>

  <script>
    $(document).ready(function() {
      // Auto assign input type="hidden" name="template_category_id" on load
      @if (count($templateCategory) <= 1)
        $('input[name="template_category_id"]').val($('select[name="template_category_id"]').val());
      @endif
    });

    // Auto assign input type="hidden" name="template_category_id" on select change
    // Seharusnya bagian ini tidak perlu, karena kalo template category hanya 1, tidak ada input type hidden, dan select jadi enable
    // $('select[name="template_category_id"]').on('change', function () {
    //   $('input[name="template_category_id"]').val($(this).val());
    // });

    $('input#user_url').on('input', function () {
      $('#user_url_val').text($(this).val());
    });

    $('#btn-tnc-ok').on('click', function () {
      $('input[type="checkbox"]#agree').prop('checked', true);
    });
  </script>
@endpush