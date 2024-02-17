<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
@include('invitation.wedding.link')

<link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/template/wedding/bright/css/reset.css')}}">
<link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/template/wedding/bright/css/grid_24.css')}}">
<link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/template/wedding/bright/css/style.css')}}">
<link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/template/wedding/bright/css/slider.css')}}">
<link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/template/wedding/bright/css/demo.css')}}">
<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>
<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="css/ie.css">
<![endif]-->
</head>
<body>
<header style="display:none;">
  <h1><a href="#"><img src="{{asset('assets/template/wedding/bright/images/logo.png')}}" alt=""></a></h1>
  <nav>
    <ul class="menu">
      <li class="current"><a href="#about">about</a></li>
      <li><a href="#wedding">wedding</a></li>
      <li><a href="#story">love story</a></li>
      <li><a href="#album">album</a></li>
      <li><a href="#wishes">friends wishes</a></li>
    </ul>
  </nav>
</header>
<div id="slide" style="display:none;">
  <div class="slider">
    <ul class="items">
      @if (count($gallery) > 0)
        @foreach ($gallery as $no_g => $g)
          @if ($no_g < 4)
            <li><img src="{{asset('assets/img/wedding/photo/gallery/'.$g->photo)}}" alt="" width="1680" height="668" style="object-fit:cover"></li>
          @endif
        @endforeach
      @else
      <li><img src="{{asset('assets/template/wedding/bright/images/slide-1.jpg')}}" alt=""></li>
      <li><img src="{{asset('assets/template/wedding/bright/images/slide-2.jpg')}}" alt=""></li>
      <li><img src="{{asset('assets/template/wedding/bright/images/slide-3.jpg')}}" alt=""></li>
      <li><img src="{{asset('assets/template/wedding/bright/images/slide-4.jpg')}}" alt=""></li>
      @endif
    </ul>
  </div>
  <ul class="pags">
    @if (count($gallery) > 0)
      @foreach ($gallery as $no_g => $g)
        @if ($no_g < 4)
          <li><a href="#"><img src="{{asset('assets/img/wedding/photo/gallery/'.$g->photo)}}" alt="" width="230" height="100" style="object-fit:cover"><span></span></a></li>
        @endif
      @endforeach
    @else
    <li><a href="#"><img src="{{asset('assets/template/wedding/bright/images/slide-1-small.jpg')}}" alt=""><span></span></a></li>
    <li><a href="#"><img src="{{asset('assets/template/wedding/bright/images/slide-2-small.jpg')}}" alt=""><span></span></a></li>
    <li><a href="#"><img src="{{asset('assets/template/wedding/bright/images/slide-3-small.jpg')}}" alt=""><span></span></a></li>
    <li><a href="#"><img src="{{asset('assets/template/wedding/bright/images/slide-4-small.jpg')}}" alt=""><span></span></a></li>
    @endif
  </ul>
  <a href="#" class="prev">&nbsp;</a><a href="#" class="next">&nbsp;</a>
</div>
<!--==============================Preview Alert================================-->
@if ($is_preview)
<div id="preview-alert" style="position:-webkit-sticky;position:sticky;top:0;z-index:1;display:none;">
  <section id="content">
    <div class="button-2">
      <h4 class="">Preview Mode</h4>
      <p>Mode ini hanya untuk melihat template yang tersedia dari pilihan Anda.</p>
      <hr>
      <p class="">Data yang ditampilkan merupakan data asli milik Anda walaupun dalam Preview Mode.</p>
    </div>
  </section>
