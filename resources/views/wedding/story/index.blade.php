@extends('layouts.master')
@section('title','Story')
@push('pages-style')
<link rel="stylesheet" href="{{asset('assets/css/dropzone.css')}}">
<style>
  .btnViewEdit {cursor: pointer;}
  .cursor-pointer {cursor: pointer;}
  .activity-icon:hover {
    box-shadow: 0 0 15px rgba(33,33,33,.2);
  }
  .shadow-image {
    box-shadow: 6px 6px 13px -9px rgba(103,119,239,1);
    -webkit-box-shadow: 6px 6px 13px -9px rgba(103,119,239,1);
    -moz-box-shadow: 6px 6px 13px -9px rgba(103,119,239,1);
  }

  .preview {
    overflow: hidden;
    width: 160px;
    height: 160px;
    margin: 10px;
    border: 1px solid red;
  }
  .src-crop-img {
    display: block;
    max-width: 100%;
  }
</style>
@endpush

@section('content')
    @include('layouts.alert')

    <div class="section-body">

        {{-- <h2 class="section-title">Buat cerita cinta Kamu</h2> --}}
        <div class="card">
          <div class="card-header">
            <h4>Kisah cinta romantis Kamu dan Dia</h4>
            <div class="card-header-action">
              <button id="btnDeleteSelected" class="swal-confirm btn btn-icon btn-danger d-none" data-toggle="tooltip" title="Hapus terpilih" data-url="{{route('wedding.story.destroystories', Auth::User()->id)}}"><i class="fas fa-trash-alt"></i></button>
              <button id="btnAdd" class="btnViewEdit btn btn-icon btn-primary" data-toggle="tooltip" title="Tambah Cerita" data-type="add" data-id="0"><i class="fas fa-plus"></i></button>
            </div>
          </div>
          @if (count($stories) <= 0)
            <div class="empty-state">
              <div class="empty-state-icon"><i class="fas fa-question"></i></div>
              <h2>Tidak ada cerita</h2>
              <p class="lead">Kamu belum membuat cerita cinta dengannya. Ayo ceritakan kisah cinta Kamu dan Dia. Click Button Tambah <span class="text-primary" style="cursor:pointer;" id="btnAddInfo"><i class="fas fa-plus"></i></span> untuk membuat cerita cinta Kamu dan Dia.</p>
            </div>
          @endif
        </div>

      @if (count($stories) > 0)
        <div class="row">
            <div class="col-12">
                <div class="activities">
                  <div id="activity-cb-all-obj" class="activity d-none">
                    <div id="activity-cb-all" class="cursor-pointer activity-icon bg-light shadow-light">
                      <i id="icon-story-item-all" class=""></i>
                    </div>
                    <div class="activity-detail">
                      <input id="cb-story-item-all" type="checkbox" class="d-none" data-id="0">
                      <p id="text-cb-story-item-all" class="cursor-pointer">Check All</p>
                    </div>
                  </div>
                  @foreach ($stories as $no => $s)
                  <div class="activity">
                    <div class="activity-cb-item cursor-pointer activity-icon bg-primary text-white shadow-primary" data-id="{{$s->id}}">
                      <i id="icon-story-item-{{$s->id}}" data-id="{{$s->id}}" class="icon-story-item"></i>
                    </div>
                    <div class="activity-detail">
                      <input type="checkbox" id="cb-story-item-{{$s->id}}" class="cb-story-item d-none" data-id="{{$s->id}}">
                      <div class="mb-2">
                        <span class="text-job" id="srcLabelDate{{$s->id}}"><strong>{{Carbon\Carbon::parse($s->date)->format('d M Y')}}</strong></span>
                        <input type="date" id="srcDate{{$s->id}}" class="d-none" value="{{$s->date}}">
                        <span class="bullet"></span>
                        <span class="btnViewEdit text-job" data-id="{{$s->id}}" data-type="edit">Edit</span>
                        <div class="float-right dropdown">
                          &nbsp;
                          <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                          <div class="dropdown-menu">
                            <div class="dropdown-title">Options</div>
                            <a href="#" class="btnViewEdit dropdown-item has-icon" data-id="{{$s->id}}" data-type="view"><i class="fas fa-eye"></i> View</a>
                            <a href="#" class="btnViewEdit dropdown-item has-icon" data-id="{{$s->id}}" data-type="edit"><i class="fas fa-edit"></i> Edit</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="swal-confirm dropdown-item has-icon text-danger" data-id="{{$s->id}}" data-title="{{$s->title}}"><i class="fas fa-trash-alt"></i> Delete</a>
                          </div>
                        </div>
                      </div>
                      <img alt="image" src="{{ empty($s->photo) ? asset('assets/img/example-image-500.png') : asset('assets/img/wedding/photo/story/'.$s->photo) }}" class="mb-3 shadow-image d-block d-sm-none story-img cursor-pointer" width="100" data-id="{{$s->id}}" data-titleimg="{{$s->title}}" data-url="{{route('updatestoryimg',$s->id)}}" data-default="{{ empty($s->photo) ? asset('assets/img/example-image-500.png') : asset('assets/img/wedding/photo/story/'.$s->photo) }}">
                      <div class="media">
                        <img alt="image" src="{{ empty($s->photo) ? asset('assets/img/example-image-500.png') : asset('assets/img/wedding/photo/story/'.$s->photo) }}" class="mr-3 shadow-image d-none d-sm-block story-img cursor-pointer" width="100" data-id="{{$s->id}}" data-titleimg="{{$s->title}}" data-url="{{route('updatestoryimg',$s->id)}}" data-default="{{ empty($s->photo) ? asset('assets/img/example-image-500.png') : asset('assets/img/wedding/photo/story/'.$s->photo) }}">
                        <div class="media-body">
                          <h6 id="srcTitle{{$s->id}}" class="text-primary">{{$s->title}}</h6>
                          <p id="srcDesc{{$s->id}}">{{$s->desc}}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
            </div>
        </div>
      @endif

    </div>

