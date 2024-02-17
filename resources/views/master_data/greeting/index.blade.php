@extends('layouts.master')
@section('title','Greetings')
@push('pages-style')
<style>
    .text-overflow-ellipsis {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
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
                {{$error}}
            </div>
        </div>
      @endforeach
    @endif

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>{{$section_header . ' dari Tamu Anda.'}}</h4>
            </div>

            <div class="card-body">
                @if($greetings->count() > 0)
                    <p>Nyalakan status untuk menampilkan ucapan tamu Anda di undangan.</p>
                    <div class="table-responsive">
                        <table class="table table-striped text-center" id="table-greetings">
                            <thead class="thead-dark">
                                <tr>
                                    {{-- <th scope="col" class="nosort nosearch">#</th> --}}
                                    <th scope="col">Nama Tamu</th>
                                    <th scope="col" class="nosort">Phone</th>
                                    <th scope="col" class="nosort">Tanggal</th>
                                    <th scope="col" class="nosort">Ucapan</th>
                                    <th scope="col" class="nosort" style="width:100px;">
                                        Status
                                        <select id="search-stat" name="search-stat">
                                            <option value="">Semua</option>
                                            <option value="{{Constant::TRUE_CONDITION}}">Tampil</option>
                                            <option value="{{Constant::FALSE_CONDITION}}">Tidak tampil</option>
                                        </select>
                                    </th>
                                    <th scope="col" class="nosort d-none">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($greetings as $no => $g)
                                <tr id="tr_{{$g->id}}" data-id="{{$g->id}}" data-guest_id="{{$g->guest_id}}">
                                    {{-- <td>{{++$no}}</td> --}}
                                    <td>{{$g->name}}</td>
                                    <td>{{$g->phone}}</td>
                                    <td>{{Carbon\Carbon::parse($g->date)->format(Constant::FORMAT_DATE_TIME)}}</td>
                                    <td>
                                        <div class="input-group">
                                            <input type="text" class="form-control text-overflow-ellipsis" value="{{$g->greeting}}" readonly>
                                            <div class="input-group-append">
                                                <div class="input-group-text" style="cursor: pointer;" data-greeting="{{$g->greeting}}" data-name="{{$g->name}}" onclick="Swal.fire({ title: $(this).data('name'), text: $(this).data('greeting') });"><i class="fas fa-ellipsis-h"></i></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <label class="custom-switch mt-2">
                                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                                data-url="{{route('greeting.update',[$template_category_name,$g->id])}}"
                                                data-url-show="{{route('greeting.show',[$template_category_name,$g->id])}}"
                                                data-id="{{$g->id}}" @if ($g->status == Constant::TRUE_CONDITION) checked @endif>
                                            <span class="custom-switch-indicator"></span>
                                        </label>
                                    </td>
                                    <td id="td-stat-{{$g->id}}" class="td-stat d-none">{{$g->status}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-state-icon"><i class="fas fa-question"></i></div>
                        <h2>Belum ada greetings dari Tamu</h2>
                        <p class="lead">Semua ucapan dari Tamu akan tampil di sini.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('modal')
@endsection

@push('page-script')
<script src="{{asset('assets/js/page/modules-datatables.js')}}"></script>
<script>

/* Custom filtering function which will search data in column four based on status value */
$.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
    var searchStat = $('#search-stat').val().trim();
    var dataStat = data[5].toString().trim(); // use data for the Status column

    if ((searchStat == dataStat || searchStat == "") && settings.nTable.id == 'table-greetings') {
        return true;
    }
    return false;
});

$(document).ready(function() {
    var tableGreetings = $('#table-greetings').DataTable({
        "columnDefs": [
            { "orderable": false, "targets": 'nosort' },
            { "searchable": false, "targets": 'nosearch' }
        ]
    });

    // Event listener to stat filtering inputs to redraw on input
    $('#search-stat').change(function () {
        tableGreetings.draw();
    });

    function set_obj_val_by_get_greeting_url_show(url, obj_cb, obj_td_stat) {
        $.ajax({
            url: url,
            type: 'get',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            beforeSend: function() {
                //
            },
            success: function (data) {
                if (data['success']) {
                    var stat_val = (data['success'] == '{{Constant::TRUE_CONDITION}}') ? true : false;
                    obj_cb.prop('checked', stat_val);
                    tableGreetings.cell(obj_td_stat).data(data['success']);
                } else if (data['error']) {
                    console.log(data['message']);
                } else {
                    console.log('Whoops Something went wrong!!');
                }
            },
            error: function (data) {
                console.log(data.responseText);
            }
        });
    }

    $('#table-greetings').on('change', 'input[type="checkbox"].custom-switch-input', function () {
        var obj_cb = $(this);
        var td_stat = obj_cb.closest('td').siblings('td.td-stat');
        // var colIndex = tableGreetings.cell(td_stat).index().column;
        // var rowIndex = tableGreetings.cell(td_stat).index().row;
        // var cellData = tableGreetings.cell(rowIndex, colIndex).data();
        var data_before = tableGreetings.cell(td_stat).data();
        var stat = this.checked ? '{{Constant::TRUE_CONDITION}}' : '{{Constant::FALSE_CONDITION}}';
        var data_url = obj_cb.data('url');
        var data_url_show = obj_cb.data('url-show');
        $.ajax({
            url: data_url,
            type: 'put',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {status: stat},
            beforeSend: function() {
                //
            },
            success: function (data) {
                if (data['success']) {
                    var stat_val = (data['result'] == '{{Constant::TRUE_CONDITION}}') ? true : false;
                    obj_cb.prop('checked', stat_val);
                    tableGreetings.cell(td_stat).data(data['result']);
                } else if (data['error']) {
                    var stat_val = (data['result'] == '{{Constant::TRUE_CONDITION}}') ? true : false;
                    obj_cb.prop('checked', stat_val);
                    tableGreetings.cell(td_stat).data(data['result']);
                } else if (data['error_validation']) {
                    Swal.fire({ title: data['error_validation'], icon: 'error'});
                } else {
                    Swal.fire({ title: 'Whoops Something went wrong!!', icon: 'error'});
                }
            },
            error: function (data) {
                // Swal.fire(data.responseText);
                Swal.fire({ title: 'Whoops Something went wrong!!', icon: 'error'});
            },
            complete: function () {
                set_obj_val_by_get_greeting_url_show(data_url_show, obj_cb, td_stat);
            }
        });
    })
});
</script>
@endpush