</div>
@endif
<!--==============================About================================-->
<div id="about">
<section id="content">
  <div class="container_24">
    <div class="grid_12">
      <div class="top-1 right-1">
        <h3><strong>About</strong> {{empty($bride->nickname) ? 'The Bride' : $bride->nickname }}</h3>
        <div class="box-1"> <img src="{{empty($bride->photo) ? asset('assets/template/wedding/bright/images/page1-img1.jpg') : asset('assets/img/wedding/photo/bride/'.$bride->photo)}}" alt="" class="img-border img-indent" width="148px" height="181px" style="object-fit:cover">
          <div class="extra-wrap">
            <p class="text-1">{{empty($bride->name) ? 'The Bride' : $bride->name}}</p>
            <p class="text-2"></p>
          </div>
        </div>
        <div class="comments">
          <div class="comments-corner"></div>
          <div class="comment-1">
            <div class="comment-2">
              <p class="text-4">{{empty($bride->about) ? 'About The Bride...' : $bride->about }}</p>
              <p class="text-5 top-5"></p>
            </div>
          </div>
        </div>
        {{-- <p class="text-3 top-4">{{empty($bride->about) ? 'About The Bride...' : $bride->about }}</p>
        <p class="p-border"></p> --}}
        <!-- <a href="#" class="link-1">Read more</a> -->
      </div>
    </div>
    <!-- <div class="grid_1">
      <div class="line-2">&nbsp;</div>
    </div> -->
    <div class="grid_12">
      <div class="top-1">
        <h3><strong>About</strong> {{empty($groom->nickname) ? 'The Groom' : $groom->nickname }}</h3>
        <div class="box-1"> <img src="{{empty($groom->photo) ? asset('assets/template/wedding/bright/images/page1-img2.jpg') : asset('assets/img/wedding/photo/bride/'.$groom->photo)}}" alt="" class="img-border img-indent" width="148px" height="181px" style="object-fit:cover">
          <div class="extra-wrap">
            <p class="text-1">{{empty($groom->name) ? 'The Groom' : $groom->name }}</p>
            <p class="text-2"></p>
          </div>
        </div>
        <div class="comments">
          <div class="comments-corner"></div>
          <div class="comment-1">
            <div class="comment-2">
              <p class="text-4">{{empty($groom->about) ? 'About The Groom...' : $groom->about }}</p>
              <p class="text-5 top-5"></p>
            </div>
          </div>
        </div>
        <!-- <a href="#" class="link-1">Read more</a> -->
      </div>
    </div>
    <div class="clear"></div>
  </div>
</section>
</div>
<!--==============================Wedding================================-->
<div id="wedding">
<section id="content">
  <div class="container_24">
    <div class="grid_7">
      <div class="top-1 right-1">
        <div class="top-7">
          <h4 class="h4-border"><strong>Wedding</strong> info:</h4>
          <dl class="adr">
            <img src="{{count($gallery) > 0 ? asset('assets/img/wedding/photo/gallery/'.$gallery[0]->photo) : asset('assets/template/wedding/bright/images/page2-img2.jpg')}}" alt="" class="img-border" width="100%" style="object-fit:cover;">
            <div class="top-3"></div>
            <dd><span>Total:</span><strong class="clr-2">{{$event_count}}</strong></dd>
            <dd><span>Duration:</span><strong class="clr-2">{{$hours_spent > 1 ? $hours_spent . ' hours' : $hours_spent . ' hour' }}</strong></dd>
          </dl>
        </div>
      </div>
    </div>
    <div class="grid_1">
      <div class="line-3">&nbsp;</div>
    </div>
    <div class="grid_15">
      <div class="top-1">
        <h3><strong>Wedding</strong> event:</h3>
        <div class="wrap">
          @if (count($event) > 0)
            @foreach ($event as $evn_no => $evn)
              <div class="{{($evn_no + 1) == count($event) ? 'box-2 last' : 'box-2'}}">
                <p class="text-1 top-4">{{empty($evn->name) ? $evn->event_type->name : $evn->name}}</p>
                @if (Carbon\Carbon::parse($evn->startdate)->format('d-M-Y') == Carbon\Carbon::parse($evn->enddate)->format('d-M-Y'))
                  <p class="text-3 top-3"><i class="fas fa-calendar"></i> {{Carbon\Carbon::parse($evn->startdate)->format('d M Y')}}</p>
                @else
                  <p class="text-3 top-3"><i class="fas fa-calendar"></i> {{Carbon\Carbon::parse($evn->startdate)->format('d M Y')}} - {{Carbon\Carbon::parse($evn->enddate)->format('d M Y')}}</p>
                @endif
                <p class="text-3 top-3"><i class="fas fa-clock"></i> {{Carbon\Carbon::parse($evn->startdate)->format('H:i T')}} - {{Carbon\Carbon::parse($evn->enddate)->format('H:i T')}}</p>
                <p class="text-3 top-3"><i class="fas fa-location-arrow"></i> {{$evn->place}}</p>
                @if ($gmaps_rule_value)
                  <div class="top-5">{!! $evn->map !!}</div>
                @endif
                <p class="top-5">{{$evn->address}}</p>
              </div>
            @endforeach
          @else
            <div class="top-1" style="text-align:center;">
              <p>Nothing to show</p>
            </div>
          @endif
        </div>
        <!-- <a href="#" class="link-1">Read more</a> -->
      </div>
    </div>
    <div class="clear"></div>
  </div>
