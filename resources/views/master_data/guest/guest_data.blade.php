@extends('layouts.master')
@section('title',$section_header)
@section('content')
    @php
        $indonesia = \Carbon\Carbon::setLocale('LC_TIME', 'id_ID');
        $y1 = 'Ya';
        $n1 = 'Tidak';
        $y2 = 'Sudah';
        $n2 = 'Belum';
    @endphp
    <div class="section-body">
        @include('layouts.alert')
        <div class="card">
            <div class="card-header">
                <h4>Tamu Undangan {{$template_category->name}} Anda</h4>
                <div class="card-header-action">
                    @if($guest->count() > 0)
                        <button id="btnDestroyGuests" class="btn btn-icon btn-outline-danger" data-toggle="tooltip" title="Hapus yang dipilih" data-url="{{route('guest.destroyguests')}}"><i class="fas fa-trash-alt"></i> Hapus Terpilih</button>
                        <a href="{{route('guest.message')}}" class="btn btn-icon btn-outline-primary" data-toggle="tooltip" title="Edit Pesan Tamu"><i class="fas fa-edit"></i> Edit Pesan</a>
                    @endif
                    <a id="btnAdd" href="{{route('guest.create')}}" class="btn btn-icon btn-primary" data-toggle="tooltip" title="Tambah Tamu"><i class="fas fa-plus"></i></a>
                </div>
            </div>

            <div class="card-body">
                @if($guest->count() > 0)
                    <p>Tamu yang akan hadir: <b>{{$guest->where('status',Constant::TRUE_CONDITION)->count()}} dari {{$guest->count()}}</b>, dengan <b>jumlah Tamu: {{$guest->sum('presence')}} orang</b>.</p>
                    <p>Actual yang hadir: <b>{{$guest_presences->sum('presence')}} orang</b>.</p>
                    <div class="table-responsive">
                        <table class="table table-striped text-center" id="table-guests">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="nosort nosearch">
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" data-checkboxes="cb_guest_group" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                            <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                        </div>
                                    </th>
                                    <th scope="col">Nama</th>
                                    <th scope="col" class="nosort">Nomor Ponsel</th>
                                    <th scope="col" class="nosort">
                                        Sudah buka undangan?
                                        <select id="search-open" name="search-open">
                                            <option value="">Semua</option>
                                            <option value="{{$y2}}">{{$y2}}</option>
                                            <option value="{{$n2}}">{{$n2}}</option>
                                        </select>
                                    </th>
                                    <th scope="col" class="nosort nosearch">Waktu terakhir buka</th>
                                    <th scope="col" class="nosort">
                                        Akan hadir?
                                        <select id="search-stat" name="search-stat">
                                            <option value="">Semua</option>
                                            <option value="{{$y1}}">{{$y1}}</option>
                                            <option value="{{$n1}}">{{$n1}}</option>
                                        </select>
                                    </th>
                                    <th scope="col" class="nosort nosearch">Jumlah yang akan hadir</th>
                                    <th scope="col" class="nosort nosearch">Actual yang hadir</th>
                                    <th scope="col" class="nosort nosearch">Status</th>
                                    <th scope="col" class="nosort nosearch">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($guest as $no => $data)
                                    <tr id="tr_{{$data->id}}">
                                        <td class="align-middle">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="cb_guest_group" class="custom-control-input" id="checkbox-{{$data->id}}" data-id="{{$data->id}}">
                                                <label for="checkbox-{{$data->id}}" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td class="align-middle">{{$data->name}}</td>
                                        <td class="align-middle">
                                            @if (empty($data->phone))
                                                -
                                            @else
                                                (+{{$data->country_code->phone_code}}) <span class="guest_phone">{{$data->phone}}</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">{{$data->is_visited == Constant::TRUE_CONDITION ? $y2 : $n2}}</td>
                                        <td class="align-middle">{{empty($data->visitors_date) ? '-' : Carbon\Carbon::parse($data->visitors_date)->locale(Constant::DEFAULT_COUNTRY_CODE)->isoFormat(Constant::ISO_FORMAT_DATE_TIME)}}</td>
                                        <td class="align-middle">{{$data->status == Constant::TRUE_CONDITION ? $y1 : $n1}}</td>
                                        <td class="align-middle">{{$data->presence > 0 ? $data->presence.' orang' : '-'}}</td>
                                        <td class="align-middle">
                                            <span
                                                @if (count($data->guest_presence) > 0)
                                                    data-toggle="tooltip"
                                                    title="
                                                        @foreach ($data->guest_presence as $gp_no => $gp)
                                                            {{($gp_no == 0 ? null : ', ') . $gp->presence . ' orang pada: ' . Carbon\Carbon::parse($gp->date . ' ' . $gp->time)->locale(Constant::DEFAULT_COUNTRY_CODE)->isoFormat(Constant::ISO_FORMAT_DATE_TIME)}}
                                                        @endforeach
                                                        "
                                                @endif
                                                >
                                                @if ($data->guest_presence->sum('presence') == 0)
                                                    -
                                                @else
                                                    <b>{{$data->guest_presence->sum('presence') . ' orang'}}</b>{{(count($data->guest_presence) > 1 ? ' di ' . count($data->guest_presence) . ' hari' : null)}}
                                                @endif
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            @if (++$no <= $maxGuest)
                                                <span class="badge badge-success">Aktif</span>
                                            @else
                                                <span class="badge badge-danger">Tidak Aktif</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{route('guest.edit',$data->id)}}" class="btn btn-icon btn-outline-primary btn-sm" data-toggle="tooltip" title="Edit" style="margin: 2px 0px;">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <span data-id="{{$data->id}}" data-guest-name="{{$data->name}}" class="btn btn-icon btn-outline-danger btn-sm swal-confirm" data-toggle="tooltip" title="Hapus" style="margin: 2px 0px;">
                                                <form action="{{route('guest.destroy',$data->id)}}" id="delete{{$data->id}}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                                <i class="fas fa-trash-alt"></i>
                                            </span>
                                            <a href="{{route('guest.message_send',['guest_id' => $data->id])}}" target="_blank" class="btn btn-icon btn-success btn-sm" data-toggle="tooltip" title="Kirim Undangan ke Whatsapp" style="margin: 2px 0px;"><i class="fas fa-paper-plane"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-state-icon"><i class="fas fa-question"></i></div>
                        <h2>Tidak ada data Tamu</h2>
                        <p class="lead">Kamu belum menambahkan Tamu. Click Button Tambah <span class="text-primary" style="cursor:pointer;" onclick="location.href='{{route('guest.create')}}'"><i class="fas fa-plus"></i></span> untuk menambahkan Tamu.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('page-script')
