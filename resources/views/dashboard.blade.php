@extends('layouts.master')
@section('title','Dashboard')
@section('content')
        <div class="section-body">
          @role(Constant::ROLE_ADMIN)
          <h2 class="section-title">General</h2>
          {{-- <p class="section-lead"></p> --}}
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total user</h4>
                  </div>
                  <div class="card-body">
                    {{Auth::user()->count()}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <a href="{{route('admininvoicepayment.index')}}">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-warning">
                    <i class="fas fa-dollar-sign"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Incoming</h4>
                    </div>
                    <div class="card-body">
                      <div class="text-truncate">{{$invoice_payments->count()}}</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-credit-card"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Bank Accounts</h4>
                  </div>
                  <div class="card-body">
                    <div class="text-truncate">{{$bank_accounts->count()}}</div>
                  </div>
                </div>
              </div>
            </div>
            {{-- NON-AKTIF FEEDBACKS
              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{route('feedback.index')}}">
                  <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                      <i class="fas fa-comments"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Feedbacks</h4>
                      </div>
                      <div class="card-body">
                        {{count($feedbacks)}}
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            --}}
          </div>

          <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="d-inline">Incoming Payments</h4>
                  <div class="card-header-action">
                    <a href="{{route('admininvoicepayment.index')}}" class="btn btn-primary">Go to page</a>
                  </div>
                </div>
                <div class="card-body">
                  @if ($invoice_payments->count() > 0)
                    <ul class="list-unstyled list-unstyled-border">
                      @foreach ($invoice_payments as $inv_no => $inv)
                        <li class="media">
                          <img class="mr-3 rounded-circle" width="50" src="{{asset('assets/img/levels/'.$inv->invoice->invoice_type->invoice_level->image)}}" alt="{{$inv->invoice->template_category->name}} - {{$inv->invoice->invoice_type->name}}">
                          <div class="media-body">
                            <div class="float-right"><img height="60" src="{{asset('assets/img/banks/'.$inv->invoice->bank_account->bank_master->image)}}" alt="{{$inv->invoice->bank_account->bank_master->name}}"></div>
                            <h6 class="media-title">{{$inv->invoice->template_category->name}} - {{$inv->invoice->invoice_type->name}}</h6>
                            <div class="text-small text-muted">{{$inv->invoice->user->name}} <div class="bullet"></div> <span id="inv-payment-date-{{$inv->id}}" class="inv-payment-date text-primary" data-date="{{Carbon\Carbon::parse($inv->date)->toIso8601String()}}"></span></div>
                          </div>
                        </li>
                        @if (++$inv_no == Constant::MAX_INVOICE_PAYMENT_DISPLAYED_ON_DASHBOARD)
                          @break
                        @endif
                      @endforeach
                    </ul>
                  @else
                    <div class="text-center pt-1 pb-1">
                      <p>Tidak ada</p>
                    </div>
                  @endif
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Popular Template</h4>
                </div>
                <div class="card-body">
                  <div class="row">
                    @if (count($wedding_templates) > 0)
                      @foreach ($wedding_templates as $wt_no => $wt)
                        <div class="col text-center">
                          <div class="mt-2 rounded-circle" style="margin:auto;width:60px;height:60px;opacity:1;background-image:url({{asset('assets/img/wedding/template/'.$wt->template->photo)}});background-position:center;background-repeat:no-repeat;background-size:cover;"></div>
                          <div class="mt-2 font-weight-bold">{{$wt->template->name}}</div>
                          <div class="text-muted text-small">{{round($wt->count / $sum_wedding_templates * 100, 2)}} %</div>
                        </div>
                        @if (++$wt_no == Constant::MAX_POP_TEMPLATE_DISPLAYED_ON_DASHBOARD)
                          @break
                        @endif
                      @endforeach
                    @else
                      <div class="col text-center pt-1 pb-1">
                        <p>Tidak ada</p>
                      </div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-8 col-md-6 col-sm-12 col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Bank Payment Lists</h4>
                  {{--
                    <div class="card-header-action">
                      <a href="#" class="btn btn-primary">View All</a>
                    </div>
                  --}}
                </div>
                <div class="card-body">
                  @if ($bank_accounts->count() > 0)
                    <ul class="list-unstyled list-unstyled-border">
                      @foreach ($bank_accounts as $ba_no => $ba)
                        <li class="media">
                          <img class="mr-3" height="50" width="70" src="{{asset('assets/img/banks/'.$ba->bank_master->image)}}" alt="{{$ba->bank_master->name}}">
                          <div class="media-body">
                            <div class="media-right">{{$ba->name}}</div>
                            <div class="media-title">{{$ba->number}} - {{$ba->bank_master->name}} ({{$ba->currency->code}})</div>
                            <div class="text-muted text-small">by {{$ba->user->name}} - {{$ba->user->email}} <div class="bullet"></div> <span id="bank-account-date-{{$ba->id}}" class="bank-account-date text-primary" data-date="{{Carbon\Carbon::parse($ba->created_at)->toIso8601String()}}"></span></div>
                          </div>
                        </li>
                      @endforeach
                    </ul>
                  @else
                    <div class="text-center pt-1 pb-1">
                      <p>Tidak ada</p>
                    </div>
                  @endif
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Feedbacks</h4>
                </div>
                <div id="recent-feedback-list" class="card-body">
                  <div class="text-center pt-1 pb-1">
                    <p>Loading...</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endrole

          {{-- WEDDING --}}
          <h2 class="section-title">{{Constant::CODE_WEDDING}}</h2>
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <a href="{{route('subscribe.index')}}">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-primary">
                    <i class="fas fa-star"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Paket Aktif</h4>
                    </div>
                    <div class="card-body">
                      {{$active_invoice_wedding->invoice_type->name ?? '-'}}
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-th-large"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Template</h4>
                  </div>
                  <div class="card-body">
                    <div class="text-truncate">{{$wedding->template->name}}</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-music"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Music</h4>
                  </div>
                  <div class="card-body">
                    <div class="text-truncate">{{$wedding->music->name}}</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <a href="{{route('gallery.index')}}">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-danger">
                    <i class="fas fa-images"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Galeri</h4>
                    </div>
                    <div class="card-body">
                      {{count($gallery)}}
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <a href="{{route('story.index')}}">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-info">
                    <i class="fas fa-dove"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Cerita Cinta</h4>
                    </div>
                    <div class="card-body">
                      {{count($story)}}
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <a href="{{route('guest.index')}}">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-primary">
                    <i class="fas fa-users"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Tamu</h4>
                    </div>
                    <div class="card-body">
                      {{count($guest)}}
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-envelope"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Link Undangan</h4>
                  </div>
                  <div class="card-body">
                    <a href="{{route('invitation.index', [strtolower(Constant::CODE_WEDDING), $wedding_template_user->user_url])}}" target="_blank">Buka</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-image"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Link Slideshow</h4>
                  </div>
                  <div class="card-body">
                    <a href="{{route('slideshow.index', [strtolower(Constant::CODE_WEDDING), $wedding_template_user->user_url])}}" target="_blank">Buka</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12 col-sm-6 col-md-6 col-lg-6">
              <div class="card">
                <div class="card-header">
                  <h4>Rencana Kehadiran Tamu</h4>
                </div>
                <div class="card-body"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                  <canvas id="myChart3" style="display: block; width: 307px; height: 153px;" width="614" height="306" class="chartjs-render-monitor"></canvas>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6">
              <div class="card">
                <div class="card-header">
                  <h4>Actual Tamu yang Hadir vs Rencana Tamu yang Hadir</h4>
                </div>
                <div class="card-body"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                  <canvas id="myChart4" style="display: block; width: 307px; height: 153px;" width="614" height="306" class="chartjs-render-monitor"></canvas>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-8 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Pengunjung</h4>
                  <div class="card-header-action">
                    <div class="btn-group">
                      {{--
                      <a href="#" class="btn btn-primary">Week</a>
                      <a href="#" class="btn">Month</a>
                      --}}
                    </div>
                  </div>
                </div>
                <div class="card-body"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                  <canvas id="myChart" height="528" style="display: block; width: 436px; height: 264px;" width="872" class="chartjs-render-monitor"></canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Salam baru baru ini</h4>
                </div>
                <div id="recent-greeting-list" class="card-body">
                  <div class="text-center pt-1 pb-1">
                    <p>Loading...</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection

@push('page-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
<script src="{{asset('assets/js/chart.min.js')}}"></script>

<script>
  var statistics_chart = document.getElementById("myChart").getContext('2d');

  const labelNames = [];
  const visitorDatas = [];
  // const days = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
  const days = ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];
  // const months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
  const months = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
  const max_data = '{{Constant::VISITOR_DATA_IN_LAST_UNIT}}';
  const unit_code = '{{Constant::VISITOR_GRAPH_DISTANCE_UNIT}}';

  for (let i = 0; i < max_data; i++) {
    const today = new Date();
    let d = null;
    let labelVal = "";
    if (unit_code == 'D') {
      d = new Date(new Date(today.setDate(today.getDate() - i)));
      labelVal = dateTimeCustomFormat("yyyy-MM-dd", d);
      labelNames.unshift(days[d.getDay()]);
    } else if (unit_code == 'M') {
      d = new Date(new Date(today.setMonth(today.getMonth() - i)));
      labelVal = dateTimeCustomFormat("yyyy-MM-01", d);
      labelNames.unshift(months[d.getMonth()] + ' ' + d.getFullYear());
    }
    var dataVal = 0;
    @foreach ($wedding_visitor_datas as $v_no => $v_data)
      if (labelVal == '{{$v_data->date}}') {
        dataVal = '{{$v_data->count}}';
      }
    @endforeach
    visitorDatas.unshift(dataVal);
  }

  var myChart = new Chart(statistics_chart, {
    type: 'line',
    data: {
      labels: labelNames,
      datasets: [{
        label: 'Statistics',
        data: visitorDatas,
        borderWidth: 5,
        borderColor: '#6777ef',
        backgroundColor: 'transparent',
        pointBackgroundColor: '#fff',
        pointBorderColor: '#6777ef',
        pointRadius: 4
      }]
    },
    options: {
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          gridLines: {
            display: false,
            drawBorder: false,
          },
          ticks: {
            stepSize: 100
          }
        }],
        xAxes: [{
          gridLines: {
            color: '#fbfbfb',
            lineWidth: 2
          }
        }]
      },
    }
  });

  var ctx = document.getElementById("myChart3").getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      datasets: [{
        data: [
          '{{$wedding_guest_plan_present}}',
          '{{$wedding_guest_plan_not_present}}',
        ],
        backgroundColor: [
          '#63ed7a',
          '#fc544b',
        ],
        label: 'Guest Plan Present'
      }],
      labels: [
        'Rencana Hadir',
        'Rencana Tidak Hadir'
      ],
    },
    options: {
      responsive: true,
      legend: {
        position: 'bottom',
      },
    }
  });

  var ctx = document.getElementById("myChart4").getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
      datasets: [{
        data: [
          '{{$wedding_guest_act_present}}',
          '{{$wedding_guest_plan_present_with_family}}',
        ],
        backgroundColor: [
          '#6777ef',
          '#63ed7a',
        ],
        label: 'Guest Actual Present vs Guest Plan Present With Family'
      }],
      labels: [
        'Actual Tamu yang Hadir',
        'Rencana Tamu yang Hadir'
      ],
    },
    options: {
      responsive: true,
      legend: {
        position: 'bottom',
      },
    }
  });