</section>
</div>
<!--==============================Love Story================================-->
<div id="story">
<section id="content">
  <div class="container_24">
    <div class="grid_24">
      <div class="top-1">
        <h3><strong>Love</strong> story:</h3>
        <div class="box-3">
          @if (count($story) > 0)
            @foreach($story as $s_no => $s)
              <div class="{{($s_no + 1) % 4 == 0 ? 'fleft last top-7' : 'fleft top-7'}}">
                <div class="comments-3">
                  <p><i><strong class="clr-1">{{$s->title}}</strong></i></p>
                  <div class="comments-corner"></div>
                  <div class="comment-1">
                    <div class="comment-2">
                      <p><i>{{$s->desc}}</i></p>
                    </div>
                  </div>
                </div>
                <div class="comments-3-name text-1">{{Carbon\Carbon::parse($s->date)->format('d M Y')}}</div>
              </div>
            @endforeach
          @else
            <div class="top-1" style="text-align:center;">
              <p>Nothing to show</p>
            </div>
          @endif
          <div class="clear"></div>
        </div>
        <!-- <a href="#" class="link-1">Read more</a> -->
      </div>
    </div>
    <div class="clear"></div>
  </div>
</section>
</div>
<!--==============================Album================================-->
<div id="album">
<section id="content">
  <div class="container_24">
    <div class="grid_24">
      <h4 class="top-1"><strong>Our</strong> photo album:</h4>
    </div>
    @if (count($gallery) > 0)
      @foreach ($gallery as $gallery_no => $glr)
        <div class="top-1 grid_8">
          <a href="{{asset('assets/img/wedding/photo/gallery/'.$glr->photo)}}" target="_blank">
            <img src="{{asset('assets/img/wedding/photo/gallery/'.$glr->photo)}}" alt="{{$glr->name}}" width="100%">
          </a>
        </div>
      @endforeach
    @else
      <div class="top-1 grid_24" style="text-align:center;">
        <p>No photo</p>
      </div>
    @endif
    <div class="clear"></div>
  </div>
</section>
</div>
<!--==============================Wishes================================-->
<div id="wishes">
<section id="content">
  <div class="container_24">
    <div class="grid_24">
      <div class="top-1">
        <h4><strong>Friends</strong> wishes:</h4>
        @if($is_has_guest)
          <button id="btn-create-greeting" class="button" style="vertical-align:middle"><span>Send Your Wishes </span></button>
          <div class="top-3"></div>
				@endif
        @if (count($greeting) > 0)
          @foreach ($greeting as $greeting_no => $grt)
            @if (($greeting_no + 1) % 4 == 1)
              <div class="box-4 wrap">
            @endif
            <div class="{{($greeting_no + 1) % 4 == 0 ? 'fleft last' : 'fleft'}}">
              <div class="box-1">
                {{-- <img src="{{asset('assets/template/wedding/bright/images/page5-img1.jpg')}}" alt="{{$grt->guest->name}}" class="img-border img-indent"> --}}
                <div class="extra-wrap">
                  <p class="text-1">{{$grt->guest->name}}</p>
                  <p class="text-2">{{Carbon\Carbon::parse($grt->date)->format('d M Y H:i')}}</p>
                </div>
              </div>
              <div class="comments-4">
                <div class="comments-corner"></div>
                <div class="comment-1">
                  <div class="comment-2">
                    {{-- <p class="text-4"><strong class="clr-1">Vivamus sed arcu duieu tincidunt sem.</strong> Vivamus endrerit mauris ut dui gravida ut viverra lectus tincidunt. Cras mattis tempor eros nec tristique. Sed sed felis arcu, vel vehicula augue.</p> --}}
                    <p class="text-4"><strong class="clr-1">{{$grt->greeting}}</strong></p>
                  </div>
                </div>
              </div>
            </div>
            @if (($greeting_no + 1) % 4 == 0 || ($greeting_no + 1) == count($greeting))
              </div>
            @endif
          @endforeach
          <span id="btn-load-greeting" class="link-1" style="cursor:pointer;">Read more</span>
        @else
          <div class="top-1 grid_24" style="text-align:center;">
            <p>Friends Wishes will appear here</p>
          </div>
        @endif
      </div>
    </div>
    <div class="clear"></div>
  </div>