<script src="{{asset('assets/js/jquery.mask.js')}}"></script>

<script>
    "use strict";

    /* Custom filtering function which will search data in spesific column based on their value */
    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
        var searchStat = $('#search-stat').val().trim();
        var searchOpen = $('#search-open').val().trim();
        var dataStat = data[5].toString().trim(); // use data for the Status column
        var dataOpen = data[3].toString().trim(); // use data for the is_visited column

        if ((searchStat == dataStat || searchStat == "") && (searchOpen == dataOpen || searchOpen == "") && settings.nTable.id == 'table-guests') {
            return true;
        }
        return false;
    });

    const mask_phone_string = '{{Constant::MASK_PHONE}}';
    $(document).ready(function() {
        $('.guest_phone').mask(mask_phone_string);

        var tableGuests = $('#table-guests').DataTable({
            "columnDefs": [
                { "orderable": false, "targets": 'nosort' },
                { "searchable": false, "targets": 'nosearch' }
            ]
        });

        // Event listener to stat filtering inputs to redraw on input
        $('#search-stat').change(function () {
            tableGuests.draw();
        });

        // Event listener to is_visited filtering inputs to redraw on input
        $('#search-open').change(function () {
            tableGuests.draw();
        });
    });

    $(".swal-confirm").click(function(e) {
        // id = e.target.dataset.id; // ambil target id dari element dataset(data-id)
        var id = $(this).data('id');
        Swal.fire({
            title: "Hapus Tamu '" + $(this).data('guest-name') + "'?",
            text: "Data Tamu yang dihapus tidak dapat dikembalikan lagi!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        })
        .then((result) => {
            if (result.isConfirmed) {
                $(`#delete${id}`).submit();
            }
        });
    });

    $("[data-checkboxes]").each(function() {
        var me = $(this),
            group = me.data('checkboxes'),
            role = me.data('checkbox-role');

        me.change(function() {
            var all = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"])'),
            checked = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"]):checked'),
            dad = $('[data-checkboxes="' + group + '"][data-checkbox-role="dad"]'),
            total = all.length,
            checked_length = checked.length;

            if (role == 'dad') {
                if (me.is(':checked')) {
                    all.prop('checked', true);
                } else {
                    all.prop('checked', false);
                }
            } else {
                if (checked_length >= total) {
                    dad.prop('checked', true);
                } else {
                    dad.prop('checked', false);
                }
            }
        });
    });

    $('#btnDestroyGuests').on('click', function(e) {
        var allVals = [];
        $('[data-checkboxes="cb_guest_group"]:not([data-checkbox-role="dad"]):checked').each(function() {
            allVals.push($(this).attr('data-id'));
        });
        if (allVals.length <= 0) {
            Swal.fire({ title: 'Pilih Tamu yang ingin dihapus!', icon: 'warning'});
        } else {
            Swal.fire({
                title: 'Hapus ' + allVals.length + ' Tamu yang dipilih?',
                text: "Tamu yang dihapus tidak dapat dikembalikan lagi.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true
            })
            .then((result) => {
                if (result.isConfirmed) {
                    var join_selected_values = allVals.join(",");
                    $.ajax({
                        url: $(this).data('url'),
                        type: 'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+join_selected_values,
                        success: function (data) {
                            if (data['success'] || data['error']) {
                                window.location.href = "{{route('guest.routehelper',['','',''])}}" + "/" + data['route_name'] + "/" + data['msg'] + "/" + data['msg_content'];
                            } else {
                                window.location.href = "{{route('guest.routehelper',['guest.index', 'error', 'Maaf, terjadi kesalahan!'])}}";
                            }
                        },
                        error: function (data) {
                            Swal.fire({ title: data.responseText, icon: 'danger'});
                        }
                    });
                }
            });
        }
    });
</script>

@endpush
