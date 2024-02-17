@extends('layouts.master')
@section('title','Brides')

@push('pages-style')
<style>
  .display-none {display: none;}
  .border-radius-10 {
    border-radius: 10px;
  }
  .custom-shadow {
    /* box-shadow: 6px 6px 13px -9px rgba(103,119,239,1);
    -webkit-box-shadow: 6px 6px 13px -9px rgba(103,119,239,1);
    -moz-box-shadow: 6px 6px 13px -9px rgba(103,119,239,1); */
    box-shadow: 0 0 15px rgba(33,33,33,.2);
  }

  .preview {
    overflow: hidden;
    width: 160px;
    height: 160px;
    margin: 10px;
    border: 1px solid red;
  }
  .my-img {
    display: block;
    max-width: 100%;
  }
  .my-shadow:hover {
    /* box-shadow: 0 0 6px rgba(35, 173, 278, 1); */
    box-shadow: 0 0 15px rgba(33,33,33,.2);
  }
</style>
@endpush

@section('content')
    @if (session('message'))
    <div class="alert alert-success alert-dismissible show fade">
      <div class="alert-body">
        <button class="close" data-dismiss="alert">
          <span>×</span>
        </button>
        {{session('message')}}
      </div>
    </div>
    @endif

    @if (session('fail'))
    <div class="alert alert-danger alert-dismissible show fade">
      <div class="alert-body">
        <button class="close" data-dismiss="alert">
          <span>×</span>
        </button>
        {{session('fail')}}
      </div>
    </div>
    @endif

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
            @foreach($brides as $b)
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Pengantin {{ $b->gender == 'L' ? 'Pria' : 'Wanita' }}</h4>
                    <div class="card-header-action">
                      <button class="btn-action btn btn-icon btn-primary" id="edit-btn{{$b->gender}}" data-toggle="tooltip" title="Edit" data-id="{{$b->gender}}" data-type="edit"><i class="fas fa-edit"></i></button>
                      <button class="btn-action btn btn-icon btn-primary display-none" id="save-btn{{$b->gender}}" data-toggle="tooltip" title="Save" data-id="{{$b->gender}}" data-type="save"><i class="fas fa-save"></i></button>
                      <button class="btn-action btn btn-icon btn-warning display-none" id="cancel-btn{{$b->gender}}" data-toggle="tooltip" title="Cancel" data-id="{{$b->gender}}" data-type="cancel"><i class="fas fa-times"></i></button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="text-center">
                      @csrf
                      @method('put')
                      @if (empty($b->photo))
                      <img id="photo{{$b->gender}}" alt="image" name="photo{{$b->gender}}" data-id="{{$b->gender}}" src="{{asset('assets/img/avatar/avatar-1.png')}}" class="rounded-circle my-shadow bride-photo" height="100" width="100" style="margin-bottom: 20px;">
                      <p id="default_image_url{{$b->gender}}" style="display:none;">{{asset('assets/img/avatar/avatar-1.png')}}</p>
                      @else
                      <img id="photo{{$b->gender}}" alt="image" name="photo{{$b->gender}}" data-id="{{$b->gender}}" src="{{asset('assets/img/wedding/photo/bride/'.$b->photo)}}" class="rounded-circle my-shadow bride-photo" height="100" width="100" style="margin-bottom: 20px;">
                      <p id="default_image_url{{$b->gender}}" style="display:none;">{{asset('assets/img/wedding/photo/bride/'.$b->photo)}}</p>
                      @endif
                      <input type="hidden" id="urlupdatephotobride{{$b->gender}}" value="{{route('updatephotobride',$b->gender)}}">
                      <input type="file" id="photoEdit{{$b->gender}}" name="photoEdit{{$b->gender}}" data-id="{{$b->gender}}" class="photoEdit" accept=".jpg, .jpeg, .png" style="display: none;" />
                    </div>
                    <div class="tab-content" id="tabContent{{$b->gender}}">
                      <div class="tab-pane fade" id="edit-form{{$b->gender}}" role="tabpanel">
                        <form id="form-update-bride{{$b->gender}}" class="form-update-bride" data-id="{{$b->gender}}" action="{{route('bride.update', $b->gender)}}" method="POST">
                        @csrf
                        @method('put')
                          <div class="form-group">
                            <label @error('name'.$b->gender) class="text-danger" @enderror>Nama* @error('name'.$b->gender) | {{$message}} @enderror</label>
                            <input type="text" class="form-control" name="name{{$b->gender}}" value="{{ old('name'.$b->gender) ? old('name'.$b->gender) : $b->name }}">
                          </div>
                          <div class="form-group">
                            <label @error('nickname'.$b->gender) class="text-danger" @enderror>Nama Panggilan* @error('nickname'.$b->gender) | {{$message}} @enderror</label>
                            <input type="text" class="form-control" name="nickname{{$b->gender}}" value="{{ old('nickname'.$b->gender) ? old('nickname'.$b->gender) : $b->nickname }}">
                          </div>
                          <div class="form-group">
                            <label @error('father'.$b->gender) class="text-danger" @enderror>Nama Ayah @error('father'.$b->gender) | {{$message}} @enderror</label>
                            <input type="text" class="form-control" name="father{{$b->gender}}" value="{{ old('father'.$b->gender) ? old('father'.$b->gender) : $b->father }}">
                          </div>
                          <div class="form-group">
                            <label @error('mother'.$b->gender) class="text-danger" @enderror>Nama Ibu @error('mother'.$b->gender) | {{$message}} @enderror</label>
                            <input type="text" class="form-control" name="mother{{$b->gender}}" value="{{ old('mother'.$b->gender) ? old('mother'.$b->gender) : $b->mother }}">
                          </div>
                          <div class="form-group">
                            <label @error('about'.$b->gender) class="text-danger" @enderror>Tentang @error('about'.$b->gender) | {{$message}} @enderror</label>
                            <textarea data-id="{{$b->gender}}" class="form-control" name="about{{$b->gender}}" rows="6" placeholder="Tentang Pengantin {{ $b->gender == 'L' ? 'Pria' : 'Wanita' }}...">{{ old('about'.$b->gender) ? old('about'.$b->gender) : $b->about }}</textarea>
                          </div>
                          <div class="float-right">
                            <input type="submit" class="btn btn-primary" value="Simpan" onclick="$(this).addClass('btn-progress');"/>
                          </div>
                        </form>
                      </div>
                      <div class="tab-pane fade active show" id="view-form{{$b->gender}}" role="tabpanel">
                        @if (empty($b->name) || empty($b->nickname))
                          <div class="text-center">
                            <h5>Tidak ada data Pengantin {{ $b->gender == 'L' ? 'Pria' : 'Wanita' }}</h5>
                            <p>Anda belum mengisi data Pengantin {{ $b->gender == 'L' ? 'Pria' : 'Wanita' }}. Click Button Edit <span class="btn-action-info text-primary" style="cursor:pointer;" id="edit-btn-info{{$b->gender}}" data-id="{{$b->gender}}" data-type="edit"><i class="fas fa-edit"></i></span> untuk mengisi data Pengantin {{ $b->gender == 'L' ? 'Pria' : 'Wanita' }}.</p>
                          </div>
                        @else
                          {{-- <h6 class="text-center">{{$b->name}}</h6>
                          <p class="text-center">({{$b->nickname}})</p> --}}
                          <h5 class="text-center"><strong class="text-primary">{{$b->name}}</strong> ({{$b->nickname}})</h5>
                          @if (!empty($b->father) && !empty($b->mother))
                            <p class="text-center">{{ $b->gender == 'L' ? 'Putra' : 'Putri' }} dari Bapak <strong>{{$b->father}}</strong>, dan Ibu <strong>{{$b->mother}}</strong>.</p>
                          @endif
                          @if (!empty($b->about))
                          <div class="card-body custom-shadow border-radius-10">
                            <p class="text-justify">{{$b->about}}</p>
                          </div>
                          @endif
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
{{-- Modal Crop Image --}}
<div class="modal fade" id="modalCropEdit" tabindex="-1" role="dialog" aria-labelledby="modalCropEditLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCropEditLabel">Crop Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="img-container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8">
                  <div class="d-flex justify-content-center">
                    <img id="imageEdit" class="my-img" src="https://avatars0.githubusercontent.com/u/3456749">
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                  <div class="d-flex justify-content-center">
                    <div class="preview"></div>
                  </div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="cropEdit"><i class="fas fa-crop"></i> Crop</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('page-script')