</section>
</div>
<!--==============================Contact================================-->
@if ($is_has_guest)
<section id="content">
  <div class="container_24">
    <div class="grid_6 suffix_1">
      <div class="top-1">
        <h4 class="h4-border"><strong>Guest</strong> info:</h4>
        <dl class="adr">
          <img src="{{count($gallery) > 0 ? asset('assets/img/wedding/photo/gallery/'.$gallery[0]->photo) : asset('assets/template/wedding/bright/images/page2-img2.jpg')}}" alt="" class="img-border" width="100%" style="object-fit:cover;">
          {{-- <dt class="clr-1"><strong>Kate &amp; Leo</strong></dt>
          <dd class="line-height">8901 Marmora Road, Glasgow, D04 89GR</dd> --}}
          <div class="top-3"></div>
          <dd><span>Estimate:</span><strong class="clr-2">{{$guest_estimate}}</strong></dd>
          <dd><span>Presence:</span><strong class="clr-2">{{$guest_act_presence}}</strong></dd>
          {{-- <dd class="p1"><span>Email:</span><a href="#" class="link">mail@thomsander.com</a></dd> --}}
        </dl>
      </div>
    </div>
    <div class="grid_1">
      <div class="line-5">&nbsp;</div>
    </div>
    <div class="grid_16">
      <div class="top-1">
        <h4 class="h4-border"><strong>Are You</strong> attending?</h4>
        <form action="#" id="form" method="post" >
          <p class="top-3">Silakan isi formulir di bawah untuk memberi tahu {{empty($groom->nickname) ? 'Pengantin Pria' : $groom->nickname}} dan {{empty($bride->nickname) ? 'Pengantin Wanita' : $bride->nickname}} bahwa Anda akan hadir. <i id="info-batal-atau-abaikan">{{$guest->status == Constant::TRUE_CONDITION ? "Klik 'Batalkan'" : 'Abaikan ini'}}</i> jika Anda tidak berkenan hadir. Terima kasih.</p>
          <div class="top-3">
            <div class="div-info-status-hadir"><p>Status kehadiran: <span id="info-status-hadir" class="text-3">{{$guest->status == Constant::TRUE_CONDITION ? 'Hadir' : 'Tidak Hadir'}}</span></p></div>
            <div class="info-jumlah-tamu-dan-tombol-batalkan" @if ($guest->status == Constant::FALSE_CONDITION) style="display:none;" @endif><p>Tamu yang akan hadir: <span id="info-jumlah-hadir" class="text-3">{{$guest->presence}}</span></p></div>
            <div class="info-jumlah-tamu-dan-tombol-batalkan" @if ($guest->status == Constant::FALSE_CONDITION) style="display:none;" @endif><a style="cursor:pointer" class="btn-update-presence button-2" data-type="CANCEL">Batalkan</a></div>
          </div>
          <fieldset class="top-1">
            <label><strong>Nama:</strong>
              <input type="text" id="guest_name" name="name" placeholder="Name" value="{{$guest_name}}" disabled>
              <strong class="clear"></strong></label>
            <label><strong>Berapa?</strong>
              <input type="number" class="" id="guest_presence" name="presence" placeholder="Berapa banyak yang akan hadir denganmu?" min="{{Constant::MIN_PRESENCE_OF_EACH_GUEST}}" max="{{Constant::MAX_PRESENCE_OF_EACH_GUEST}}">
              <strong class="clear"></strong></label>
            <strong class="clear"></strong>
            <div class="btns"><a class="button btn-update-presence" style="vertical-align:middle" data-type="UPDATE"><span>{{$guest->status == Constant::TRUE_CONDITION ? 'Update kehadiran' : 'Saya akan datang'}} </span></a></div>
          </fieldset>
        </form>
        <div>{!!$guest_qr_code!!}</div>
      </div>
    </div>
    <div class="clear"></div>
  </div>
