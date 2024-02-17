@extends('layouts.master')
@section('title','Feedback')
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
        <div class="card">
            <div class="card-header">
                <div class="col-12">

                    <button id="btnDel" type="button" class="btn btn-danger ml-2 btnDel" data-url="{{ url('feedback/delete_all') }}"><i class="fa fa-trash"></i> Hapus Checked</button>
                    {{-- <h1>Total Harga : {{$sum}}</h1> --}}
                    {{-- <button type="button" name="bulk_delete" id="bulk_delete" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus Checked</button> --}}
                </div>
            </div>

            <div class="card-body">
                @if($feedback->count() > 0)
                <div class="table-responsive">
                <table class="table table-striped text-center" id="table-1">
                    <thead class="thead-dark">
                    <tr>
                        <th ><input type="checkbox" id="checkBoxAll"></th>
                        <th scope="col">#</th>
                        <th scope="col">Pelanggan</th>
                        <th scope="col">Feedback</th>
                        <th scope="col">Status</th>
                        <th scope="col">Tanggal Submit</th>
                        <th scope="col">Action</th>

                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($feedback as $no => $data)
                        <tr id="tr_{{$data->id}}">
                            <td><input type="checkbox" class="custom-checkbox cekbox" data-id="{{$data->id}}"></td>
                                <td>{{++$no}}</td>
                                <td>{{$data->user->name}}</td>
                                <td>{{$data->ulasan}}</td>
                                <td>{{$data->status == Constant::FALSE_CONDITION ? 'Belum publish' : 'Publish'}}</td>
                                <td>{{$data->created_at}}</td>
                                <td>
                                    <a href="{{route('feedback.edit',$data->id)}}" class="btn btn-icon icon-left btn-primary btn-sm"><i class="far fa-edit"></i>Update</a>
                                    <a href="#" data-id="{{$data->id}}"class="btn btn-icon icon-left btn-danger btn-sm swal-confrim">

                                        <form action="{{route('feedback.destroy',$data->id)}}" id="delete{{$data->id}}" method="POST">
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


@push('page-script')
{{-- @once
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
    </script>
@endonce --}}
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
          Swal.fire({ title: 'Deleted!', text: 'The data has been deleted.', icon: 'success' });
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
 </script>



@endpush
