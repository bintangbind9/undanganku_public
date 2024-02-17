@extends('layouts.master')
@section('title','Gallery')
@push('pages-style')
<link rel="stylesheet" href="{{asset('assets/css/dropzone.css')}}">
<style>
  .gallery-md .active {border-style: solid; border-radius: 8px; border-color: #6777ef;}
  .zoom-in {cursor: zoom-in;}
  .hide-me {display: none;}
  .gallery-item:hover > .hide-me {display: inline;}
  .cb-gallery-item {margin: 4px;}
</style>
@endpush

@section('content')
    @include('layouts.alert')

    @if ($errors->any())
      @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible show fade">
          <div class="alert-body">
            <button class="close" data-dismiss="alert">
              <span>×</span>
            </button>
            {{ $error }}
          </div>
        </div>
      @endforeach
    @endif

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Photo Sampul</h4>
                    <div class="card-header-action">
                      @if (!empty($wedding_info->photo_sampul)) <button id="btnDeletePhotoSampul" class="btn btn-icon btn-outline-danger swal-confirm" data-toggle="tooltip" title="Hapus" data-url="{{route('wedding.gallery.destroysampul', Auth::User()->id)}}"><i class="fas fa-trash"></i></button> @endif
                      <button class="btn btn-icon btn-primary" data-toggle="tooltip" title="Ganti" onclick="$('#changeSampulFile').click();"><i class="fas fa-edit"></i></button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div id="carouselExampleIndicators" class="carousel slide pointer-event" data-ride="carousel">
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                          @if(empty($wedding_info->photo_sampul))
                          <img onclick="$('#viewPictTitle').text($(this).attr('alt')); $('#viewPictImage').attr('src',$(this).attr('src')); $('#viewPictModal').modal('show');" class="d-block w-100 zoom-in" src="{{asset('assets/img/wedding-sampul.png')}}" alt="Photo Sampul - Default">
                          @else
                          <img onclick="$('#viewPictTitle').text($(this).attr('alt')); $('#viewPictImage').attr('src',$(this).attr('src')); $('#viewPictModal').modal('show');" class="d-block w-100 zoom-in" src="{{asset('assets/img/wedding/photo/sampul/'.$wedding_info->photo_sampul)}}" alt="Photo Sampul">
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Gallery</h4>
                        <div class="card-header-action">
                          @if ($countGallery > 0) <button id="btnEditGallery" class="btn btn-outline-primary" data-toggle="tooltip" title="Ganti Nama Photo"><i class="fas fa-edit"></i></button> @endif
                          <button id="btnAddGallery" class="btn btn-primary" data-toggle="tooltip" title="Tambah Photo" data-user="{{$wedding_info->user_id}}" data-limit="{{$limitGallery}}" onclick="$('#addGalleryModal').modal('show');"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>

                    <div class="card-body">
                      @if ($countGallery > 0)
                        <div id="carouselGallery" class="carousel slide pointer-event" data-ride="carousel">
                          <ol class="carousel-indicators">
                            @foreach($gallery as $no => $g)
                            <li id="a-{{$no}}" data-target="#carouselGallery" data-slide-to="{{$no}}" class="my-carousel-li {{ $no == 0 ? 'active' : null }}"></li>
                            @endforeach
                          </ol>
                          <div class="carousel-inner">
                            @foreach($gallery as $no => $g)
                            <div id="b-{{$no}}" class="my-carousel carousel-item {{ $no == 0 ? 'active' : null }}">
                              <img onclick="
                                            $('#viewPictTitle').text($(this).attr('alt'));
                                            $('#viewPictImage').attr('src',$(this).attr('src'));
                                            $('#viewPictModal').modal('show');
                                            " class="d-block w-100 zoom-in" src="{{asset('assets/img/wedding/photo/gallery/'.$g->photo)}}" alt="{{$g->name}}" data-id="{{$g->id}}">
                              <div class="carousel-caption d-none d-md-block">
                                <h5>{{$g->name}}</h5>
                              </div>
                            </div>
                            @endforeach
                          </div>
                          <a class="carousel-control-prev" href="#carouselGallery" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="carousel-control-next" href="#carouselGallery" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                          </a>
                        </div>

                        <div id="head-gallery-item" class="invisible" style="display: flex; justify-content: space-between;">
                          <span style="padding: 10px;"><input id="cb-all-gallery-item" type="checkbox"> All</input></span>
                          <span><button id="btnDeleteSelectedGalleryItem" class="btn swal-confirm" data-toggle="tooltip" title="Hapus photo yang dipilih" data-url="{{route('wedding.gallery.destroygalleries', Auth::User()->id)}}"><i class="fas fa-trash text-danger"></i></button></span>
                        </div>

                        <div id="wrap-gallery-item">
                          <div class="gallery gallery-md">
                              @for($i = 0; $i < 5; $i++)
                                @if($i < count($gallery))
                                <div id="my-gallery-md" class="gallery-item" data-slide-id="{{$i}}" data-image="{{asset('assets/img/wedding/photo/gallery/'.$gallery[$i]->photo)}}" data-title="{{$gallery[$i]->name}}" href="{{asset('assets/img/wedding/photo/gallery/'.$gallery[$i]->photo)}}" title="{{$gallery[$i]->name}}" style="background-image: url(&quot;{{asset('assets/img/wedding/photo/gallery/'.$gallery[$i]->photo)}}&quot;);"><input type="checkbox" data-photo="{{$gallery[$i]->photo}}" class="cb-gallery-item hide-me"></div>
                                @endif
                              @endfor
                              @if(count($gallery) > 6)
                                <div id="my-gallery-md" class="gallery-item gallery-more" data-slide-id="5" data-image="{{asset('assets/img/wedding/photo/gallery/'.$gallery[5]->photo)}}" data-title="{{$gallery[5]->name}}" href="{{asset('assets/img/wedding/photo/gallery/'.$gallery[5]->photo)}}" title="{{$gallery[5]->name}}" style="background-image: url(&quot;{{asset('assets/img/wedding/photo/gallery/'.$gallery[5]->photo)}}&quot;);"><input type="checkbox" data-photo="{{$gallery[5]->photo}}" class="cb-gallery-item hide-me" style="display:none;">
                                <div>+{{count($gallery) - 5}}</div>
                              @else
                                @if(count($gallery) > 5)
                                <div id="my-gallery-md" class="gallery-item" data-slide-id="5" data-image="{{asset('assets/img/wedding/photo/gallery/'.$gallery[5]->photo)}}" data-title="{{$gallery[5]->name}}" href="{{asset('assets/img/wedding/photo/gallery/'.$gallery[5]->photo)}}" title="{{$gallery[5]->name}}" style="background-image: url(&quot;{{asset('assets/img/wedding/photo/gallery/'.$gallery[5]->photo)}}&quot;);"><input type="checkbox" data-photo="{{$gallery[5]->photo}}" class="cb-gallery-item hide-me"></div>
                                @endif
                              @endif
                          </div>
                          @for($i = 6; $i < count($gallery); $i++)
                            <div id="my-gallery-md" class="gallery-item gallery-hide" data-slide-id="{{$i}}" data-image="{{asset('assets/img/wedding/photo/gallery/'.$gallery[$i]->photo)}}" data-title="{{$gallery[$i]->name}}" href="{{asset('assets/img/wedding/photo/gallery/'.$gallery[$i]->photo)}}" title="{{$gallery[$i]->name}}" style="background-image: url(&quot;{{asset('assets/img/wedding/photo/gallery/'.$gallery[$i]->photo)}}&quot;);"><input type="checkbox" data-photo="{{$gallery[$i]->photo}}" class="cb-gallery-item hide-me"></div>
                          @endfor
                        </div>
                      @else
                      <div class="text-center">
                        <h6>Click icon <span id="btnAddGalleryIcon" class="text-primary" style="cursor:pointer;"><i class="fas fa-plus"></i></span> untuk upload foto Kamu</h6>
                        <img src="{{asset('assets/img/no-image.svg')}}" onerror="this.onerror=null; this.src='{{asset('assets/img/no-image.png')}}'" width="50%">
                      </div>
                      @endif
                    </div> <!-- div card body -->
                </div> <!-- div card -->
            </div> <!-- div col-md gallery -->
        </div> <!-- div row -->
    </div> <!-- section body -->

<div style="display:none;">
  <form id="formDeletePhotoSampul" action="" method="POST">
    @csrf
    @method('put')
    <input type="hidden" name="photo_sampul_old" value="{{$wedding_info->photo_sampul}}">
  </form>
</div>
@endsection

@section('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="viewPictModal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="viewPictTitle" class="modal-title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <img id="viewPictImage" src="" style="width: 100%">
            </div>
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

{{-- Modal Change Photo Sampul --}}
<div class="modal fade" tabindex="-1" role="dialog" id="changeSampulModal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ganti Photo Sampul</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('wedding.gallery.updatesampul', Auth::User()->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="modal-body">
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <input type="hidden" name="photo_sampul_old" value="{{$wedding_info->photo_sampul}}">
              <input type="file" id="changeSampulFile" name="photo_sampul" class="form-control" accept=".jpg, .jpeg, .png" style="display:none;" required>
              <img id="changeSampulImage" src="" width="100%">
            </div>
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
</div>

{{-- Modal Add Photo Gallery --}}
<div class="modal fade" tabindex="-1" role="dialog" id="addGalleryModal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Gallery Photo Kamu</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <form id="addGalleryForm" action="{{route('gallery.store')}}" class="dropzone dz-clickable" method="post" enctype="multipart/form-data">
              @csrf
                {{-- <input type="file" id="addGalleryFile" name="photo_gallery" accept=".jpg, .jpeg, .png" style="display:none;" multiple required> --}}
                <div class="dz-default dz-message"><span>Drop files or click here to upload</span></div>
              </form>
            </div>
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
          {{-- <button type="submit" class="btn btn-primary" onclick="$('#addGalleryForm').submit();">Save changes</button> --}}
        </div>
      </div>
    </div>
</div>

{{-- Edit Gallery Modal --}}
<div class="modal fade" tabindex="-1" role="dialog" id="editGalleryModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <form action="{{route('gallery.update', Auth::User()->id)}}" method="POST">
        @csrf
        @method('put')

        <div class="modal-header">
          {{-- <h5 id="editGalleryTitle" class="modal-title"></h5> --}}
          <input id="editGalleryTitle" type="text" name="name_gallery" class="form-control" value="{{old('name_gallery')}}" placeholder="Ganti nama foto Kamu di sini.">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <label id="lbl-error-id-gallery" @error('id_gallery') class="text-danger" @enderror>@error('id_gallery') {{$message}} @enderror</label>
              <label id="lbl-error-name-gallery" @error('name_gallery') class="text-danger" @enderror>@error('name_gallery') {{$message}} @enderror</label>
              <label id="lbl-error-photo-gallery" @error('photo_gallery') class="text-danger" @enderror>@error('photo_gallery') {{$message}} @enderror</label>
              <input type="hidden" id="editGalleryPhotoID" name="id_gallery" value="{{old('id_gallery')}}">
              <input type="hidden" id="editGalleryPhotoName" name="photo_gallery" value="{{old('photo_gallery')}}">
              <img id="editGalleryImage" src="{{ old('photo_gallery') ? asset('assets/img/wedding/photo/gallery/'.old('photo_gallery')) : '' }}" style="width: 100%">
            </div>
          </div>
        </div>

        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

        </form>

      </div> <!-- modal-content -->
    </div>
</div>
@endsection

@push('page-script')
<script src="{{asset('assets/js/dropzone.js')}}"></script>

<script>
  $(document).ready(function() {
    checkForChanges();
  });

  Dropzone.autoDiscover = false;

  $('#addGalleryForm').dropzone({
    // url: "/ajax_file_upload_handler/",
    // paramName: "photo_gallery", // The name that will be used to transfer the file // Jika dikasih input type='file' name='photo_gallery'
    renameFile: function(file) {
      var dt = new Date();
      var time = dt.getTime();
      // return $('#btnAddGallery').data('user')+"_gallery_"+time+"."+file.name.split('.').pop();
      return '{{Auth::User()->id}}'+"_gallery_"+time+"."+file.name.split('.').pop();
    },
    maxFiles: $('#btnAddGallery').data('limit'),
    maxFilesize: '{{Constant::MAX_FILE_MUSIC_SIZE_LIMIT}}', // MB
    acceptedFiles: '.jpeg, .jpg, .png',
    addRemoveLinks: true,
    // dictRemoveFile: 'Hapus',
    // accept: function(file, done) {
    //   console.log(file);
    //   if (file.type != "image/jpeg") {
    //     done("Error! Files of this type are not accepted");
    //   }
    //   else { done(); }
    // },
    removedfile: function(file) {
      var name = file.upload.filename;
      // var url_delete = '/dashboard/wedding/gallery/' + name;
      // var url_delete = '{{url("dashboard/wedding/gallery/")}}' + '/' + name;
      var url_delete = '{{route("gallery.destroy","")}}' + '/' + name;
      $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'DELETE',
        url: url_delete,
        data: {filename: name},
        success: function (data) {
          // console.log("File has been successfully removed!!");
          console.log(data);
        },
        error: function(e) {
          console.log(e);
        }
      });

      // Untuk menghapus preview item waktu upload!
      var fileRef;
      return (fileRef = file.previewElement) != null ?
      fileRef.parentNode.removeChild(file.previewElement) : void 0;
    },
    success: function (file, response) {
      console.log(response);
    },
    fail: function(file, response) {
      Swal.fire(response);
    },
    // error: function(file, response) {
    //   return false;
    // },
  });

  $('#addGalleryModal').on('hidden.bs.modal', function () {
    location.reload();
  });

  function checkForChanges() {
    $('.my-carousel-li').each(function () {
      if ($(this).hasClass('active')){
        $('.gallery-item').removeClass('active');
        $('.gallery-item[data-slide-id="' + $(this).attr('data-slide-to') + '"]').addClass("active");
        setTimeout(checkForChanges, 500);
        return false; // to break
      }
    });
  }

  $('.gallery-more').on('click', function() {
    // Untuk munculin input type checkbox di class gallery-more
    $(this).find('input').removeAttr("style");

    $('div[id="wrap-gallery-item"]').css('height','182px');
    $('div[id="wrap-gallery-item"]').css('overflow','auto');
    $('.gallery-hide').removeClass("gallery-hide");
    $(this).removeClass("gallery-more");
    // $(this).addClass("important");
    // $(this).toggleClass("gallery-item gallery-more");
  });

  $('#cb-all-gallery-item').change(function () {
    if (this.checked) {
      $('.cb-gallery-item').prop('checked', true);
      $('.cb-gallery-item').removeClass('hide-me');
      $('.gallery-more').click();
    } else {
      $('.cb-gallery-item').prop('checked', false);
      $('.cb-gallery-item').addClass('hide-me');
      $('div[id="head-gallery-item"]').addClass('invisible');
    }
  });

  // function checkNothingChecked() {
  //   // Cara lain:
  //   var i = 0;

  //   $('.cb-gallery-item').each(function () {
  //     if(this.checked) {
  //       ++i
  //       return false;
  //     }
  //   });

  //   if (i < 1) {
  //     return true;
  //   } else {
  //     return false;
  //   }
  // }

  $('.cb-gallery-item').change(function() {
    if(this.checked) {
      $(this).removeClass('hide-me');
      $('div[id="head-gallery-item"]').removeClass('invisible');
    } else {
      $(this).addClass('hide-me');
      // if (checkNothingChecked()) {
      //   $('div[id="head-gallery-item"]').addClass('invisible');
      // }
      if ($('.cb-gallery-item:checkbox:checked').length == 0) {
        $('#cb-all-gallery-item').prop('checked', false);
        $('div[id="head-gallery-item"]').addClass('invisible');
      }
    }
  });

  $('div[id="my-gallery-md"]').on('click', function() {
    $('.my-carousel').removeClass('active');
    $('.my-carousel-li').removeClass('active');

    // untuk menghilangkan selected di gallery-item
    $('.gallery-item').removeClass('active');
    $(this).addClass("active");

    $('#a-' + $(this).attr('data-slide-id')).addClass("active");
    $('#b-' + $(this).attr('data-slide-id')).addClass("active");
  });

  $('#changeSampulModal').on('hidden.bs.modal', function () {
    $('#changeSampulFile').val("");
  });

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#changeSampulImage').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $('#changeSampulFile').change(function () {
    if ($(this).val() != "") {
      readURL(this);
      $('#changeSampulModal').modal('show');
    }
  });

  function deleteSelectedGalleryItem() {
    var allVals = [];
    $(".cb-gallery-item:checkbox:checked").each(function() {
      allVals.push($(this).data('photo'));
    });
    if(allVals.length <= 0) {
      // Ini harusnya udah gak perlu karena udah aku cek lewat swal-confirm
      alert("Please select row.");
    } else {
      // var check = confirm("Are you sure you want to delete selected row?");
      // if(check == true) {
        var join_selected_values = allVals.join(",");
        $.ajax({
          url: $('#btnDeleteSelectedGalleryItem').data('url'),
          type: 'PUT',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          data: {filenames: join_selected_values},
          // data: 'filenames=' + join_selected_values,
          success: function (data) {
            if (data['success']) {
              Swal.fire({ title: data['success'], icon: 'success' });
              location.reload();
            } else if (data['error']) {
              Swal.fire(data['error']);
            } else {
              Swal.fire('Whoops Something went wrong!!');
            }
          },
          error: function (data) {
            // Swal.fire(data.responseText);
            // Swal.fire('Whoops Something went wrong!!\n\n' + data.responseText);
            Swal.fire({ title: 'Whoops Something went wrong!!', icon: 'error' });
            location.reload();
          }
        });
      // }
    }
  };

  $(".swal-confirm").click(function(e) {
    var textConfirm;

    if ($(this).attr('id') == 'btnDeletePhotoSampul') {
      textConfirm = "You won't be able to revert this!";
    } else if ($(this).attr('id') == 'btnDeleteSelectedGalleryItem') {
      if ($('.cb-gallery-item:checkbox:checked').length > 0) {
        textConfirm = "You will delete " + $('.cb-gallery-item:checkbox:checked').length + " photo(s).";
      } else {
        Swal.fire('Please choose at least 1 photo!');
        return false;
      }
    }

    Swal.fire({
      title: 'Are you sure?',
      text: textConfirm,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      reverseButtons: true
    })
    .then((result) => {
      if (result.isConfirmed) {
        if ($(this).attr('id') == 'btnDeletePhotoSampul') {
          $('#formDeletePhotoSampul').attr('action', $(this).data('url'));
          $('#formDeletePhotoSampul').submit();
        } else if ($(this).attr('id') == 'btnDeleteSelectedGalleryItem') {
          deleteSelectedGalleryItem();
        }
      }
    });
  });

  $('#btnEditGallery').click(function () {
    var photoTitle = $('div[class="my-carousel carousel-item active"]').find('h5').text();
    // if ("{{old('name_gallery')}}" != "") {
    //   photoTitle = "{{old('name_gallery')}}"
    // } else {
    //   photoTitle = $('div[class="my-carousel carousel-item active"]').find('h5').text();
    // }
    var pathImageEdit = $('div[class="my-carousel carousel-item active"]').find('img').attr('src');
    if (pathImageEdit != null) {
      var photoName = pathImageEdit.split('/').pop();
    } else {
      return false; // To Break or Quit Function!
    }
    var photoId = $('div[class="my-carousel carousel-item active"]').find('img').data('id');

    $('label[id="lbl-error-id-gallery"]').text('');
    $('label[id="lbl-error-id-gallery"]').removeClass('text-danger');
    $('label[id="lbl-error-name-gallery"]').text('');
    $('label[id="lbl-error-name-gallery"]').removeClass('text-danger');
    $('label[id="lbl-error-photo-gallery"]').text('');
    $('label[id="lbl-error-photo-gallery"]').removeClass('text-danger');

    $('#editGalleryTitle').val(photoTitle);
    $('#editGalleryImage').attr('src',pathImageEdit);
    $('#editGalleryPhotoName').val(photoName);
    $('#editGalleryPhotoID').val(photoId);
    $('#editGalleryModal').modal('show');
  });

  @if($errors->has('id_gallery') || $errors->has('name_gallery') || $errors->has('photo_gallery'))
    $('#editGalleryModal').modal('show');
  @endif

  $('#btnAddGalleryIcon').click(function() {
    $('#btnAddGallery').click();
  });
</script>

<!-- <script src="{{asset('assets/stisla/chart.js/dist/Chart.min.js')}}"></script> -->
<!-- <script src="{{asset('assets/js/page/modules-chartjs.js')}}"></script> -->
@endpush