</section>
@endif
<!--==============================Footer=================================-->
<footer>
  <p><strong>&copy; {{Carbon\Carbon::now()->format('Y')}} <a href="/" target="_blank">{{config('app.name')}}</a>. All Rights Reserved.</strong><br>
    Website Template by <a target="_blank" href="http://www.templatemonster.com/" class="link">TemplateMonster.com</a></p>
  {{-- <div class="soc-icons"><a href="#"><img src="{{asset('assets/template/wedding/bright/images/icon-1.png')}}" alt=""></a><a href="#"><img src="{{asset('assets/template/wedding/bright/images/icon-2.png')}}" alt=""></a><a href="#"><img src="{{asset('assets/template/wedding/bright/images/icon-3.png')}}" alt=""></a></div> --}}
</footer>

<!--==============================Player=================================-->
<div class="music-console" style="cursor:pointer;">
	<span id="music-rotate" class="rotate" style="animation-play-state:paused;"><img src="{{asset('assets/template/wedding/sweety/images/icon-music.png')}}" width="100%"></span>
	<div id="player" style="display:none;"></div>
</div>

<!--==============================Cover=================================-->
<div class="invitation-cover" style="background-image:url({{empty($wedding->photo_sampul) ? asset('assets/template/wedding/bright/images/img_bg_2.jpg') : asset('assets/img/wedding/photo/sampul/'.$wedding->photo_sampul)}});background-position:center;background-repeat:no-repeat;background-size:cover;">
	<div class="invitation-cover-content" style="height:100%;opacity:0.9;background-image:url({{asset('assets/template/wedding/bright/images/img_bg_2.jpg')}});background-position:center;background-repeat:no-repeat;background-size:cover;">
		<div>
			<div style="padding: 20px;">
				<h3>The Wedding of</h3>
				<h2>{{empty($groom->nickname) ? 'Pria' : $groom->nickname}} &amp; {{empty($bride->nickname) ? 'Wanitanya' : $bride->nickname}}</h2>
				<br>
				<h6>{{count($event) > 0 ? Carbon\Carbon::parse($event[0]->startdate)->format('D, d M Y') : 'Tanggal dan Tempat acara akan tampil di sini.' }}</h3>
				<br>
				@if($is_has_guest)<h3><strong>{{$guest_name}}</strong></h3>@endif
				<p>{{$is_has_guest ? "We invited you to celebrate our wedding" : "Let's celebrate our wedding"}}</p>
				<br><br>
				{{-- <input type="button" id="btn-open" class="button-1" value="Open Invitation"> --}}
        <button id="btn-open" class="button" style="vertical-align:middle"><span>Open Invitation </span></button>
			</div>
		</div>
	</div>
</div>

@if($is_has_guest)
<!-- Custom Modal Create Greeting -->
<div id="modalGreeting" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="modal-btn-close">&times;</span>
      <h3 class="top-3">Send Your Wishes</h3>
      <div class="top-3"></div>
    </div>
    <div class="modal-body">
      <form id="form-store-greeting" action="{{route('invitation.guest.store_greeting',[$template_category->name,$template_user->user_url])}}" method="POST">
        @csrf
        @method('post')
			  <input type="hidden" name="name" value="{{$guest_name}}">
        <textarea name="greeting" class="textarea" rows="6" placeholder="Type Your wishes here...">{{old('greeting')}}</textarea>
      </form>
    </div>
    <div class="modal-footer">
      <button id="btnSaveGreeting" class="button" style="vertical-align:middle"><span>Send </span></button>
    </div>
  </div>
</div>
@endif

<!-- Custom Modal Load Greeting -->
<div id="modalLoadGreeting" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="modal-btn-close">&times;</span>
      <h3 class="top-3">Friends Wishes</h3>
      <div class="top-3"></div>
    </div>
    <div class="modal-body">
      <div id="load_greeting" class="box-4 wrap"></div>
    </div>
    <div class="modal-footer">
      <div class="text-center">
        <div class="top-3"></div>
        <p id="no-more-data" class="text-1" style="display:none;">No more wishes</p>
        <button id="btn-load-more-greeting" class="button" style="vertical-align:middle"><span>Load more </span></button>
        <div class="loading"></div>
        <div class="top-3"></div>
      </div>
    </div>
  </div>
