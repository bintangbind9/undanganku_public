@extends('layouts.master')
@section('title','Add Guest Presence')
@push('pages-style')
<style></style>
@endpush

@section('content')
    @if ($errors->any())
      <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
          <button class="close" data-dismiss="alert">
            <span>×</span>
          </button>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </div>
      </div>
    @endif

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Konfirmasi Kehadiran Tamu</h4>
                    <div class="card-header-action">
                      <button class="btn-action btn btn-icon btn-primary" id="btn-save" data-toggle="tooltip" title="Save" onclick="$('#form-guest_presence-store').submit();"><i class="fas fa-save"></i></button>
                    </div>
                  </div> <!-- div card header -->
                  <div class="card-body">
                    <form id="form-guest_presence-store" action="{{route('guest_presence.store', $template_category->name)}}" method="POST">
                      @csrf
                      @method('post')
                      <input type="hidden" name="guest_id" value="{{ old('guest_id') ?? $guest->id }}">
                      <input type="hidden" name="guest_name" value="{{ old('guest_name') ?? $guest->name }}">
                      <div class="form-group">
                        <label @error('guest_name') class="text-danger" @enderror>Nama Tamu* @error('guest_name') | {{$message}} @enderror</label>
                        {{-- INPUT TEXT name="guest_name_view" DI BAWAH HANYA UNTUK KEPERLUAN VIEW SAJA --}}
                        <input type="text" class="form-control" name="guest_name_view" value="{{ old('guest_name') ?? $guest->name }}" disabled>
                      </div>
                      <div class="form-group">
                        <label @error('presence') class="text-danger" @enderror>Berapa yang hadir?* @error('presence') | {{$message}} @enderror</label>
                        <input type="number" class="form-control" name="presence" value="{{ old('presence') ?? (empty($guest->presence) ? Constant::MIN_PRESENCE_OF_EACH_GUEST : $guest->presence ) }}" min="{{Constant::MIN_PRESENCE_OF_EACH_GUEST}}" {{-- MAX dikecualikan: max="{{Constant::MAX_PRESENCE_OF_EACH_GUEST}}" --}} autofocus>
                        {{--<select name="presence" class="form-control" autofocus required>
                          @for ($i = Constant::MIN_PRESENCE_OF_EACH_GUEST; $i <= Constant::MAX_PRESENCE_OF_EACH_GUEST; $i++)
                            <option value="{{$i}}" @if ((old('presence') ?? (empty($guest->presence) ? Constant::MIN_PRESENCE_OF_EACH_GUEST : $guest->presence )) == $i) selected @endif>{{$i}}</option>
                          @endfor
                        </select>--}}
                      </div>
                      <div class="float-right">
                        <input type="submit" class="btn btn-primary" value="Simpan"/>
                      </div>
                    </form>
                  </div> <!-- div card body -->
                </div> <!-- div card -->
            </div> <!-- div set responsive -->
        </div> <!-- div row -->
    </div> <!-- section body -->
@endsection

@section('modal')
@endsection

@push('page-script')
<script>
  $(document).ready(function() {});

  @if (session('success'))
    let txt = `{{ session('success') }}`;
    Swal.fire({
      title: "Berhasil",
      text: txt.replaceAll('&quot;','"'),
      icon: "success"
    })
    .then((value) => {
      window.close();
    });
  @elseif (session('error'))
    let txt = `{{ session('error') }}`;
    Swal.fire({
      title: "Gagal!",
      text: txt.replaceAll('&quot;','"'),
      icon: "warning"
    })
    .then((value) => {
      window.close();
    });
  @endif
</script>

<!-- <script src="{{asset('assets/stisla/chart.js/dist/Chart.min.js')}}"></script> -->
<!-- <script src="{{asset('assets/js/page/modules-chartjs.js')}}"></script> -->
@endpush
