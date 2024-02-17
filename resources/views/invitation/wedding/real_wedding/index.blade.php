<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
 
	@include('invitation.wedding.link')
    <link rel="apple-touch-icon" href="{{asset('assets/template/wedding/real_wedding/images/apple-touch-icon.png')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/template/wedding/real_wedding/css/bootstrap.min.css')}}">
    <!-- Pogo Slider CSS -->
    <link rel="stylesheet" href="{{asset('assets/template/wedding/real_wedding/css/pogo-slider.min.css')}}">
	<!-- Site CSS -->
    <link rel="stylesheet" href="{{asset('assets/template/wedding/real_wedding/css/style.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('assets/template/wedding/real_wedding/css/responsive.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('assets/template/wedding/real_wedding/css/custom.css')}}">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	<link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>

	<style>
		.swiper {
			width: 100%;
			padding-top: 40px;
			padding-bottom: 40px;
		}
		.swiper-slide {
			background-position: center;
			background-size: cover;
			width: 400px;
			height: 400px;
		}
		.swiper-slide img {
			display: block;
			width: 100%;
		}
    </style>
</head>
<body id="home" data-spy="scroll" data-target="#navbar-wd" data-offset="98">

	<!-- LOADER -->
    <div id="preloader">
		<div class="preloader pulse">
			<i class="fa fa-heartbeat" aria-hidden="true"></i>
		</div>
    </div><!-- end loader -->
    <!-- END LOADER -->

	<!-- Start header -->
	<header class="top-header" style="display:none;">
		<nav class="navbar header-nav navbar-expand-lg">
            <div class="container">
				<a class="navbar-brand" href="#"><img src="{{asset('assets/template/wedding/real_wedding/images/logo.jpg')}}" alt="image"></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-wd" aria-controls="navbar-wd" aria-expanded="false" aria-label="Toggle navigation">
					<span></span>
					<span></span>
					<span></span>
				</button>
                <div class="collapse navbar-collapse justify-content-end" id="navbar-wd">
                    <ul class="navbar-nav">
                        <li><a class="nav-link active" href="#home">Home</a></li>
                        <li><a class="nav-link" href="#about">Couple</a></li>
						<li><a class="nav-link" href="#events">Events</a></li>
                        <li><a class="nav-link" href="#story">Story</a></li>
						<li><a class="nav-link" href="#gallery">Gallery</a></li>
                        <li><a class="nav-link" href="#wishes">Wishes</a></li>
                    </ul>
                </div>
            </div>
        </nav>
		<!-- PREVIEW ALERT -->
		@if ($is_preview)
		@include('invitation.wedding.preview_alert')
		@endif
		<!-- END PREVIEW ALERT -->
	</header>
	<!-- End header -->

	<!-- Start Banner -->
	<div class="ulockd-home-slider" style="display:none;">
		<div class="container-fluid">
			<div class="row">
				<div class="pogoSlider" id="js-main-slider">
					@if (count($gallery) > 1)
						@foreach ($gallery as $no_g => $g)
							<div class="pogoSlider-slide"
							@if (($no_g + 1) % 3 == 1)
								data-transition="zipReveal" data-duration="1500"
							@elseif (($no_g + 1) % 3 == 2)
								data-transition="blocksReveal" data-duration="1500"
							@elseif (($no_g + 1) % 3 == 0)
								data-transition="shrinkReveal" data-duration="2000"
							@else
								data-transition="zipReveal" data-duration="1500"
							@endif
							style="background-image:url({{asset('assets/img/wedding/photo/gallery/'.$g->photo)}});">
								<div class="lbox-caption">
									<div class="lbox-details">
										<h1>{{empty($bride->nickname) ? 'The Bride' : $bride->nickname }} & {{empty($groom->nickname) ? 'The Groom' : $groom->nickname }}</h1>
										<h2>We're getting married</h2>
										<p><strong>{{count($event) > 0 ? Carbon\Carbon::parse($event[0]->startdate)->format('D, d M Y') : 'Create an event to display the date'}}</strong></p>
										@if ($event_count > 0)
											<a href="{{$save_date_link}}" target="_blank" class="btn">Save the date</a>
										@endif
									</div>
								</div>
							</div>
							@if ($no_g == 2)
								@break
							@endif
						@endforeach
					@else
						<div class="pogoSlider-slide" data-transition="zipReveal" data-duration="1500" style="background-image:url({{asset('assets/template/wedding/real_wedding/images/slider-01.jpg')}});">
							<div class="lbox-caption">
								<div class="lbox-details">
									<h1>{{empty($bride->nickname) ? 'The Bride' : $bride->nickname }} & {{empty($groom->nickname) ? 'The Groom' : $groom->nickname }}</h1>
									<h2>We're getting married</h2>
									<p><strong>{{count($event) > 0 ? Carbon\Carbon::parse($event[0]->startdate)->format('D, d M Y') : 'Create an event to display the date'}}</strong></p>
									@if ($event_count > 0)
										<a href="{{$save_date_link}}" target="_blank" class="btn">Save the date</a>
									@endif
								</div>
							</div>
						</div>
						<div class="pogoSlider-slide" data-transition="blocksReveal" data-duration="1500" style="background-image:url({{asset('assets/template/wedding/real_wedding/images/slider-02.jpg')}});">
							<div class="lbox-caption">
								<div class="lbox-details">
									<h1>{{empty($bride->nickname) ? 'The Bride' : $bride->nickname }} & {{empty($groom->nickname) ? 'The Groom' : $groom->nickname }}</h1>
									<h2>We're getting married</h2>
									<p><strong>{{count($event) > 0 ? Carbon\Carbon::parse($event[0]->startdate)->format('D, d M Y') : 'Create an event to display the date'}}</strong></p>
									@if ($event_count > 0)
										<a href="{{$save_date_link}}" target="_blank" class="btn">Save the date</a>
									@endif
								</div>
							</div>
						</div>
						<div class="pogoSlider-slide" data-transition="shrinkReveal" data-duration="2000" style="background-image:url({{asset('assets/template/wedding/real_wedding/images/slider-03.jpg')}});">
							<div class="lbox-caption">
								<div class="lbox-details">
									<h1>{{empty($bride->nickname) ? 'The Bride' : $bride->nickname }} & {{empty($groom->nickname) ? 'The Groom' : $groom->nickname }}</h1>
									<h2>We're getting married</h2>
									<p><strong>{{count($event) > 0 ? Carbon\Carbon::parse($event[0]->startdate)->format('D, d M Y') : 'Create an event to display the date'}}</strong></p>
									@if ($event_count > 0)
										<a href="{{$save_date_link}}" target="_blank" class="btn">Save the date</a>
									@endif
								</div>
							</div>
						</div>
					@endif
				</div><!-- .pogoSlider -->
			</div>
		</div>
	</div>
	<!-- End Banner -->

	<!-- Start About us -->
	<div id="about" class="about-box">
		<div class="about-a1">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="title-box">
							<h2>{{empty($bride->nickname) ? 'The Bride' : $bride->nickname}} <span>&</span> {{empty($groom->nickname) ? 'The Groom' : $groom->nickname}}</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="row align-items-center about-main-info">
							<div class="col-lg-8 col-md-6 col-sm-12">
								<h2> About <span>{{empty($bride->name) ? 'The Bride' : $bride->name}}</span></h2>
								@if (!empty($bride->mother) && !empty($bride->father))
									<h3>{{ $bride->gender == Constant::CODE_MALE ? 'Putra' : 'Putri' }} dari Bapak <strong>{{$bride->father}}</strong>, dan Ibu <strong>{{$bride->mother}}</strong>.</h3>
								@endif
								@if (!empty($bride->about))
									<q>{{ $bride->about }}</q>
								@endif
							</div>
							<div class="col-lg-4 col-md-6 col-sm-12">
								<div class="about-img">
									<img class="img-fluid rounded" src="{{empty($bride->photo) ? asset('assets/template/wedding/real_wedding/images/about-img-01.jpg') : asset('assets/img/wedding/photo/bride/'.$bride->photo)}}" alt="bride" />
								</div>
							</div>
						</div>
						<div class="row align-items-center about-main-info">
							<div class="col-lg-4 col-md-6 col-sm-12">
								<div class="about-img">
									<img class="img-fluid rounded" src="{{empty($groom->photo) ? asset('assets/template/wedding/real_wedding/images/about-img-02.jpg') : asset('assets/img/wedding/photo/bride/'.$groom->photo)}}" alt="groom" />
								</div>
							</div>
							<div class="col-lg-8 col-md-6 col-sm-12">
								<h2> About <span>{{empty($groom->name) ? 'The Groom' : $groom->name}}</span></h2>
								@if (!empty($groom->mother) && !empty($groom->father))
									<h3>{{ $groom->gender == Constant::CODE_MALE ? 'Putra' : 'Putri' }} dari Bapak <strong>{{$groom->father}}</strong>, dan Ibu <strong>{{$groom->mother}}</strong>.</h3>
								@endif
								@if (!empty($groom->about))
									<q>{{ $groom->about }}</q>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End About us -->

	<!-- Start Events -->
	<div id="events" class="events-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="title-box">
						<h2>Events</h2>
						<p>{{count($event) > 0 ? 'Our Special Wedding Events' : 'There are no events to display'}}</p>
					</div>
				</div>
			</div>
			<div class="row">
				@if (count($event) > 0)
					@foreach ($event as $event_no => $evn)
						<div class="col-lg-6 col-md-6 col-sm-12">
							<div class="event-inner">
								{{-- <div class="event-img">
									<img class="img-fluid" src="{{asset('assets/template/wedding/real_wedding/images/gallery-02.jpg')}}" alt="" />
								</div> --}}
								<h2 class="text-center">{{empty($evn->name) ? $evn->event_type->name : $evn->name}}</h2>
								@if (Carbon\Carbon::parse($evn->startdate)->format('d-M-Y') == Carbon\Carbon::parse($evn->enddate)->format('d-M-Y'))
									<p><i class="fas fa-calendar"></i> {{Carbon\Carbon::parse($evn->startdate)->format('D, d M Y')}}</p>
								@else
									<p><i class="fas fa-calendar"></i> {{Carbon\Carbon::parse($evn->startdate)->format('D, d M Y')}} - {{Carbon\Carbon::parse($evn->enddate)->format('D, d M Y')}}</p>
								@endif
								<p><i class="fas fa-clock"></i> {{Carbon\Carbon::parse($evn->startdate)->format('H:i T')}} - {{Carbon\Carbon::parse($evn->enddate)->format('H:i T')}}</p>
								<p><i class="fas fa-location-arrow"></i> {{$evn->place}}</p>
								@if ($gmaps_rule_value)
									<div>{!! $evn->map !!}</div>
								@endif
								<p>{{$evn->address}}</p>
								{{-- <a href="#">See location ></a> --}}
							</div>
						</div>
					@endforeach
				@endif
			</div>
		</div>
	</div>
	<!-- End Events -->

	<!-- Start Story -->
	<div id="story" class="story-box main-timeline-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="title-box">
						<h2>Our Story</h2>
						@if (count($story) > 0)
							<p>We Love Each Other</p>
						@else
							<p>Nothing to show</p>
						@endif
					</div>
				</div>
			</div>
			@if (count($story) > 0)
				@foreach($story as $story_no => $str)
					<div class="row timeline-element {{$story_no % 2 > 0 ? 'reverse' : null }} separline">
						<div class="timeline-date-panel col-xs-12 col-md-6 align-left">
							<div class="time-line-date-content">
								<p class="mbr-timeline-date mbr-fonts-style display-font">
									{{Carbon\Carbon::parse($str->date)->format('d M Y')}}
								</p>
							</div>
						</div>
						<span class="iconBackground"></span>
						<div class="col-xs-12 col-md-6 {{$story_no % 2 > 0 ? 'align-right' : 'align-left' }}">
							<div class="timeline-text-content">
								<h4 class="mbr-timeline-title pb-3 mbr-fonts-style display-font">{{$str->title}}</h4>
								<p class="mbr-timeline-text mbr-fonts-style display-7">
									{{$str->desc}}
								</p>
							</div>
						</div>
					</div>
				@endforeach
			@endif
		</div>
	</div>
	<!-- End Story -->

	<!-- Start Gallery -->
	<div id="gallery" class="gallery-box" style="display:none;">
		{{--<div class="container-fluid">--}}
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="title-box">
						<h2>Gallery</h2>
						<p>{{count($gallery) > 0 ? 'Our Memories' : 'No photos'}}</p>
					</div>
				</div>
			</div>
			<div class="row">
				{{--
				@if (count($gallery) > 0)
					<ul class="popup-gallery clearfix">
						@foreach ($gallery as $gallery_no => $glr)
							<li>
								<a href="{{asset('assets/img/wedding/photo/gallery/'.$glr->photo)}}">
									<img class="img-fluid" src="{{asset('assets/img/wedding/photo/gallery/'.$glr->photo)}}" alt="single image" title="{{$glr->name}}">
									<span class="overlay"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
								</a>
							</li>
						@endforeach
					</ul>
				@endif
				--}}
				<div class="col-md-12">
					@if (count($gallery) > 0)
						<div class="swiper swiper-gallery">
							<div class="swiper-wrapper">
								@foreach ($gallery as $gallery_no => $glr)
									<div class="swiper-slide">
										<img src="{{asset('assets/img/wedding/photo/gallery/'.$glr->photo)}}" title="{{$glr->name}}">
									</div>
								@endforeach
							</div>
							<div class="swiper-pagination"></div>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
	<!-- End Gallery -->

	<!-- Friends Wishes -->
	<div id="wishes" class="family-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="title-box">
						<h2>Friends Wishes</h2>
						<p>{{count($greeting) > 0 ? 'Best Wishes' : 'Friends Wishes will appear here'}}</p>
						@if($is_has_guest)
						<div class="submit-button text-center">
							<button id="btn-create-greeting" class="btn btn-common">Send Your Wishes</button>
						</div>
						@endif
					</div>
				</div>
			</div>
			@if (count($greeting) > 0)
				<div class="row">
					@foreach ($greeting as $greeting_no => $grt)
						<div class="col-lg-6 col-md-6 col-sm-12" style="margin:auto;">
							<div class="single-team-member">
								{{-- <div class="family-img">
									<img class="img-fluid" src="{{asset('assets\template\wedding\real_wedding\images\family-01.jpg')}}" alt="" />
								</div> --}}
								<div class="family-info">
									<h4>{{$grt->guest->name}}</h4>
									<p><i class="fas fa-calendar"></i> {{Carbon\Carbon::parse($grt->date)->format('d M Y H:i')}}</p>
									<q>{{$grt->greeting}}</q>
								</div>
							</div>
						</div>
					@endforeach
				</div>
				<div class="row mt-4">
					<div class="col-lg-12 col-md-12 col-sm-12 text-center">
						<span id="btn-load-greeting" class="text-danger" style="cursor:pointer;">Show all <i class="fas fa-external-link-alt"></i></span>
					</div>
				</div>
			@endif
		</div>
	</div>
	<!-- End Friends Wishes -->

	<!-- Start Contact -->
	@if ($is_has_guest)
	<div id="contact" class="contact-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="title-box">
						<h2>Are You Attending?</h2>
						<p>Silakan isi formulir di bawah untuk memberi tahu {{empty($groom->nickname) ? 'Pengantin Pria' : $groom->nickname}} dan {{empty($bride->nickname) ? 'Pengantin Wanita' : $bride->nickname}} bahwa Anda akan hadir. <i id="info-batal-atau-abaikan">{{$guest->status == Constant::TRUE_CONDITION ? "Klik 'Batalkan'" : 'Abaikan ini'}}</i> jika Anda tidak berkenan hadir. Terima kasih.</p>
						<div class="row">
							<div class="{{$guest->status == Constant::TRUE_CONDITION ? 'col-12 col-sm-4 col-md-4 col-lg-4' : 'col-12 col-sm-12 col-md-12 col-lg-12'}} div-info-status-hadir"><p>Status kehadiran: <span id="info-status-hadir" class="badge badge-primary">{{$guest->status == Constant::TRUE_CONDITION ? 'Hadir' : 'Tidak Hadir'}}</span></p></div>
							<div class="col-12 col-sm-4 col-md-4 col-lg-4 info-jumlah-tamu-dan-tombol-batalkan" @if ($guest->status == Constant::FALSE_CONDITION) style="display:none;" @endif><p>Tamu yang akan hadir: <span id="info-jumlah-hadir" class="badge badge-primary">{{$guest->presence}}</span></p></div>
							<div class="col-12 col-sm-4 col-md-4 col-lg-4 info-jumlah-tamu-dan-tombol-batalkan" @if ($guest->status == Constant::FALSE_CONDITION) style="display:none;" @endif><a style="cursor:pointer" class="btn-update-presence text-danger" data-type="CANCEL">Batalkan</a></div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-sm-12 col-xs-12">
				  <div class="contact-block">
					{{-- <form id="contactForm" action="{{route('invitation.guest.update_presence',[$template_category->name,$template_user->user_url])}}" method="POST">
					  @csrf
					  @method('put') --}}
					  <div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" id="guest_name" name="name" placeholder="Your Name" required data-error="Please enter your name" value="{{$guest_name}}" disabled>
								<div class="help-block with-errors"></div>
							</div>                                 
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="number" class="form-control" id="guest_presence" name="presence" placeholder="Berapa banyak yang akan hadir?" min="{{Constant::MIN_PRESENCE_OF_EACH_GUEST}}" max="{{Constant::MAX_PRESENCE_OF_EACH_GUEST}}">
								{{--<select class="custom-select d-block form-control" id="guest_presence" name="presence" required data-error="Please select an item in the list.">
								  <option disabled selected>Number Of Guest*</option>
								  @for ($i = Constant::MIN_PRESENCE_OF_EACH_GUEST; $i <= Constant::MAX_PRESENCE_OF_EACH_GUEST; $i++)
                            		<option value="{{$i}}">{{$i}}</option>
                          		  @endfor
								</select>--}}
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="submit-button text-center">
								<button class="btn btn-common btn-update-presence" id="btn-update-presence" type="submit" data-type="UPDATE">{{$guest->status == Constant::TRUE_CONDITION ? 'Update kehadiran' : 'Saya akan datang'}}</button>
								<div id="msgSubmit" class="h3 text-center hidden"></div>
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="col-md-12 text-center mt-5">
							<div>{!!$guest_qr_code!!}</div>
							<p>Show me to reception to confirm your presence</p>
						</div>
					  </div>            
					{{-- </form> --}}
				  </div>
				</div>
			</div>
		</div>
	</div>
	@endif
	<!-- End Contact -->
	
	<!-- Start Footer -->
	<footer class="footer-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<p class="footer-company-name">
						All Rights Reserved. &copy; {{Carbon\Carbon::now()->format('Y')}} <a href="/" target="_blank">{{config('app.name')}}</a>
						{{-- Design By : <a href="https://html.design/" target="_blank">html design</a> --}}
					</p>
				</div>
			</div>
		</div>
	</footer>
	<!-- End Footer -->

	<!-- Music Player -->
	<div class="music-console" style="cursor:pointer;">
		<span id="music-rotate" class="rotate" style="animation-play-state:paused;"><img src="{{asset('assets/template/wedding/sweety/images/icon-music.png')}}" width="100%"></span>
		<div id="player" style="display:none;"></div>
	</div>
	<!-- End Music Player -->

	<!-- Cover -->
	<div class="invitation-cover" style="background-image:url({{empty($wedding->photo_sampul) ? asset('assets/template/wedding/sweety/images/img_bg_5.jpg') : asset('assets/img/wedding/photo/sampul/'.$wedding->photo_sampul)}});">
		<div class="invitation-cover-content" style="background-image:url({{asset('assets/template/wedding/sweety/images/img_bg_5.jpg')}});">
			<div class="row">
				<div class="invitation-cover-heading">
					<h2>The Wedding of</h2>
					<h1>{{empty($groom->nickname) ? 'Pria' : $groom->nickname}} &amp; {{empty($bride->nickname) ? 'Wanitanya' : $bride->nickname}}</h1>
					<br>
					<h2>{{count($event) > 0 ? Carbon\Carbon::parse($event[0]->startdate)->format('D, d M Y') : 'Tanggal dan Tempat acara akan tampil di sini.' }}</h2>
					<br>
					@if($is_has_guest)<p><strong>{{$guest_name}}</strong></p>@endif
					<p>{{$is_has_guest ? "We invited you to celebrate our wedding" : "Let's celebrate our wedding"}}</p>
					<br><br>
					<div class="submit-button">
						<input type="button" id="btn-open" class="btn btn-common" value="Open Invitation">
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Cover -->

	@if($is_has_guest)
	@include('invitation.wedding.create_greeting_modal')
	@endif

	@include('invitation.wedding.load_greeting_modal')

	<!-- ALL JS FILES -->
	<script src="{{asset('assets/template/wedding/real_wedding/js/jquery.min.js')}}"></script>
	<script src="{{asset('assets/template/wedding/real_wedding/js/popper.min.js')}}"></script>
	<script src="{{asset('assets/template/wedding/real_wedding/js/bootstrap.min.js')}}"></script>
    <!-- ALL PLUGINS -->
	<script src="{{asset('assets/template/wedding/real_wedding/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('assets/template/wedding/real_wedding/js/jquery.pogo-slider.min.js')}}"></script> 
	<script src="{{asset('assets/template/wedding/real_wedding/js/slider-index.js')}}"></script>
	<script src="{{asset('assets/template/wedding/real_wedding/js/smoothscroll.js')}}"></script>
	<script src="{{asset('assets/template/wedding/real_wedding/js/form-validator.min.js')}}"></script>
    <script src="{{asset('assets/template/wedding/real_wedding/js/contact-form-script.js')}}"></script>
    <script src="{{asset('assets/template/wedding/real_wedding/js/custom.js')}}"></script>
	<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

	@include('invitation.wedding.script')

	<script>
		$('#btn-open').click(function() {
			player.load("{{asset('assets/file/musik/'.$music->path)}}");
			$('.top-header').css('display','block');
			$('.ulockd-home-slider').css('display','block');
			// $('.invitation-cover').css('display','none');
			$('.invitation-cover').fadeOut();
			$('#preview-alert').fadeIn();
			$('#gallery').fadeIn();

			const swiper = new Swiper('.swiper-gallery', {
				// Optional parameters
				effect: 'coverflow',
				grabCursor: true,
				slidesPerView: 'auto',
				coverflowEffect: {
					rotate: 50,
					stretch: 0,
					depth: 100,
					modifier: 1,
					slideShadows: true,
				},
				autoplay: {
					delay: 3000,
					disableOnInteraction: false,
				},
				autoHeight: true,
				centeredSlides: true,
				centeredSlidesBounds: true,
				// speed: 5000,
				// spaceBetween: 100,
				// direction: 'vertical',
				loop: true,
				// If we need pagination
				pagination: {
					el: '.swiper-pagination',
					clickable: true,
				},
			});
		});

		function generate_greeting_item_html(name, date, text) {
			var customDate = dateTimeCustomFormat('d MMM yyyy hh:mm', date);
			return '<div class="single-team-member">'
			+ '<div class="family-info">'
			+ '<h4>' + name + '</h4>'
			+ '<span style="font-size:12px;"><i class="fas fa-calendar"></i> ' + customDate + '</span><br>'
			+ '<q>' + text + '</q>'
			+ '</div>'
			+ '</div>';
		}

		//Wajib Ada tiap template! Karena dipanggil di parent script.blade.php (kalo pake script.blade.php)
		//Jika gak dipake, kosongin saja isi function-nya!
		function setDivInfoStatusHadir() {
			if (parseInt($('#info-jumlah-hadir').text().trim()) > 0) {
				$('.div-info-status-hadir').removeClass('col-12 col-sm-12 col-md-12 col-lg-12');
				$('.div-info-status-hadir').addClass('col-12 col-sm-4 col-md-4 col-lg-4');
			} else {
				$('.div-info-status-hadir').removeClass('col-12 col-sm-4 col-md-4 col-lg-4');
				$('.div-info-status-hadir').addClass('col-12 col-sm-12 col-md-12 col-lg-12');
			}
		}

		//jQuery example
		// $('#simply-countdown-losange').simplyCountdown({
		//     year: d.getFullYear(),
		//     month: d.getMonth() + 1,
		//     day: d.getDate(),
		//     enableUtc: false
		// });

		// function getRotationDegrees(obj) {
		// 	var matrix = obj.css("-webkit-transform") ||
		// 	obj.css("-moz-transform")    ||
		// 	obj.css("-ms-transform")     ||
		// 	obj.css("-o-transform")      ||
		// 	obj.css("transform");
		// 	if(matrix !== 'none') {
		// 		var values = matrix.split('(')[1].split(')')[0].split(',');
		// 		var a = values[0];
		// 		var b = values[1];
		// 		var angle = Math.round(Math.atan2(b, a) * (180/Math.PI));
		// 	} else { var angle = 0; }
		// 	return (angle < 0) ? angle + 360 : angle;
		// }
	</script>
</body>
</html>