<script>
  $(document).ready(function() {});

  // variable crop image
  var $modalEdit = $('#modalCropEdit');
  var imageEdit = document.getElementById('imageEdit');
  var cropperEdit;
  var base64dataEdit = null;

  // additional variable
  var gender = "";
  // end variable crop image

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
      $('#form-update-bride' + $(this).data('id')).submit();
    } else if ($(this).data('type') == 'cancel') {
      $('#edit-btn' + $(this).data('id')).toggleClass('display-none');
      $('#save-btn' + $(this).data('id')).toggleClass('display-none');
      $(this).toggleClass('display-none');
      $('#edit-form' + $(this).data('id')).toggleClass('active show');
      $('#view-form' + $(this).data('id')).toggleClass('active show');
    }
  });

// Update Photo
$(".bride-photo").click(function() {
  $("input[id='photoEdit" + $(this).data('id') + "']").click();
});

$("body").on("change", ".photoEdit", function(e) {
  gender = $(this).data('id'); //additional
  const allowedExtensions =  ['jpg','jpeg','png'],
  sizeLimit = '{{Constant::MAX_FILE_SIZE_LIMIT}}';

  // destructuring file name and size from file object
  const { name:fileName, size:fileSize } = this.files[0];

  /*
  * if the filename is apple.png, we split the string to get ["apple","png"]
  * then apply the pop() method to return the file extension (png)
  *
  */
  const fileExtension = fileName.split(".").pop().toLowerCase();

  /*
  * check if the extension of the uploaded file is included
  * in our array of allowed file extensions
  */
  if (!allowedExtensions.includes(fileExtension)) {
    Swal.fire({ title: 'Format file harus .jpg, .jpeg, atau .png!', icon: 'warning' });
    this.value = null;
    return false;
  } else if (fileSize > sizeLimit) {
    Swal.fire({ title: 'Ukuran file maksimal ' + sizeLimit / 1000000 + 'MB!', icon: 'warning' });
    this.value = null;
    return false;
  } else {
    var files = e.target.files;
    var done = function (url) {
      imageEdit.src = url;
      $modalEdit.modal('show');
    };
    var reader;
    var file;
    var url;

    if (files && files.length > 0) {
      file = files[0];

      if (URL) {
        done(URL.createObjectURL(file));
      } else if (FileReader) {
        reader = new FileReader();
        reader.onload = function (e) {
          done(reader.result);
        };
        reader.readAsDataURL(file);
      }
    }
    return true;
  }
});

