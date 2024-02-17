@extends('layouts.master')
@section('title','Profile')
@push('pages-style')
<style>
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
    @if ($user->id == Auth::user()->id)
    <h2 class="section-title">Hai, {{$user->name}}!</h2>
    <p class="section-lead">
        Ubah informasi tentang kamu di sini.
    </p>
    @else
    <h2 class="section-title">{{$user->name}}</h2>
    <p class="section-lead">
        Ubah informasi tentang <strong>{{$user->name}}</strong> di sini.
    </p>
    @endif
    @if (session('messagePhoto'))
    <div class="alert alert-success alert-dismissible show fade">
      <div class="alert-body">
        <button class="close" data-dismiss="alert">
          <span>×</span>
        </button>
        {{session('messagePhoto')}}
      </div>
    </div>
    @endif
    @if (session('warningPhoto'))
    <div class="alert alert-danger alert-dismissible show fade">
      <div class="alert-body">
        <button class="close" data-dismiss="alert">
          <span>×</span>
        </button>
        {{session('warningPhoto')}}
      </div>
    </div>
    @endif

    <div class="row mt-sm-4">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card profile-widget">
          <div class="profile-widget-header">

            @csrf
            @method('put')
            @if (empty($user->photo))
              <img id="myImage" name="image" alt="image" src="{{url('/')}}/assets/img/avatar/avatar-1.png" class="rounded-circle profile-widget-picture my-shadow">
              {{-- <input type="hidden" id="idUser" value="{{$user->id}}"> --}}
              <input type="hidden" id="urlUpdateImage" value="{{route('updateImage',$user->id)}}">
              <p id="image_url" style="display:none;">{{url('/')}}/assets/img/avatar/avatar-1.png</p>
            @else
              <img id="myImage" name="image" alt="image" src="{{url('/')}}/assets/img/avatar/{{$user->photo}}" class="rounded-circle profile-widget-picture my-shadow">
              {{-- <input type="hidden" id="idUser" value="{{$user->id}}"> --}}
              <input type="hidden" id="urlUpdateImage" value="{{route('updateImage',$user->id)}}">
              <p id="image_url" style="display:none;">{{url('/')}}/assets/img/avatar/{{$user->photo}}</p>
            @endif
            <input type="file" id="photoEdit" name="photoEdit" class="photoEdit" accept=".jpg, .jpeg, .png" style="display: none;" />

            <div class="profile-widget-items">
              <div class="profile-widget-item">
                <div class="profile-widget-item-label">Paket</div>
                <div class="profile-widget-item-value">{{$active_invoice->invoice_type->name ?? '-'}}</div>
              </div>
              <div class="profile-widget-item">
                <div class="profile-widget-item-label">Kunjungan</div>
                <div class="profile-widget-item-value">{{count($visitors)}}</div>
              </div>
              <div class="profile-widget-item">
                <div class="profile-widget-item-label">Tamu</div>
                <div class="profile-widget-item-value">{{count($guests)}}</div>
              </div>
            </div>
          </div>
          <!-- <div class="profile-widget-description">
            <div class="profile-widget-name">{{$user->name }}</div>
          </div> -->

            <div class="card-body">
              <ul class="nav nav-pills" id="myProfileTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link {{ (session('messagePassword') || session('warningPassword')) ? null : 'active' }}" id="about-profileTab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="true"><i class="fas fa-user"></i> About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ (session('messagePassword') || session('warningPassword')) ? 'active' : null }}" id="password-profileTab" data-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="true"><i class="fas fa-key"></i> Password</a>
                </li>
              </ul>
              <div class="tab-content" id="tabContent">
                <div class="tab-pane fade show {{ (session('messagePassword') || session('warningPassword')) ? null : 'active' }}" id="about" role="tabpanel" aria-labelledby="about-profileTab">
                    <hr>
                    @if (session('messageAbout'))
                    <div class="alert alert-success alert-dismissible show fade">
                        <div class="alert-body">
                          <button class="close" data-dismiss="alert">
                            <span>×</span>
                          </button>
                          {{session('messageAbout')}}
                        </div>
                      </div>
                    @endif
                    @if (session('warningAbout'))
                    <div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body">
                          <button class="close" data-dismiss="alert">
                            <span>×</span>
                          </button>
                          {{session('warningAbout')}}
                        </div>
                      </div>
                    @endif
                  <form method="post" action="{{route('user.update',$user->id)}}" class="needs-validation" novalidate="">
                        @csrf
                        @method('patch')

                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                    <label @error('name') class="text-danger"
                                        @enderror>Full Name* @error('name')
                                            | {{$message}}
                                        @enderror
                                    </label>
                                    <input type="text" class="form-control" name="name" @if (old('name'))
                                            value="{{old('name')}}"
                                            @else
                                            value="{{$user->name}}"
                                        @endif placeholder="Enter Full Name" required>
                                    <div class="invalid-feedback">Please fill in the full name</div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                              <label @error('email') class="text-danger"
                                  @enderror>Email* @error('email')
                                      | {{$message}}
                                  @enderror
                              </label>
                              <input type="email" class="form-control" name="email" @if (old('email'))
                                      value="{{old('email')}}"
                                      @else
                                      value="{{$user->email}}"
                                  @endif placeholder="Enter your valid email" required disabled>
                              <div class="invalid-feedback">Please fill in the email</div>
                            </div>
                        </div>
                        <div class="text-right">
                          <button class="btn btn-primary">Save Changes</button>
                        </div>
                  </form>
                </div> <!-- tab about -->

                <div class="tab-pane fade show {{ (session('messagePassword') || session('warningPassword')) ? 'active' : null }}" id="password" role="tabpanel" aria-labelledby="password-profileTab">
                    <hr>
                    @if (session('messagePassword'))
                    <div class="alert alert-success alert-dismissible show fade">
                        <div class="alert-body">
                          <button class="close" data-dismiss="alert">
                            <span>×</span>
                          </button>
                          {{session('messagePassword')}}
                        </div>
                      </div>
                    @endif
                    @if (session('warningPassword'))
                    <div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body">
                          <button class="close" data-dismiss="alert">
                            <span>×</span>
                          </button>
                          {{session('warningPassword')}}
                        </div>
                      </div>
                    @endif
                  <form method="post" action="{{route('updatePassword', $user->id)}}" class="needs-validation" novalidate="">
                        @csrf
                        @method('put')

                        <div class="row">
                            <div class="form-group col-md-4 col-12">
                              <label for="currPassword" class="d-block">Current Password</label>
                              <input id="currPassword" type="password" class="form-control @error('currPassword') is-invalid @enderror" name="currPassword" required autocomplete="new-password">
                              @error('currPassword')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                              @else
                              <span class="invalid-feedback" role="alert"><strong>Please fill in the current password</strong></span>
                              @enderror
                            </div>
                            <div class="form-group col-md-4 col-12">
                              <label for="password" class="d-block">New Password</label>
                              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                              @error('password')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                              @else
                              <span class="invalid-feedback" role="alert"><strong>Please fill in the new password</strong></span>
                              @enderror
                              <div id="pwindicator" class="pwindicator">
                                <div class="bar"></div>
                                <div class="label"></div>
                              </div>
                            </div>
                            <div class="form-group col-md-4 col-12">
                              <label for="password-confirm" class="d-block">New Password Confirmation</label>
                              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="text-right">
                          <button class="btn btn-primary">Save Changes</button>
                        </div>
                  </form>
                </div> <!-- tab password -->

              </div> <!-- tab content -->
            </div> <!-- Div Class card-body -->
          </div>
        </div>
      </div>
    </div>
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
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> -->
        <button type="button" class="btn btn-primary" id="cropEdit"><i class="fas fa-crop"></i> Crop</button>
      </div>
    </div>
  </div>