</script>

<script>
  $(document).ready(function() {
    $('#recent-greeting-list').load('{{route("dashboard.greeting")}}', function () {momentSetAll('greeting-date');});
    $('#recent-feedback-list').load('{{route("dashboard.feedback")}}', function () {momentSetAll('feedback-date');});
    momentSetAll('inv-payment-date');
    momentSetAll('bank-account-date');
  });

  function momentSetAll(class_name) {
    var all_comp = $("." + class_name).map(function() {
      return $(this).attr('id');
    }).get();

    jQuery.each( all_comp, function( i, id_comp_val ) {
      setMomentVal($('#' + id_comp_val));
    });
  }

  function setMomentVal(selector) {
    var selectorDate = new Date(selector.data('date')).getTime();
    selector.text(moment(selectorDate).fromNow());
    var x = setInterval( function() {
      selector.text(moment(selectorDate).fromNow());
    }, 60000);
  }

  $('#recent-greeting-list').on('click', '.btn-update-greeting', function () {
    var data_url = $(this).data('url');
    var stat = $(this).data('status');
    $.ajax({
      url: data_url,
      type: 'put',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: {status: stat},
      beforeSend: function() {
        $('#recent-greeting-list').empty();
        $('#recent-greeting-list').append('<div class="text-center pt-1 pb-1"><p>Processing...</p></div>');
      },
      success: function (data) {
        if (data['success']) {
          console.log('success: ' + data['success']);
        } else if (data['error']) {
          Swal.fire('error: ' + data['error']);
        } else if (data['error_validation']) {
          Swal.fire({ title: data['error_validation'], icon: 'error' });
        } else {
          Swal.fire({ title: 'Whoops Something went wrong!!', icon: 'error'});
        }
      },
      error: function (data) {
        // Swal.fire(data.responseText);
        Swal.fire({ title: 'Whoops Something went wrong!!', icon: 'error'});
      },
      complete: function () {
        $('#recent-greeting-list').load('{{route("dashboard.greeting")}}', function () {momentSetAll('greeting-date');});
      }
    });
  });

  $('#recent-feedback-list').on('click', '.btn-update-feedback', function () {
    var data_url = $(this).data('url');
    var stat = $(this).data('status');
    $.ajax({
      url: data_url,
      type: 'patch',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: {status: stat},
      beforeSend: function() {
        $('#recent-feedback-list').empty();
        $('#recent-feedback-list').append('<div class="text-center pt-1 pb-1"><p>Processing...</p></div>');
      },
      success: function (data) {
        if (data['success']) {
          console.log('success: ' + data['success']);
        } else if (data['error']) {
          Swal.fire('error: ' + data['error']);
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
        $('#recent-feedback-list').load('{{route("dashboard.feedback")}}', function () {momentSetAll('feedback-date');});
      }
    });
  });
</script>
@endpush
