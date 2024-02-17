
@extends('layouts.master')
@section('title','Template Category')
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

                    <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class=" fa fa-plus"></i> Tambah Data</button>
                    <button id="btnDel" type="button" class="btn btn-danger ml-2 btnDel" data-url="{{ route('delall') }}"><i class="fa fa-trash"></i> Hapus Checked</button>


                </div>
            </div>

            <div class="card-body">
                @if($template_category->count() > 0)
                <div class="table-responsive">
                <table class="table table-striped text-center" id="table-1">
                    <thead class="thead-dark">
                    <tr>
                        <th ><input type="checkbox" id="checkBoxAll"></th>
                        <th scope="col">#</th>
                        <th scope="col">Nama Kategori</th>
                        <th scope="col">Action</th>

                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($template_category as $no => $data)
                        <tr id="tr_{{$data->id}}">
                            <td><input type="checkbox" class="custom-checkbox cekbox" data-id="{{$data->id}}"></td>
                                <td>{{++$no}}</td>
                                <td>{{$data->name}}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" id="Update" data-toggle="modal" data-target="#UpdateData"
                                     data-id="{{$data->id}}"
                                     data-name="{{$data->name}}"
                                     ><i class="fa fa-pencil-square"></i>Update</button>
                                    <a href="#" data-id="{{$data->id}}"class="btn btn-icon icon-left btn-danger btn-sm swal-confrim">

                                        <form action="{{route('template_category.destroy',$data->id)}}" id="delete{{$data->id}}" method="POST">
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
<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('template_category.store')}}" method="POST">
            @csrf
                <div class="modal-body">
                <div class="form-group">
                    <label @error('name')
                    class="text-danger"
                @enderror>Name* @error('name')
                    | {{$message}}
                @enderror
              </label>
                    <input type="text" name="nama_category_template" class="form-control" required>
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
<div class="modal fade" tabindex="-1" role="dialog" id="UpdateData">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('template_category.UpdatePost')}}" method="POST">
            @csrf
                <div class="modal-body">
                <div class="form-group">
                    <label @error('name')
                    class="text-danger"
                @enderror>Name* @error('name')
                    | {{$message}}
                @enderror
              </label>
                    <input type="hidden" name="temp_id" id="temp_id">
                    <input type="text" name="nama_category_template" id="temp_name" class="form-control" required>
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
                var check = confirm("Are you sure you want to delete this row?");
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
                $('#temp_id').val($(this).data('id'))
                $('#temp_name').val($(this).data('name'))
            });

 </script>



@endpush