</div>

{{-- End Modal Crop Image --}}

@endsection

@push('page-script')
<script>

  // Change Photo /////////////////////////////////////////////////

  var $modalEdit = $('#modalCropEdit');
  var imageEdit = document.getElementById('imageEdit');
  var cropperEdit;
  var base64dataEdit = null;

            $("body").on("change", ".photoEdit", function(e){

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
                if(!allowedExtensions.includes(fileExtension)){
                    Swal.fire({ title: 'Format file harus .jpg, .jpeg, atau .png!', icon: 'warning' });
                    this.value = null;
                    return false;
                }else if(fileSize > sizeLimit){
                    Swal.fire({ title: 'Ukuran file maksimal ' + sizeLimit / 1000000 + 'MB!', icon: 'warning' });
                    this.value = null;
                    return false;
                }else{
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

            $modalEdit.on('shown.bs.modal', function () {
                cropperEdit = new Cropper(imageEdit, {
	            aspectRatio: 1,
	            viewMode: 3,
	            preview: '.preview'
            });
            }).on('hidden.bs.modal', function () {
                cropperEdit.destroy();
                cropperEdit = null;
                $("input[id='photoEdit']").val("");
            });

            $("#cropEdit").click(function(){
                canvasEdit = cropperEdit.getCroppedCanvas({
                    width: 160,
                    height: 160,
                });

                canvasEdit.toBlob(function(blob) {
                    url = URL.createObjectURL(blob);
                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function() {
                        base64dataEdit = reader.result;
                        $('#myImage').attr('src', base64dataEdit);
                        $modalEdit.modal('hide');

                        // var id = $('#idUser').val();
                        var urlUpdateImage = $('#urlUpdateImage').val();

                        $.ajax({
                            type: "PUT",
                            dataType: "json",
                            url: urlUpdateImage,
                            data: {'_token': $('input[name="_token"]').val(), 'image': base64dataEdit},
                            success: function(data){

                            }
                        });
                        location.reload();
                    }
                });
                // photoChanged = 'true';
            });

  // End Change Photo /////////////////////////////////////////////

  $("#myImage").click(function() {
      $("input[id='photoEdit']").click();
  });

  $('#myImage').hover( function() {
    $(this).attr("src","{{url('/')}}/assets/img/camera.png")
  }, function() {
    $default_url = $("#image_url").text();
    $(this).attr("src",$default_url)
  }
  );

</script>

<script src="{{asset('assets/stisla/chart.js/dist/Chart.min.js')}}"></script>
<!-- <script src="{{asset('assets/js/page/modules-chartjs.js')}}"></script> -->
@endpush
