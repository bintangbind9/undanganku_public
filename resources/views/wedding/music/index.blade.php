@extends('layouts.master')
@section('title','Music')
@push('pages-style')
<style></style>
@endpush
@section('content')
    @include('layouts.alert')

        <div class="section-body">
          <div class="row">

            @foreach ($music as $no => $m)
            <div class="col-lg-6 col-md-6 col-12 col-sm-6">
            <form action="/dashboard/wedding/music/{{$m->id}}" method="POST">
            @csrf
            @method('patch')
              <div class="card">
                <div class="card-header">
                  <img style="float:left;" class="mr-3 rounded" width="50" src="{{ empty($m->image) ? asset('assets/img/icon-music-blue-trimmed.png') : asset('assets/img/wedding/music/'.$m->image) }}" alt="product">
                  <h4>{{$m->name}}</h4>
                  <div class="card-header-action">
                      <a href="#" id="btnPlay" class="btn btn-icon btn-outline-primary" data-toggle="modal" data-target="#playModal"
                        data-id="{{$m->id}}"
                        data-name="{{$m->name}}"
                        data-artist="{{$m->artist}}"
                        data-description="{{$m->description}}"
                        data-img="{{ empty($m->image) ? asset('assets/img/icon-music-blue-trimmed.png') : asset('assets/img/wedding/music/'.$m->image) }}"
                        data-action="/dashboard/wedding/music/{{$m->id}}"
                        data-path="{{asset('assets/file/musik/'.$m->path)}}"><i class="fas fa-play"></i> Play</a>
                      <span class="btn btn-icon btn-outline-primary" data-toggle="tooltip" title="" data-original-title="{{$m->description}}" aria-describedby=""><i class="fas fa-info"></i></span>
                    @if ($wedding_info[0]->music_id == $m->id)
                      <span class="badge badge-warning"><i class="fas fa-check"></i> Dipilih</span>
                    @else
                      <button class="btn btn-icon btn-primary" type="submit" data-toggle="tooltip" data-original-title="Pilih"><i class="fas fa-check"></i></button>
                    @endif
                  </div>
                </div>
                {{-- <div class="card-body">
                  <audio data-id="{{$m->id}}" controls controlslist="nodownload" style="height: 40px; width: 100%;">
                    <source src="{{asset('assets/file/musik/'.$m->path)}}" type="audio/mpeg">
                    Sorry, Your browser does not support the audio element.
                  </audio>
                </div> --}}
              </div>
            </form>
            </div>
            @endforeach

            @role('Admin')
            @else
              @if(count($music_user) > 0)

                @foreach ($music_user as $no => $mu)
                <div class="col-lg-6 col-md-6 col-12 col-sm-6">
                  <div class="card">
                    <div class="card-header">
                      <img style="float:left;" class="mr-3 rounded" width="50" src="{{ empty($mu->image) ? asset('assets/img/icon-music-blue-trimmed.png') : asset('assets/img/wedding/music/'.$mu->image) }}" alt="product">
                      <h4>{{$mu->name}}</h4>
                      <div class="card-header-action">
                          <a href="#" id="btnPlay" class="btn btn-icon btn-outline-primary" data-toggle="modal" data-target="#playModal"
                            data-id="{{$mu->id}}"
                            data-name="{{$mu->name}}"
                            data-artist="{{$mu->artist}}"
                            data-description="{{$mu->description}}"
                            data-img="{{ empty($mu->image) ? asset('assets/img/icon-music-blue-trimmed.png') : asset('assets/img/wedding/music/'.$mu->image) }}"
                            data-action="/dashboard/wedding/music/{{$mu->id}}"
                            data-path="{{asset('assets/file/musik/'.$mu->path)}}"><i class="fas fa-play"></i> Play</a>
                          <button class="btn btn-icon btn-outline-primary" data-toggle="tooltip" data-original-title="Edit"
                                  data-id="{{$mu->id}}"
                                  data-name="{{$mu->name}}"
                                  data-path="{{$mu->path}}"
                                  data-path_old="{{$mu->path}}"
                                  data-url="{{route('wedding.music.updatemusic',$mu->id)}}"
                                  onclick="
                                    $('#formUpdateMusikUser').attr('action', $(this).data('url'));
                                    $('#id_update').val($(this).data('id'));
                                    $('#name_update').val($(this).data('name'))
                                    $('#path_old').val($(this).data('path_old'))
                                    $('#editMusicModal').modal('show');
                                  "><i class="fas fa-edit"></i></button>
                          <button class="btn btn-icon btn-outline-danger swal-confirm" data-toggle="tooltip" data-original-title="Delete"
                                  data-url="{{route('wedding.music.destroy',$mu->id)}}"><i class="fas fa-trash"></i></button>
                        @if ($wedding_info[0]->music_id == $mu->id)
                          <span class="badge badge-warning"><i class="fas fa-check"></i> Dipilih</span>
                        @else
                          <button class="btn btn-icon btn-primary" data-toggle="tooltip" data-original-title="Pilih"
                                  data-url="/dashboard/wedding/music/{{$mu->id}}"
                                  onclick="
                                    $('#formPilihMusikUser').attr('action', $(this).data('url'));
                                    $('#btnPilihMusikUser').click();
                                  "><i class="fas fa-check"></i></button>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach

              @else
                <div class="col-lg-6 col-md-6 col-12 col-sm-6">
                    <div class="card">
                      <div class="card-header">
                        <img style="float:left;" class="mr-3 rounded" width="50" src="{{asset('assets/img/icon-file-upload-trimmed.png')}}" alt="product">
                        <h4>Upload musik favorit kamu</h4>
                        <div class="card-header-action">
                          <button class="btn btn-icon btn-primary" data-toggle="modal" data-target="#uploadMusicModal"><i class="fas fa-upload"></i></button>
                        </div>
                      </div>
                    </div>
                </div>
              @endif
            @endrole

          </div>
        </div>

