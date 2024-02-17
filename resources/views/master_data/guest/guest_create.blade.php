@extends('layouts.master')
@section('title',$section_header)
@section('content')
  <div class="section-body">
    @include('layouts.alert')
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>Tambah Tamu Undangan Kamu</h4>
          </div>
          <div class="card-body">
            <form action="{{route('guest.store')}}" method="POST">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label @error('nama_tamu') class="text-danger" @enderror>
                      Nama Tamu @error('nama_tamu') | {{$message}} @enderror
                    </label>
                    <input type="text" class="form-control" name="nama_tamu" placeholder="Nama Tamu" value="{{old('nama_tamu')}}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label @if ($errors->has('phone') || $errors->has('country_code_id')) class="text-danger" @endif>
                      Nomor Ponsel
                      @error('country_code_id') | {{$message}} @enderror
                      @error('phone') | {{$message}} @enderror
                    </label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <select class="btn btn-outline-secondary" name="country_code_id" style="width:90px;" required>
                          @foreach ($country_codes as $cc_no => $cc)
                            <option value="{{$cc->id}}" {{old('country_code_id') ? (old('country_code_id') == $cc->id ? 'selected' : null) : (Constant::DEFAULT_COUNTRY_CODE == $cc->iso_code ? 'selected' : null)}}>{{$cc->iso_code . ' ' . $cc->phone_code}}</option>
                          @endforeach
                        </select>
                      </div>
                      <input type="text" class="form-control" name="phone" placeholder="882-4334-7577" value="{{old('phone')}}">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group float-right">
                    {{--<button class="btn btn-warning mr-1" type="reset">Reset</button>--}}
                    <a href="{{route('guest.index')}}" class="btn btn-outline-secondary mr-1">Tutup</a>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('page-script')
  <script src="{{asset('assets/js/jquery.mask.js')}}"></script>
  <script>
    const mask_phone_string = '{{Constant::MASK_PHONE}}';
    $(document).ready(function() {
      $('input[name="phone"]').mask(mask_phone_string);
    });
  </script>
@endpush