<div class="d-none">
  <form id="formDeleteStory" action="" method="POST">
    @csrf
    @method('delete')
  </form>
</div>

<input type="file" id="photoEdit" name="photoEdit" class="d-none" data-id="" accept=".jpg, .jpeg, .png"/>
@endsection

@section('modal')
<div class="modal fade" id="modalViewEdit" tabindex="-1" role="dialog" aria-labelledby="modalViewEditLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalViewEditLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="tab-content" id="tabContentViewEdit">
          <div class="tab-pane fade active show" id="formView" role="tabpanel" aria-labelledby="formView-tab">
            <div class="row">
              <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                <div class="form-group">
                  <label>Title</label>
                  <p id="labelTitle">-</p>
                </div>
              </div>
              <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                <div class="form-group">
                  <label>Date</label>
                  <p id="labelDate">-</p>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Description</label>
              <p id="labelDesc" class="text-justify">-</p>
            </div>
          </div>
          <div class="tab-pane fade" id="formEdit" role="tabpanel" aria-labelledby="formEdit-tab">
            <form id="form-store-update-story" action="" method="">
              @csrf
              @method('')
              <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                  <div class="form-group">
                    <label id="label-form-title" @error('title') class="text-danger" @enderror>Title* @error('title') | {{$message}} @enderror</label>
                    <input type="text" class="form-control" name="title" value="{{old('title')}}">
                  </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                  <div class="form-group">
                    <label id="label-form-date" @error('date') class="text-danger" @enderror>Date* @error('date') | {{$message}} @enderror</label>
                    <input type="date" class="form-control" name="date" value="{{old('date')}}">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label id="label-form-desc" @error('desc') class="text-danger" @enderror>Description* @error('desc') | {{$message}} @enderror</label>
                <textarea class="form-control" name="desc" rows="6" placeholder="Ceritakan tentang Kamu dan Dia">{{old('desc')}}</textarea>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnSaveEdit" class="btn btn-primary"></button>
      </div>
    </div>
  </div>
</div>

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
                    <img id="imageEdit" class="src-crop-img" src="">
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
<script src="{{asset('assets/js/dropzone.js')}}"></script>

