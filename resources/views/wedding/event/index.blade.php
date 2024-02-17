@extends('layouts.master')
@section('title','Wedding Event')

@push('pages-style')
<link rel="stylesheet" href="https://cdn.plyr.io/3.6.9/plyr.css" />
<style>
  .display-none {display: none;}
  .embedded-map {}
</style>
@endpush

@section('content')
    @include('layouts.alert')

    @if($errors->any())
    {!! implode('', $errors->all('<div class="alert alert-danger alert-dismissible show fade">
      <div class="alert-body">
        <button class="close" data-dismiss="alert">
          <span>×</span>
        </button>
        :message
      </div>
    </div>')) !!}
    @endif

    <div class="section-body">
        <div class="row">
            @foreach($events as $e)
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>{{empty($e->name) ? $e->event_type->name : $e->name}}</h4>
                    <div class="card-header-action">
                      <button class="btn-action btn btn-icon btn-primary" id="edit-btn{{$e->event_type_id}}" data-toggle="tooltip" title="Edit" data-id="{{$e->event_type_id}}" data-type="edit"><i class="fas fa-edit"></i></button>
                      <button class="btn-action btn btn-icon btn-primary display-none" id="save-btn{{$e->event_type_id}}" data-toggle="tooltip" title="Save" data-id="{{$e->event_type_id}}" data-type="save"><i class="fas fa-save"></i></button>
                      <button class="btn-action btn btn-icon btn-warning display-none" id="cancel-btn{{$e->event_type_id}}" data-toggle="tooltip" title="Cancel" data-id="{{$e->event_type_id}}" data-type="cancel"><i class="fas fa-times"></i></button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="tab-content" id="tabContent{{$e->event_type_id}}">
                      <div class="tab-pane fade" id="edit-form{{$e->event_type_id}}" role="tabpanel">
                        <form id="form-update-event{{$e->event_type_id}}" class="form-update-event" data-id="{{$e->event_type_id}}" action="{{route('event.update', $e->event_type_id)}}" method="POST">
                        @csrf
                        @method('put')
                          <div class="form-group">
                            <label @error('name'.$e->event_type_id) class="text-danger" @enderror>Ganti Nama Acara @error('name'.$e->event_type_id) | {{$message}} @enderror</label>
                            <input type="text" class="form-control" name="name{{$e->event_type_id}}" value="{{ old('name'.$e->event_type_id) ? old('name'.$e->event_type_id) : (empty($e->name) ? $e->event_type->name : $e->name) }}" placeholder="Pemberkatan, Upacara Nikah, dll.">
                          </div>
                          <div class="form-group">
                            <label @error('startdate'.$e->event_type_id) class="text-danger" @enderror>Mulai Acara* @error('startdate'.$e->event_type_id) | {{$message}} @enderror</label>
                            {{-- <input type="datetime-local" class="form-control" data-type="start" data-id="{{$e->event_type_id}}" name="startdate{{$e->event_type_id}}" max="{{ empty($e->enddate) ? '' : Carbon\Carbon::parse($e->enddate)->format('Y-m-d\TH:i') }}" value="{{ old('startdate'.$e->event_type_id) ? old('startdate'.$e->event_type_id) : Carbon\Carbon::parse($e->startdate)->format('Y-m-d\TH:i') }}"> --}}
                            <input type="datetime-local" class="form-control" data-type="start" data-id="{{$e->event_type_id}}" name="startdate{{$e->event_type_id}}" min="{{Carbon\Carbon::now()->format('Y-m-d\TH:i')}}" value="{{ old('startdate'.$e->event_type_id) ? old('startdate'.$e->event_type_id) : Carbon\Carbon::parse($e->startdate)->format('Y-m-d\TH:i') }}">
                          </div>
                          <div class="form-group">
                            <label @error('enddate'.$e->event_type_id) class="text-danger" @enderror>Selesai Acara* @error('enddate'.$e->event_type_id) | {{$message}} @enderror</label>
                            <input type="datetime-local" class="form-control" data-type="end" data-id="{{$e->event_type_id}}" name="enddate{{$e->event_type_id}}" {{-- Untuk validasi MIN di frontend hanya di startdate saja, sedangkan enddate validasi di server side: min="{{ empty($e->startdate) ? '' : Carbon\Carbon::parse($e->startdate)->format('Y-m-d\TH:i') }}" --}} value="{{ old('enddate'.$e->event_type_id) ? old('enddate'.$e->event_type_id) : Carbon\Carbon::parse($e->enddate)->format('Y-m-d\TH:i') }}">
                          </div>
                          <div class="form-group">
                            <label @error('place'.$e->event_type_id) class="text-danger" @enderror>Tempat* @error('place'.$e->event_type_id) | {{$message}} @enderror</label>
                            <input type="text" class="form-control" name="place{{$e->event_type_id}}" value="{{ old('place'.$e->event_type_id) ? old('place'.$e->event_type_id) : $e->place }}" placeholder="Balai Sudirman Jakarta">
                          </div>
                          <div class="form-group">
                            <label @error('address'.$e->event_type_id) class="text-danger" @enderror>Alamat* @error('address'.$e->event_type_id) | {{$message}} @enderror</label>
                            <textarea class="form-control" name="address{{$e->event_type_id}}" rows="6" placeholder="Jl. Dr. Saharjo No.268, RT.1/RW.4, Menteng Dalam, Kec. Tebet, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12870">{{ old('address'.$e->event_type_id) ? old('address'.$e->event_type_id) : $e->address }}</textarea>
                          </div>
                          <div class="form-group">
                            <label>Map</label>
                            {{-- <a href="{{$linkHowToMap}}" target="_blank"><i class="fas fa-question-circle"></i></a> --}}
                            <a data-toggle="tooltip" title="Help" onclick="$('#playModal').modal('show');"><i class="fas fa-question-circle"></i></a>
                            <div id="edit-embedded-map{{$e->event_type_id}}" class="embedded-map">{!! old('map'.$e->event_type_id) ? old('map'.$e->event_type_id) : $e->map !!}</div>
                            <textarea data-id="{{$e->event_type_id}}" class="txtAreaMap form-control" name="map{{$e->event_type_id}}" rows="6" placeholder="Tempelkan Peta yang disematkan di sini!">{{ old('map'.$e->event_type_id) ? old('map'.$e->event_type_id) : $e->map }}</textarea>
                          </div>
                          <div class="float-right">
                            <input type="submit" class="btn btn-primary" value="Simpan"/>
                          </div>
                        </form>
                      </div>
                      <div class="tab-pane fade active show" id="view-form{{$e->event_type_id}}" role="tabpanel">
                        @if (empty($e->startdate) || empty($e->enddate) || empty($e->place) || empty($e->address))
                          <div class="empty-state">
                            <div class="empty-state-icon">
                              <i class="fas fa-question"></i>
                            </div>
                            <h2>Tidak ada data '{{empty($e->name) ? $e->event_type->name : $e->name}}'</h2>
                            <p class="lead">Anda belum mengisi data {{empty($e->name) ? $e->event_type->name : $e->name}}. Click Button Edit <span class="btn-action-info text-primary" style="cursor:pointer;" id="edit-btn-info{{$e->event_type_id}}" data-id="{{$e->event_type_id}}" data-type="edit"><i class="fas fa-edit"></i></span> untuk mengisi data {{empty($e->name) ? $e->event_type->name : $e->name}}.</p>
                          </div>
                        @else
                          <div class="form-group">
                            <label><i class="fas fa-calendar"></i> Tanggal Acara</label>
                            @if (empty($e->startdate) || empty($e->enddate))
                            <p>-</p>
                            @else
                              @if (Carbon\Carbon::parse($e->startdate)->format('d-M-Y') == Carbon\Carbon::parse($e->enddate)->format('d-M-Y'))
                              <p>{{ Carbon\Carbon::parse($e->startdate)->format('d-M-Y') }}</p>
                              @else
                              <p>{{ Carbon\Carbon::parse($e->startdate)->format('d-M-Y') }} s.d. {{ Carbon\Carbon::parse($e->enddate)->format('d-M-Y') }}</p>
                              @endif
                            @endif
                          </div>
                          <div class="form-group">
                            <label><i class="fas fa-clock"></i> Waktu Acara</label>
                            @if (empty($e->startdate) || empty($e->enddate))
                            <p>-</p>
                            @else
                              @if (Carbon\Carbon::parse($e->startdate)->format('H:i') == Carbon\Carbon::parse($e->enddate)->format('H:i'))
                              <p>{{ Carbon\Carbon::parse($e->startdate)->format('H:i') }}</p>
                              @else
                              <p>{{ Carbon\Carbon::parse($e->startdate)->format('H:i') }} - {{ Carbon\Carbon::parse($e->enddate)->format('H:i') }}</p>
                              @endif
                            @endif
                          </div>
                          <div class="form-group">
                            <label><i class="fas fa-map-marker-alt"></i> Lokasi</label>
                            @if (empty($e->place) || empty($e->address))
                            <p>-</p>
                            @else
                            <p>{{$e->place}}, {{$e->address}}</p>
                            @endif
                            <div id="view-embedded-map{{$e->event_type_id}}" class="embedded-map">{!! empty($e->map) ? '' : $e->map !!}</div>
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            @endforeach
        </div> <!-- div row -->
    </div> <!-- section body -->

@endsection

@section('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="playModal">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="playTitle" class="modal-title">How to embedded Google Maps</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              {{-- <video id="player" width="100%" height="100%" controls controlsList="nodownload">
                <source src="{{asset('assets/file/video/'.$videoFile)}}" type="video/mp4">
                Sorry, Your browser does not support the video tag.
              </video> --}}
              <div class="plyr__video-embed" id="player">
                <iframe
                  src="{{$linkHowToMap}}"
                  allowfullscreen
                  allowtransparency
                  allow="autoplay"
                ></iframe>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
@endsection

@push('page-script')
<script src="https://cdn.plyr.io/3.6.9/plyr.polyfilled.js"></script>

<script>
  $(document).ready(function() {});

  const player = new Plyr('#player'); // Menggunakan js Plyr

  var strEmbeddedMapResult = "";

  // var player = $('#player').get(0); // Without js Plyr

  // $("#playModal").on('shown.bs.modal', function(){
  //   player.load();
  //   player.play();
  // });

  $('#playModal').on('hide.bs.modal', function () {
    player.pause();
  });

  $(".btn-action").click(function(e) {
    if ($(this).data('type') == 'edit') {
      $(this).toggleClass('display-none');
      $('#save-btn' + $(this).data('id')).toggleClass('display-none');
      $('#cancel-btn' + $(this).data('id')).toggleClass('display-none');
      $('#edit-form' + $(this).data('id')).toggleClass('active show');
      $('#view-form' + $(this).data('id')).toggleClass('active show');
    } else if ($(this).data('type') == 'save') {
      // $('#edit-btn' + $(this).data('id')).toggleClass('display-none');
      // $(this).toggleClass('display-none');
      // $('#cancel-btn' + $(this).data('id')).toggleClass('display-none');
      // $('#edit-form' + $(this).data('id')).toggleClass('active show');
      // $('#view-form' + $(this).data('id')).toggleClass('active show');

      $('#form-update-event' + $(this).data('id')).submit();
    } else if ($(this).data('type') == 'cancel') {
      $('#edit-btn' + $(this).data('id')).toggleClass('display-none');
      $('#save-btn' + $(this).data('id')).toggleClass('display-none');
      $(this).toggleClass('display-none');
      $('#edit-form' + $(this).data('id')).toggleClass('active show');
      $('#view-form' + $(this).data('id')).toggleClass('active show');
    }
  });

  function replaceWidthAndHeight(item, index) {
    if (item.substring(0, 5) == "width") {
      strEmbeddedMapResult += " " + item.replace(item, 'width="100%"');
    } else if (item.substring(0, 6) == "height") {
      strEmbeddedMapResult += " " + item.replace(item, 'height="100%"');
    } else {
      strEmbeddedMapResult += " " + item;
    }
  }

  $('.txtAreaMap').change(function(e) {
    // $('#edit-embedded-map' + $(this).data('id')).replaceWith($(this).val());

    strEmbeddedMapResult = "";
    var strEmbeddedMap = $(this).val().toLowerCase();
    var strArray = strEmbeddedMap.split(" ");
    strArray.forEach(replaceWidthAndHeight);
    $(this).text(strEmbeddedMapResult.trim());
    $(this).val(strEmbeddedMapResult.trim());
    $('#edit-embedded-map' + $(this).data('id')).html(strEmbeddedMapResult.trim());
  });

// $('input[type="datetime-local"]').change(function() {
//   var id = $(this).data('id');

//   var now = "{{Carbon\Carbon::now()->format('Y-m-d\TH:i')}}";
//   if ($(this).val() < now) {
//     $(this).val(now);
//   }

//   if ($(this).data('type') == 'start') {
//     $('input[name="enddate' + id + '"]').attr('min',$('input[name="startdate' + id + '"]').val());
//     if ($('input[name="enddate' + id + '"]').val() < $('input[name="startdate' + id + '"]').val()) {
//       $('input[name="enddate' + id + '"]').val($('input[name="startdate' + id + '"]').val());
//       // $('input[name="startdate' + id + '"]').attr('max',$('input[name="enddate' + id + '"]').val());
//     }
//   } else {
//     // $('input[name="startdate' + id + '"]').attr('max',$('input[name="enddate' + id + '"]').val());
//     if ($('input[name="startdate' + id + '"]').val() > $('input[name="enddate' + id + '"]').val()) {
//       $('input[name="startdate' + id + '"]').val($('input[name="enddate' + id + '"]').val());
//       $('input[name="enddate' + id + '"]').attr('min',$('input[name="startdate' + id + '"]').val());
//     }
//   }
// });

$(".btn-action-info").click(function(e) {
  $('#edit-btn' + $(this).data('id')).click();
});

@foreach($events as $e)
  @if($errors->has('name'.$e->event_type_id) || $errors->has('startdate'.$e->event_type_id) || $errors->has('enddate'.$e->event_type_id) || $errors->has('place'.$e->event_type_id) || $errors->has('address'.$e->event_type_id) || $errors->has('map'.$e->event_type_id))
    $('#edit-btn' + {{$e->event_type_id}}).click();
  @endif
@endforeach
</script>

<!-- <script src="{{asset('assets/stisla/chart.js/dist/Chart.min.js')}}"></script> -->
<!-- <script src="{{asset('assets/js/page/modules-chartjs.js')}}"></script> -->
@endpush