</div>

<script src="{{asset('assets/template/wedding/bright/js/jquery-1.7.min.js')}}"></script>
<script src="{{asset('assets/template/wedding/bright/js/jquery.easing.1.3.js')}}"></script>
<script src="{{asset('assets/template/wedding/bright/js/uCarousel.js')}}"></script>
<script src="{{asset('assets/template/wedding/bright/js/tms-0.4.1.js')}}"></script>

  <script src="{{asset('assets/stisla/sweetalert/dist/sweetalert.min.js')}}"></script>

	<script src="https://unpkg.com/wavesurfer.js"></script>

	@include('layouts.script_custom_format_date_time')

	<script type="text/javascript">
    var paginate = '{{Constant::MAX_GREETING_DISPLAYED}}';
		var page = 1;
    loadMoreData(paginate, page);

		$('#btn-load-more-greeting').click(function() {
			page++;
			loadMoreData(paginate, page);
		});

        function loadMoreData(paginate, page) {
            $.ajax({
                url: "{{route('greeting.get', [$template_category->id, $template_user->user_id, ''])}}" + '/' + paginate + '?page=' + page,
                type: 'get',
				// headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                datatype: 'json',
                beforeSend: function() {
					$('#btn-load-more-greeting').hide();
                    $('.loading').show();
                }
            })
            .done(function(data) {
				var jsonResult = JSON.parse(data['greeting']);
				var dataResult = jsonResult['data'];
                if(dataResult.length == 0) {
					$('#btn-load-more-greeting').hide();
					$('.loading').hide();
					$('#no-more-data').show();
                    return;
				} else {
					$('#btn-load-more-greeting').show();
                    $('.loading').hide();
					for (const i in dataResult) {
						$('#load_greeting').append(generate_greeting_item_html(dataResult[i].guest_name, dataResult[i].date, dataResult[i].greeting));
					}
				}
            })
			.fail(function(jqXHR, ajaxOptions, thrownError) {
				swal('Something went wrong.', {icon: 'error'});
			});
        }
    </script>

    <script>
		var player = WaveSurfer.create({
			container: '#player',
			// waveColor: 'gray',
			// progressColor: '#6777ef',
			// height: 30,
			// cursorColor: '#6777ef',
			// responsive: true,
		});

		// Jika Pake WaveSurfer
		player.on('ready', function () {
			player.play();
			$('#music-rotate').css('animation-play-state','running');
		});

		player.on('finish', function () {
			player.play();
		});

		$('.music-console').click(function() {
			if ($('#music-rotate').css('animation-play-state') == 'running') {
				player.pause();
				$('#music-rotate').css('animation-play-state','paused');
			} else {
				player.play();
				$('#music-rotate').css('animation-play-state','running');
			}
		});

		$('.btn-update-presence').click(function() {
			// $('#guest_name').prop("disabled", false);
			$.ajax({
				url: "{{route('invitation.guest.update_presence',[$template_category->name,$template_user->user_url])}}",
				type: 'PUT',
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				data: {name: $('#guest_name').val(), presence: $('#guest_presence').val(), type: $(this).data('type')},
				success: function (data) {
					if (data['success'] || data['warning']) {
						if (data['success']) {
							swal(data['success'], {icon: 'success',});
						} else {
							swal(data['warning'], {icon: 'warning',});
						}
						$('#info-batal-atau-abaikan').text(data['info-batal-atau-abaikan']);
						$('#info-status-hadir').text(data['info-status-hadir']);
						$('#info-jumlah-hadir').text(data['info-jumlah-hadir']);
						if (data['info-jumlah-hadir'] > 0) {
							$('.info-jumlah-tamu-dan-tombol-batalkan').css('display', 'block');
							$('.btn-update-presence[data-type="UPDATE"]').text('Update kehadiran');
						} else {
							$('.info-jumlah-tamu-dan-tombol-batalkan').css('display', 'none');
							$('.btn-update-presence[data-type="UPDATE"]').text('Saya akan datang');
						}
					} else if (data['error']) {
						swal(data['error'], {icon: 'error',});
					} else {
						swal('Whoops Something went wrong!!', {icon: 'warning',});
					}
				},
				error: function (data) {
					// swal(data.responseText);
					// swal('Whoops Something went wrong!!\n\n' + data.responseText);
					swal('Maaf, terjadi kesalahan!', {icon: 'error'});
					// location.reload();
				}
			});
		});

		$('#btn-create-greeting').click(function() {
      $('header').fadeOut();
      $('#slide').fadeOut();
			// $('#modalGreeting').modal('show');
      $('#modalGreeting').css('display','block');
		});

    $('.modal-btn-close').click(function() {
			// $('.modal').modal('hide');
      $('.modal').css('display','none');
      $('header').fadeIn();
      $('#slide').fadeIn();
		});

		$('#btnSaveGreeting').click(function() {
			$.ajax({
				url: "{{route('invitation.guest.store_greeting',[$template_category->name,$template_user->user_url])}}",
				type: 'POST',
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				data: {name: $('#guest_name').val(), greeting: $('textarea[name="greeting"]').val()},
				success: function (data) {
					if (data['success']) {
						swal(data['success'], {icon: 'success',});
						$('textarea[name="greeting"]').val('');
						$('#modalGreeting').css('display','none');
					} else if (data['warning']) {
						swal(data['warning'], {icon: 'warning',});
					} else if (data['error']) {
						swal(data['error'], {icon: 'error',});
					} else {
						swal('Whoops Something went wrong!!', {icon: 'warning',});
					}
				},
				error: function (data) {
					swal('Maaf, terjadi kesalahan!', {icon: 'error'});
				}
			});
		});

		$('#btn-load-greeting').click(function() {
      $('header').fadeOut();
      $('#slide').fadeOut();
      $('#modalLoadGreeting').css('display','block');
		});
	</script>