<script>
  $(document).ready(function() {});

  Dropzone.autoDiscover = false;

  // Constant
  const TYPE_ADD = 'add';
  const TYPE_EDIT = 'edit';
  const TYPE_VIEW = 'view';
  // End Constant

  // variable crop image
  var $modalEdit = $('#modalCropEdit');
  var imageEdit = document.getElementById('imageEdit');
  var cropperEdit;
  var base64dataEdit = null;
  // end variable crop image

  // Event Trigger
  $('#btnAddInfo').click(function() {
    $('#btnAdd').click();
  });

  $('.btnViewEdit').click(function() {
    var id = $(this).data('id');

    resetLabelForm();

    setRouteAndMethod($(this).data('type'), id);

    setModalViewEdit($(this).data('type'));

    if ($(this).data('type') == TYPE_ADD) {
      resetText();
    } else if ($(this).data('type') == TYPE_VIEW || $(this).data('type') == TYPE_EDIT) {
      setValueText(id);
    } else {
      return false;
    }

    $('#modalViewEdit').modal('show');
  });

  $('#btnSaveEdit').click(function() {
    if ($(this).data('type') == TYPE_ADD || $(this).data('type') == TYPE_EDIT) {
      setRouteAndMethod($(this).data('type'), $(this).data('id'));
      $('#form-store-update-story').submit();
    } else if ($(this).data('type') == TYPE_VIEW) {
      setModalViewEdit(TYPE_EDIT);
    } else {
      return false;
    }
  });

  $('#text-cb-story-item-all').click(function() {
    $('#activity-cb-all').click();
  });

  $('#cb-story-item-all').change(function() {
    if(this.checked) {
      $('#icon-story-item-all').addClass('fas fa-check');
      $('#text-cb-story-item-all').text('Uncheck All');
      $('.icon-story-item').addClass('fas fa-check');
      $('.cb-story-item').prop('checked', true);
    } else {
      $('#icon-story-item-all').removeClass('fas fa-check');
      $('#text-cb-story-item-all').text('Check All');
      $('.icon-story-item').removeClass('fas fa-check');
      $('.cb-story-item').prop('checked', false);
      $('#btnDeleteSelected').addClass('d-none');
      $('#activity-cb-all-obj').addClass('d-none');
    }
  });

  $('#activity-cb-all').click(function() {
    $('#cb-story-item-all').click();
  });

  $(".cb-story-item").change(function() {
    if(this.checked) {
      $('#icon-story-item-' + $(this).data('id')).addClass('fas fa-check');
      $('#btnDeleteSelected').removeClass('d-none');
      $('#activity-cb-all-obj').removeClass('d-none');
    } else {
      $('#icon-story-item-' + $(this).data('id')).removeClass('fas fa-check');
      if ($('.cb-story-item:checkbox:checked').length == 0) {
        $('#cb-story-item-all').prop('checked', false);
        $('#icon-story-item-all').removeClass('fas fa-check');
        $('#text-cb-story-item-all').text('Check All');
        $('#btnDeleteSelected').addClass('d-none');
        $('#activity-cb-all-obj').addClass('d-none');
      }
    }
  });

  $('.activity-cb-item').click(function() {
    $('#cb-story-item-' + $(this).data('id')).click();
  });
  // End Event Trigger

  // Method
  function resetText() {
    $('#form-store-update-story')[0].reset();
    $('input[name="title"]').val('');
    $('input[name="date"]').val(null);
    $('textarea[name="desc"]').text('');
    $('#labelTitle').text('-');
    $('#labelDate').text('-');
    $('#labelDesc').text('-');
  }

  function resetLabelForm() {
    $('#label-form-title').text('Title*');
    $('#label-form-title').removeClass('text-danger');
    $('#label-form-date').text('Date*');
    $('#label-form-date').removeClass('text-danger');
    $('#label-form-desc').text('Description*');
    $('#label-form-desc').removeClass('text-danger');
  }

  function setValueText(id) {
    $('input[name="title"]').val($('#srcTitle' + id).text());
    $('input[name="date"]').val($('#srcDate' + id).val());
    $('textarea[name="desc"]').text($('#srcDesc' + id).text());
    $('#labelTitle').text($('#srcTitle' + id).text());
    $('#labelDate').text($('#srcLabelDate' + id).text());
    $('#labelDesc').text($('#srcDesc' + id).text());
    $('#btnSaveEdit').data('id',id);
  }

  function setModalViewEdit(type) {
    if (type == TYPE_ADD) {
      $('#modalViewEditLabel').text('Tambah Cerita');
      $('#formView').removeClass('active show');
      $('#formEdit').addClass('active show');
      $('#btnSaveEdit').data('type',TYPE_ADD);
      $('#btnSaveEdit').text('Save');
    } else if (type == TYPE_VIEW) {
      $('#modalViewEditLabel').text('Detail Cerita');
      $('#formView').addClass('active show');
      $('#formEdit').removeClass('active show');
      $('#btnSaveEdit').data('type',TYPE_VIEW);
      $('#btnSaveEdit').text('Edit');
    } else if (type == TYPE_EDIT) {
      $('#modalViewEditLabel').text('Edit Cerita');
      $('#formView').removeClass('active show');
      $('#formEdit').addClass('active show');
      $('#btnSaveEdit').data('type',TYPE_EDIT);
      $('#btnSaveEdit').text('Save');
    } else {
      return false;
    }
  }

  function setRouteAndMethod(type, id) {
    if (type == TYPE_ADD) {
      $('#form-store-update-story').attr('action',"{{route('story.store')}}");
      $('#form-store-update-story').attr('method','POST');
      $('form#form-store-update-story').find('input[name="_method"]').val('post');
    } else if (type == TYPE_VIEW || type == TYPE_EDIT) {
      $('#form-store-update-story').attr('action','{{route("story.update","")}}' + "/" + id);
      $('#form-store-update-story').attr('method','POST');
      $('form#form-store-update-story').find('input[name="_method"]').val('put');
    } else {
      return false;
    }
  }
  // End Method