<!-- Dont Try This at Home! Wkwkwkwkwkwk -->
<div style="display:none;">
  <form id="formPilihMusikUser" action="" method="POST">
    @csrf
    @method('patch')
    <button id="btnPilihMusikUser" class="btn btn-icon btn-primary" type="submit"><i class="fas fa-check"></i></button>
  </form>
</div>

<div style="display:none;">
  <form id="formDeleteMusikUser" action="" method="POST">
    @csrf
    @method('delete')
    <!-- <button id="btnDeleteMusikUser" class="btn btn-icon btn-danger" type="submit"><i class="fas fa-trash"></i></button> -->
  </form>
</div>

@endsection

@section('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="playModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="playTitle" class="modal-title">Play Musik</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="playForm" action="" method="POST">
            @csrf
            @method('patch')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                          <div class="text-center" style="margin-bottom: 10px;"><img id="playImg" src="" height="120px"></div>
                          <h6 id="playArtist" class="text-center">Artist</h6>
                          <div id="accordion">
                            <div class="accordion">
                              <div class="accordion-header collapsed" role="button" data-toggle="collapse" data-target="#panel-body-1" aria-expanded="false">
                                <h4><i class="fas fa-info-circle"></i> Details</h4>
                              </div>
                              <div class="accordion-body collapse" id="panel-body-1" data-parent="#accordion" style="">
                                <p id="playDesc" class="mb-0">Description</p>
                              </div>
                            </div>
                          </div>
                        </div>
                        {{-- <div class="col-md-12">
                          <audio id="player" controls controlslist="nodownload" style="height: 40px; width: 100%;">
                            <source id="srcPlayer" src="" type="audio/mpeg">
                            Sorry, Your browser does not support the audio element.
                          </audio>
                        </div> --}}
                    </div>
                    <div class="media">
                      <span id="btnPlayPause" class="badge badge-primary mr-2"><i id="btnPlayPauseIcon" class="fas fa-play"></i></span>
                      <div class="media-body">
                        <div id="player"></div>
                      </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                <button type="submit" class="btn btn-primary">Pilih</button>
                </div>
            </div>
        </form>
    </div>
  </div>
</div>

{{-- Upload Music Modal --}}
<div class="modal fade" tabindex="-1" role="dialog" id="uploadMusicModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Upload Musik Kamu</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('wedding.music.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label @error('name')
                class="text-danger"
                @enderror>Nama Musik* @error('name') | {{$message}} @enderror
                </label>
                <input type="text" name="name" class="form-control" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label @error('path')
                class="text-danger"
                @enderror>File Musik* @error('path') | {{$message}} @enderror
                </label>
                <div class="custom-file">
                  <input type="file" id="file-path" name="path" class="file-input custom-file-input" accept=".mp3" required>
                  <label class="custom-file-label" for="file-path">Pilih berkas</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-add">Upload</button>
        </div>
        </form>
      </div>
    </div>
</div>

{{-- Edit Music Modal --}}
<div class="modal fade" tabindex="-1" role="dialog" id="editMusicModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Musik Kamu</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="formUpdateMusikUser" action="" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label @error('name_update')
                class="text-danger"
                @enderror>Nama Musik* @error('name_update') | {{$message}} @enderror
                </label>
                <input type="hidden" name="id_update" id="id_update">
                <input type="text" name="name_update" id="name_update" class="form-control" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label @error('path_update')
                class="text-danger"
                @enderror>File Musik* @error('path_update') | {{$message}} @enderror
                </label>
                <div class="custom-file">
                  <input type="file" id="path_update" name="path_update" class="file-input custom-file-input" accept=".mp3" required>
                  <label class="custom-file-label" for="path_update">Pilih berkas</label>
                </div>
                <input type="hidden" name="path_old" id="path_old" class="form-control" required>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
</div>

{{-- Buy a Package Modal --}}
  @if (session('buypackage'))
    <div class="modal fade" id="modalBuyPackage" tabindex="-1" role="dialog" aria-labelledby="modalBuyPackageLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalBuyPackageLabel">Buy a Package</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p><span class="text-danger">Oops! Kamu tidak punya Paket Aktif atau Paket Kamu tidak support Custom Music.</span> <span class="text-primary">Beli Paket <b>{{session('buypackage')->name}}</b></span> yang disarankan agar Kamu bisa pakai Musik Favorit Kamu sendiri.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <a href="{{route('subscribe.index.package_id',session('buypackage')->id)}}" class="btn btn-primary">Beli <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  @endif
@endsection

@push('page-script')
<script src="https://unpkg.com/wavesurfer.js"></script>

<script>

  // var player = document.getElementById("player");
  // var player = $('#player').get(0);
  var player = WaveSurfer.create({
    container: '#player',
    // backend: 'MediaElement', //Langsung Play Walaupun belum selesai draw. Tapi efeknya tidak bisa klik di progress music, dan icon play/pause perlu disesuaikan.
    waveColor: 'gray',
    progressColor: '#6777ef',
    height: 30,
    cursorColor: '#6777ef',
    responsive: true,
    // mediaControls: true // Jika Pake Media Elements
  });

  // Jika Pake WaveSurfer
  player.on('ready', function () {
    $('#btnPlayPause').removeClass('disabled btn-progress');
    $('#btnPlayPauseIcon').removeClass('fa-play');
    $('#btnPlayPauseIcon').addClass('fa-pause');
    player.play();
  });

  player.on('finish', function () {
    $('#btnPlayPauseIcon').addClass('fa-play');
    $('#btnPlayPauseIcon').removeClass('fa-pause');
  });

  $("#playModal").on('shown.bs.modal', function(){
    $('#btnPlayPause').addClass('disabled btn-progress');
  });

  $('#playModal').on('hide.bs.modal', function () {
    $('#btnPlayPauseIcon').addClass('fa-play');
    $('#btnPlayPauseIcon').removeClass('fa-pause');
    player.pause();
  });

  $(document).on('click', '#btnPlay', function() {
    // $("#srcPlayer").attr("src", $(this).data('path')); // Jika pake tag audio bawaan
    $("#playTitle").text($(this).data('name'));
    $("#playForm").attr("action", $(this).data('action'));
    $("#playDesc").text($(this).data('description'));
    $("#playArtist").text($(this).data('artist'));
    $("#playImg").attr("src", $(this).data('img'));
    // player.load(); // Jika pake tag audio bawaan
    player.load($(this).data('path')); // Jika pake WaveSurfer
    // player.play(); // Jika pake tag audio bawaan maka aktifkan! Jika tidak maka matikan!
  });

  $('#btnPlayPause').click(function () {
    $('#btnPlayPauseIcon').toggleClass('fa-play')
    $('#btnPlayPauseIcon').toggleClass('fa-pause')
    player.playPause();
  });

  $(".swal-confirm").click(function(e) {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      reverseButtons: true
    })
    .then((result) => {
      if (result.isConfirmed) {
        Swal.fire({ title: 'Success', icon: 'success' });
        $('#formDeleteMusikUser').attr('action', $(this).data('url'));
        $('#formDeleteMusikUser').submit();
        // $('#btnDeleteMusikUser').click();
      }
    });
  });

  function setFileNull(input) {
    input.val(null);
    $('.custom-file-label[for="' + input.attr('id') + '"]').text('Pilih berkas');
  }

  $('.file-input').change(function () {
    if ($(this).val() != "") {
      const allowedExtensions =  ['mp3'],
      sizeLimit = '{{Constant::MAX_FILE_MUSIC_SIZE_LIMIT}}';
      const { name:fileName, size:fileSize } = this.files[0];
      const fileExt = fileName.split(".").pop().toLowerCase();
      // const fileName = $(this).val().split('\\').pop().toLowerCase();

      if (!allowedExtensions.includes(fileExt)) {
        Swal.fire({ title: 'Format file harus .mp3!', icon: 'warning' });
        // this.value = null;
        setFileNull($(this));
        return false;
      } else if (fileSize > sizeLimit) {
        Swal.fire({ title: 'Ukuran file maksimal ' + sizeLimit / 1000000 + 'MB!', icon: 'warning' });
        // this.value = null;
        setFileNull($(this));
        return false;
      } else {
        $('.custom-file-label[for="' + $(this).attr('id') + '"]').text(fileName);
      }
    } else {
      setFileNull($(this));
    }
  });

  @if($errors->has('name') || $errors->has('path'))
    $('#uploadMusicModal').modal('show');
  @endif

  @if($errors->has('name_update') || $errors->has('path_update'))
    $('#editMusicModal').modal('show');
  @endif

  @if(session('buypackage'))
    $('#modalBuyPackage').modal('show');
  @endif
</script>

<!-- <script src="{{asset('assets/stisla/chart.js/dist/Chart.min.js')}}"></script> -->
<!-- <script src="{{asset('assets/js/page/modules-chartjs.js')}}"></script> -->
@endpush
