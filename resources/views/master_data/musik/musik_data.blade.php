
@extends('layouts.master')
@section('title','Music')
@section('content')

<div class="section-body">
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
        <div class="card">
            <div class="card-header">
                <div class="col-12 col-md-6 col-lg-6">

                    <button class="btn btn-primary" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i> Tambah Data</button>
                    <button id="btnDel" type="button" class="btn btn-danger ml-2 btnDel" data-url="{{ url('/dashboard/master/deleteall/music') }}"><i class="fa fa-trash"></i> Hapus Checked</button>

                    {{-- <button type="button" name="bulk_delete" id="bulk_delete" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus Checked</button> --}}
                </div>
            </div>

            <div class="card-body">
                @if($music->count() > 0)
                <div class="table-responsive">
                <table class="table table-striped text-center" id="table-1">
                    <thead class="thead-dark">
                    <tr>
                        {{-- <th ><input type="checkbox" id="checkBoxAll"></th> --}}
                        <th scope="col">#</th>
                        <th scope="col">Nama Musik</th>
                        <th scope="col">Musik</th>
                        <th scope="col">Action</th>

                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($music as $no => $data)
                        <tr id="tr_{{$data->id}}">
                            {{-- <td><input type="checkbox" class="custom-checkbox cekbox" data-id="{{$data->id}}"></td> --}}
                                <td>{{++$no}}</td>
                                <td>{{$data->name}}</td>
                                <td>
                                    {{-- <a href="{{asset('assets/file/musik/'.$data->path)}}" target="_blank"> File</a> --}}
                                    {{-- <audio controls autoplay loop> --}}
                                    <audio controls controlslist="nodownload" style="height: 40px;">
                                        <!-- <source src="horse.ogg" type="audio/ogg"> -->
                                        <source src="{{asset('assets/file/musik/'.$data->path)}}" type="audio/mpeg">
                                        Sorry, Your browser does not support the audio element.
                                    </audio>
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-sm" id="Update" data-toggle="modal" data-target="#UpdateData"
                                     data-id="{{$data->id}}"
                                     data-nama_musik="{{$data->name}}"
                                     data-path_musik="{{$data->path}}"
                                     data-path_old="{{$data->path}}"
                                     ><i class="fa fa-pencil-square"></i>Update</button>
                                    <a href="#" data-id="{{$data->id}}"class="btn btn-icon icon-left btn-danger btn-sm swal-confrim">

                                        <form action="{{route('music.destroy',$data->id)}}" id="delete{{$data->id}}" method="POST">
                                            @csrf
                                            @method('delete')
                                        </form>
                                            <i class="fas fa-times"></i>
                                        Delete</a>

                                </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
               <h4 class="text-center"> Data Not Found </h4>
                @endif
                </div>
            </div>
        </div>
</div>
@endsection

@section('modal')
{{-- add data --}}
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('music.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label @error('nama_musik')
                                class="text-danger"
                                    @enderror>Nama Musik* @error('nama_musik')
                                    | {{$message}}
                                    @enderror
                                </label>
                                <input type="text" name="nama_musik" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label @error('path_musik')
                                class="text-danger"
                                    @enderror>Path Musik* @error('path_musik')
                                    | {{$message}}
                                    @enderror
                                </label>
                                <input type="file" name="path_musik" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-add">Save changes</button>
                </div>
            </div>
        </form>
    </div>
  </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="UpdateData">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('music.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
             <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label @error('nama_musik')
                                class="text-danger"
                                    @enderror>Nama Musik* @error('nama_musik')
                                    | {{$message}}
                                    @enderror
                                </label>
                                <input type="hidden" name="id_musik" id="id_musik">
                                <input type="text" name="nama_musik" id="nama_musik" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label @error('path_musik')
                                class="text-danger"
                                    @enderror>Path Musik* @error('path_musik')
                                    | {{$message}}
                                    @enderror
                                </label>
                                <input type="file" name="path_musik" id="path_musik" class="form-control">
                                <input type="hidden" name="path_old" id="path_old" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
        </form>
    </div>
  </div>
</div>
{{-- End --}}

@endsection

@push('page-script')

<script src="{{asset('assets/js/page/modules-datatables.js')}}"></script>
<script>
$(".swal-confrim").click(function(e) {
    id = e.target.dataset.id; // ambil targeet id dari element dataset(data-id)
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
            Swal.fire({ title: 'Success ', icon: 'success' });
            $(`#delete${id}`).submit();
        }
      });
  });
  $('#checkBoxAll').click(function () {
      if ($(this).is(":checked")) {
          $(".cekbox").prop("checked", true)
      }
      else {
          $(".cekbox").prop("checked", false)
      }
  });
        $('#btnDel').on('click', function(e) {
            var allVals = [];
            $(".cekbox:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });
            if(allVals.length <=0)
            {
                alert("Please select row.");
            }  else {
                var check = confirm("Are you sure you want to delete selected row?");
                if(check == true){
                    var join_selected_values = allVals.join(",");
                    $.ajax({
                        url: $(this).data('url'),
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+join_selected_values,


                        success: function (data) {
                            if (data['success']) {
                                $(".sub_chk:checked").each(function() {
                                    $(this).parents("tr").remove();
                                });
                                alert(data['success']);
                                location.reload();
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });
                $.each(allVals, function( index, value ) {
                    $('table tr').filter("[data-row-id='" + value + "']").remove();
                });
                }
            }
            });

            $(document).on('click','#Update',function()
            {
                $('#id_musik').val($(this).data('id'))
                $('#nama_musik').val($(this).data('nama_musik'))
                $('#path_old').val($(this).data('path_old'))

            })

            @if ($errors->any())
                $('#addModal').modal('show')
            @endif

 </script>



@endpush