// Update Photo
$(".story-img").click(function() {
  $("input[id='photoEdit']").data('id',$(this).data('id'));
  $("input[id='photoEdit']").data('titleimg',$(this).data('titleimg'));
  $("input[id='photoEdit']").data('url',$(this).data('url'));
  $("input[id='photoEdit']").click();
});

$("body").on("change", "#photoEdit", function(e) {
  $('#cropEdit').data('id',$(this).data('id'));
  $('#cropEdit').data('titleimg',$(this).data('titleimg'));
  $('#cropEdit').data('url',$(this).data('url'));
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
  $("input[id='photoEdit']").data('id','');
  $("input[id='photoEdit']").data('titleimg','');
  $("input[id='photoEdit']").data('url','');
  $("input[id='photoEdit']").val("");
});

$("#cropEdit").click(function() {
  var urlUpdateImage = $(this).data('url');
  var titleUpdateImage = $(this).data('titleimg');
  var idUpdateImage = $(this).data('id');

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
      $('.story-img[data-id="' + idUpdateImage + '"]').attr('src', base64dataEdit);
      $modalEdit.modal('hide');

      $.ajax({
        type: "PUT",
        dataType: "json",
        url: urlUpdateImage,
        data: {'_token': $('input[name="_token"]').val(), 'photo': base64dataEdit, 'title': titleUpdateImage},
        success: function(data) {
          if (data['success']) {
            Swal.fire({ title: data['success'], icon: 'success' });
            // location.reload();
          } else if (data['error']) {
            Swal.fire({ title: data['error'], icon: 'error' });
          } else {
            Swal.fire({ title: 'Whoops Something went wrong!!', icon: 'error' });
          }
        },
        error: function (data) {
          // Swal.fire(data.responseText);
          // Swal.fire('Whoops Something went wrong!!\n\n' + data.responseText);
          Swal.fire({ title: 'Whoops Something went wrong!!', icon: 'error' });
        }
      });
      // location.reload();
    }
  });
  // photoChanged = 'true';
});
// End Update Photo

  function deleteSelectedStoryItem() {
    var allVals = [];
    $(".cb-story-item:checkbox:checked").each(function() {
      allVals.push($(this).data('id'));
    });
    if(allVals.length <= 0) {
      // Ini harusnya udah gak perlu karena udah aku cek lewat swal-confirm
      // alert("Please select item.");
      Swal.fire('Please select item.');
    } else {
      // var check = confirm("Are you sure you want to delete selected item?");
      // if(check == true) {
        var join_selected_values = allVals.join(",");
        $.ajax({
          url: $('#btnDeleteSelected').data('url'),
          type: 'put',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          data: {ids: join_selected_values},
          // data: 'ids=' + join_selected_values,
          success: function (data) {
            if (data['success']) {
              Swal.fire({ title: data['success'], icon: 'success' });
              location.reload();
            } else if (data['error']) {
              Swal.fire({ title: data['error'], icon: 'error' });
            } else {
              Swal.fire({ title: 'Whoops Something went wrong!!', icon: 'error' });
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

    if ($(this).attr('id') == 'btnDeleteSelected') {
      if ($('.cb-story-item:checkbox:checked').length > 0) {
        textConfirm = "You will delete " + $('.cb-story-item:checkbox:checked').length + " item(s).";
      } else {
        Swal.fire('Please choose at least 1 item!');
        return false;
      }
    } else {
      textConfirm = "This will delete the story '" + $(this).data('title') + "', You won't be able to revert this!";
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
        if ($(this).attr('id') == 'btnDeleteSelected') {
          deleteSelectedStoryItem();
        } else {
          $('#formDeleteStory').attr('action', "{{route('story.destroy','')}}/" + $(this).data('id'));
          $('#formDeleteStory').submit();
        }
      }
    });
  });

// Cosmetics
$('.story-img').hover(function() {
  // $(this).attr('src','{{asset("assets/img/camera.png")}}')
  $(this).attr('src','{{asset("assets/img/products/product-5-50.png")}}')
  }, function() {
    $(this).attr("src",$(this).data('default'))
  }
);

  @if($errors->has('title') || $errors->has('date') || $errors->has('desc'))
    setModalViewEdit('{{Cookie::get("type-global")}}');
    setRouteAndMethod('{{Cookie::get("type-global")}}', '{{Cookie::get("story-id")}}');
    $('#btnSaveEdit').data('id','{{Cookie::get("story-id")}}');
    $('#modalViewEdit').modal('show');
  @endif
</script>

<!-- <script src="{{asset('assets/stisla/chart.js/dist/Chart.min.js')}}"></script> -->
<!-- <script src="{{asset('assets/js/page/modules-chartjs.js')}}"></script> -->
@endpush