$modalEdit.on('shown.bs.modal', function() {
  cropperEdit = new Cropper(imageEdit, {
    aspectRatio: 1,
    viewMode: 3,
    preview: '.preview'
  });
}).on('hidden.bs.modal', function() {
  cropperEdit.destroy();
  cropperEdit = null;
  $("input[id='photoEdit" + gender + "']").val("");
});

$("#cropEdit").click(function() {
  canvasEdit = cropperEdit.getCroppedCanvas({
    width: 500,
    height: 500,
  });

  canvasEdit.toBlob(function(blob) {
    url = URL.createObjectURL(blob);
    var reader = new FileReader();
    reader.readAsDataURL(blob);
    reader.onloadend = function() {
      base64dataEdit = reader.result;
      $('#photo' + gender).attr('src', base64dataEdit);
      $modalEdit.modal('hide');

      // var id = $('#idUser').val();
      var urlUpdateImage = $('#urlupdatephotobride' + gender).val();

      $.ajax({
        type: "POST",
        dataType: "json",
        url: urlUpdateImage,
        data: {'_token': $('input[name="_token"]').val(), 'photo': base64dataEdit},
        success: function(data) {
          if (data['message']) {
            Swal.fire({ title: data['message'], icon: 'success' });
          } else if (data['fail']) {
            Swal.fire({ title: data['fail'], icon: 'error' });
          } else {
            Swal.fire({ title: 'Oops! maybe went wrong!', icon: 'warning' });
          }
        },
        error: function(xhr, ajaxOptions, thrownError) {
          Swal.fire({ title: 'Oops! Something went wrong! Nothing to update.', icon: 'error' });
          console.log(xhr.status);
        },
        complete: function () {
          console.log('Update Photo ' + gender + ' Complete.');
          location.reload();
        }
      });
    }
  });
  // photoChanged = 'true';
});
// End Update Photo

// Cosmetics
$('.bride-photo').hover(function() {
  $(this).attr('src','{{asset("assets/img/camera.png")}}')
  }, function() {
    $(this).attr("src",$("#default_image_url" + $(this).data('id')).text())
  }
);

$(".btn-action-info").click(function(e) {
  $('#edit-btn' + $(this).data('id')).click();
});

@foreach($brides as $b)
  @if($errors->has('name'.$b->gender) || $errors->has('nickname'.$b->gender) || $errors->has('father'.$b->gender) || $errors->has('mother'.$b->gender) || $errors->has('about'.$b->gender))
    $('#edit-btn' + '{{$b->gender}}').click();
  @endif
@endforeach
// End Cosmetics
</script>

<!-- <script src="{{asset('assets/stisla/chart.js/dist/Chart.min.js')}}"></script> -->
<!-- <script src="{{asset('assets/js/page/modules-chartjs.js')}}"></script> -->
@endpush