<script>
$(document).ready(function(){});

$('#btn-open').click(function() {
	player.load("{{asset('assets/file/musik/'.$music->path)}}");
  // $('.invitation-cover').css('display','none');
	$('.invitation-cover').fadeOut();
	// $('header').css('display','block');
  $('header').fadeIn();
  // $('#slide').css('display','block');
  $('#slide').fadeIn();
	// $('.gototop').css('display','block');
  $('#preview-alert').fadeIn();

  $('.slider')._TMS({
		show:0,
		pauseOnHover:true,
		prevBu:'.prev',
		nextBu:'.next',
		playBu:false,
		duration:800,
		preset:'fade',
		pagination:'.pags',
		pagNums:false,
		slideshow:7000,
		numStatus:false,
		banners:false,
		waitBannerAnimation:false,
		progressBar:false
	});

  $('.gallery')
        ._TMS({
        show: 0,
        pauseOnHover: true,
        prevBu: false,
        nextBu: false,
        playBu: false,
        duration: 700,
        preset: 'fade',
        pagination: $('.img-pags')
            .uCarousel({
            show: 3,
            shift: 0,
            rows: 1
        }),
        pagNums: false,
        slideshow: 7000,
        numStatus: true,
        banners: false,
        waitBannerAnimation: false,
        progressBar: false
    });
});

function generate_greeting_item_html(name, date, text) {
  var customDate = dateTimeCustomFormat('d MMM yyyy hh:mm', date);
	return '<div class="fleft">'
          + '<div class="box-1">'
            + '<div class="extra-wrap">'
              + '<p class="text-1">' + name + '</p>'
              + '<p class="text-2">' + customDate + '</p>'
            + '</div>'
          + '</div>'
          + '<div class="comments-4">'
            + '<div class="comments-corner"></div>'
            + '<div class="comment-1">'
              + '<div class="comment-2">'
                + '<p class="text-4"><strong class="clr-1">' + text + '</strong></p>'
              + '</div>'
            + '</div>'
          + '</div>'
        + '</div>';
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  var modal = document.getElementsByClassName("modal");
  for (let i = 0; i < modal.length; i++) {
    if (event.target == modal[i]) {
      modal[i].style.display = "none";
      $('header').fadeIn();
      $('#slide').fadeIn();
    }
  }
}
</script>

</body>
</html>