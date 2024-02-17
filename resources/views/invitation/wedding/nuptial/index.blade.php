<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	@include('invitation.wedding.link')
  <!-- 
	//////////////////////////////////////////////////////

	FREE HTML5 TEMPLATE 
	DESIGNED & DEVELOPED by FREEHTML5.CO
		
	Website: 		http://freehtml5.co/
	Email: 			info@freehtml5.co
	Twitter: 		http://twitter.com/fh5co
	Facebook: 		https://www.facebook.com/fh5co

	//////////////////////////////////////////////////////
	 -->

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href="https://fonts.googleapis.com/css?family=Montez" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>

	<!-- Animate.css -->
	<link rel="stylesheet" href="{{asset('assets/template/wedding/nuptial/css/animate.css')}}">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="{{asset('assets/template/wedding/nuptial/css/icomoon.css')}}">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="{{asset('assets/template/wedding/nuptial/css/bootstrap.css')}}">
	<!-- Superfish -->
	<link rel="stylesheet" href="{{asset('assets/template/wedding/nuptial/css/superfish.css')}}">
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="{{asset('assets/template/wedding/nuptial/css/magnific-popup.css')}}">

	<link rel="stylesheet" href="{{asset('assets/template/wedding/nuptial/css/style.css')}}">

	<!-- Modernizr JS -->
	<script src="{{asset('assets/template/wedding/nuptial/js/modernizr-2.6.2.min.js')}}"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="{{asset('assets/template/wedding/nuptial/js/respond.min.js')}}"></script>
	<![endif]-->

	</head>
	<body>
		<div id="fh5co-wrapper">
		<div id="fh5co-page" style="display:none;">

		<div class="fh5co-hero" data-section="home">
			<div class="fh5co-overlay"></div>
			<div class="fh5co-cover text-center" data-stellar-background-ratio="0.5" style="background-image:url({{empty($wedding->photo_sampul) ? asset('assets/template/wedding/nuptial/images/cover_bg_1.jpg') : asset('assets/img/wedding/photo/sampul/'.$wedding->photo_sampul)}});">
				<div class="display-t">
					<div class="display-tc">
						<div class="container">
							<div class="col-md-10 col-md-offset-1">
								<div class="animate-box">
									<h1>The Wedding</h1>
									<h2>{{empty($groom->nickname) ? 'Pria' : $groom->nickname}} &amp; {{empty($bride->nickname) ? 'Wanitanya' : $bride->nickname}}</h2>
									@if (count($event) > 0)
										<p><span>{{Carbon\Carbon::parse($event[0]->startdate)->locale(Constant::DEFAULT_COUNTRY_CODE)->isoFormat('DD.MM.YYYY')}}</span></p>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<header id="fh5co-header-section" class="sticky-banner">
			@if ($is_preview)
				@include('invitation.wedding.preview_alert')
			@endif
			<div class="container">
				<div class="nav-header">
					<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle dark"><i></i></a>
					<h1 id="fh5co-logo"><a href="#">Nuptial</a></h1>
					<!-- START #fh5co-menu-wrap -->
					<nav id="fh5co-menu-wrap" role="navigation">
						<ul class="sf-menu" id="fh5co-primary-menu">
							<li class="active"><a href="#fh5co-couple" onclick="$('body').removeClass('fh5co-offcanvas');">Home</a></li>
							<li><a href="#fh5co-groom-bride" onclick="$('body').removeClass('fh5co-offcanvas');">Groom &amp; Bride</a></li>
							<li><a href="#fh5co-when-where" onclick="$('body').removeClass('fh5co-offcanvas');">When &amp; Where</a></li>
							<li><a href="#fh5co-couple-story" onclick="$('body').removeClass('fh5co-offcanvas');">Story</a></li>
							<li><a href="#fh5co-gallery" onclick="$('body').removeClass('fh5co-offcanvas');">Gallery</a></li>
							<li><a href="#fh5co-blog-section" onclick="$('body').removeClass('fh5co-offcanvas');">Wishes</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</header>

		<!-- end:header-top -->

		<div id="fh5co-couple" class="fh5co-section-gray">
			<div class="container">
				<div class="row row-bottom-padded-md animate-box">
					<div class="col-md-6 col-md-offset-3 text-center">
						<div class="col-md-5 col-sm-5 col-xs-5 nopadding">
							<img src="{{empty($groom->photo) ? asset('assets/template/wedding/nuptial/images/groom.jpg') : asset('assets/img/wedding/photo/bride/'.$groom->photo)}}" class="img-responsive" alt="groom">
							<h3>{{empty($groom->name) ? 'Pengantin Pria' : $groom->name }}</h3>
						</div>
						<div class="col-md-2 col-sm-2 col-xs-2 nopadding"><h2 class="amp-center"><i class="icon-heart"></i></h2></div>
						<div class="col-md-5 col-sm-5 col-xs-5 nopadding">
							<img src="{{empty($bride->photo) ? asset('assets/template/wedding/nuptial/images/bride.jpg') : asset('assets/img/wedding/photo/bride/'.$bride->photo)}}" class="img-responsive" alt="bride">
							<h3>{{empty($bride->name) ? 'Pengantin Wanita' : $bride->name }}</h3>
						</div>
					</div>
				</div>
				<div class="row animate-box">
					<div class="col-md-8 col-md-offset-2">
						<div class="col-md-12 text-center heading-section">
							<h2>Are Getting Married</h2>
							<p><strong>{{count($event) > 0 ? 'on ' . Carbon\Carbon::parse($event[0]->startdate)->locale('EN')->isoFormat('D MMM YYYY') . ' - ' . $event[0]->place : 'The date and venue of the event will appear here.' }}</strong></p>
							@if ($event_count > 0)
								<p><a href="{{$save_date_link}}" target="_blank" class="btn btn-primary btn-sm">Save the date</a></p>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="fh5co-countdown">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center animate-box">
					<p id="countdown" class="countdown">
						<span id="days"></span>
						<span id="hours"></span>
						<span id="minutes"></span>
						<span id="seconds"></span>
					</p>
				</div>
			</div>
		</div>

		<div id="fh5co-groom-bride">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
						<h2>Groom &amp; Bride</h2>
					</div>
				</div>
				<div class="row padding">
					<div class="couple-wrap">
						<div class="col-md-6 nopadding animate-box">
							<img src="{{empty($groom->photo) ? asset('assets/template/wedding/nuptial/images/groom.jpg') : asset('assets/img/wedding/photo/bride/'.$groom->photo)}}" class="img-responsive" alt="groom">
						</div>
						<div class="col-md-6 nopadding animate-box">
							<div class="couple-desc">
								<h3>{{empty($groom->name) ? 'Pengantin Pria' : $groom->name }}</h3>
								@if (!empty($groom->mother) && !empty($groom->father))
									<p>{{ $groom->gender == Constant::CODE_MALE ? 'Putra' : 'Putri' }} dari Bapak <strong>{{$groom->father}}</strong>, dan Ibu <strong>{{$groom->mother}}</strong>.</p>
								@endif
								@if (!empty($groom->about))
									<q>{{$groom->about}}</q>
								@endif
								{{--
								<p class="fh5co-social-icons">
									<a href="#"><i class="icon-twitter2"></i></a>
									<a href="#"><i class="icon-facebook2"></i></a>
									<a href="#"><i class="icon-instagram"></i></a>
									<a href="#"><i class="icon-dribbble2"></i></a>
									<a href="#"><i class="icon-youtube"></i></a>
								</p>
								--}}
							</div>
						</div>
					</div>
				</div>
				<div class="row padding">
					<div class="couple-wrap">
						<div class="col-md-6 col-md-push-6 nopadding animate-box">
							<img src="{{empty($bride->photo) ? asset('assets/template/wedding/nuptial/images/bride.jpg') : asset('assets/img/wedding/photo/bride/'.$bride->photo)}}" class="img-responsive" alt="bride">
						</div>
						<div class="col-md-6 col-md-pull-6 nopadding animate-box">
							<div class="couple-desc">
								<h3>{{empty($bride->name) ? 'Pengantin Wanita' : $bride->name }}</h3>
								@if (!empty($bride->mother) && !empty($bride->father))
									<p>{{ $bride->gender == Constant::CODE_MALE ? 'Putra' : 'Putri' }} dari Bapak <strong>{{$bride->father}}</strong>, dan Ibu <strong>{{$bride->mother}}</strong>.</p>
								@endif
								@if (!empty($bride->about))
									<q>{{$bride->about}}</q>
								@endif
								{{--
								<p class="fh5co-social-icons">
									<a href="#"><i class="icon-twitter2"></i></a>
									<a href="#"><i class="icon-facebook2"></i></a>
									<a href="#"><i class="icon-instagram"></i></a>
									<a href="#"><i class="icon-dribbble2"></i></a>
									<a href="#"><i class="icon-youtube"></i></a>
								</p>
								--}}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="fh5co-when-where" class="fh5co-section-gray">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
						<h2>When &amp; Where</h2>
					</div>
				</div>
				<div class="row row-bottom-padded-md">
					@if (count($event) > 0)
						@foreach ($event as $event_no => $evn)
							<div class="col-md-6 text-center animate-box" style="margin-bottom:40px;">
								<div class="wedding-events">
									<div class="desc">
										<h3>{{empty($evn->name) ? $evn->event_type->name : $evn->name}}</h3>
										<div class="row">
											<div class="col-md-6">
												<i class="icon-clock"></i>
												<span><strong>{{Carbon\Carbon::parse($evn->startdate)->format('H:i T')}} &mdash; {{Carbon\Carbon::parse($evn->enddate)->format('H:i T')}}</strong></span>
											</div>
											<div class="col-md-6">
												<i class="icon-calendar"></i>
												@if (Carbon\Carbon::parse($evn->startdate)->format('d-M-Y') == Carbon\Carbon::parse($evn->enddate)->format('d-M-Y'))
													<span><strong>{{Carbon\Carbon::parse($evn->startdate)->format('D, d M Y')}}</strong></span>
												@else
													<span><strong>{{Carbon\Carbon::parse($evn->startdate)->format('D, d M Y')}} &mdash; {{Carbon\Carbon::parse($evn->enddate)->format('D, d M Y')}}</strong></span>
												@endif
											</div>
										</div>
										<div class="row" style="margin-top:20px;">
											<div class="col-md-12">
												<p><i class="icon-location-pin"></i> <strong>{{$evn->place}}</strong></p>
												<p>{{$evn->address}}</p>
											</div>
										</div>
									</div>
									@if ($gmaps_rule_value)
										<div class="ceremony-bg">{!! $evn->map !!}</div>
									@endif
								</div>
							</div>
						@endforeach
					@else
						<div class="col-md-12 text-center animate-box">
							<h3>There are no events.</h3>
						</div>
					@endif
				</div>
				{{--
					<div class="row">
						<div class="col-md-12">
							<div id="map" class="fh5co-map"></div>
						</div>
					</div>
				--}}
			</div>
		</div>

		<div id="fh5co-couple-story">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
						<span>We Love Each Other</span>
						<h2>Our Story</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-md-offset-0">
						@if (count($story) > 0)
							<ul class="timeline animate-box">
								@foreach($story as $story_no => $str)
								<li class="animate-box {{$story_no % 2 > 0 ? 'timeline-inverted' : null }}">
									<div class="timeline-badge" style="background-image:url({{empty($str->photo) ? asset('assets/template/wedding/nuptial/images/couple-1.jpg') : asset('assets/img/wedding/photo/story/'.$str->photo)}});"></div>
									<div class="timeline-panel">
										<div class="timeline-heading">
											<h3 class="timeline-title" style="overflow:hidden;">{{$str->title}}</h3>
											<span class="date">{{Carbon\Carbon::parse($str->date)->format('d M Y')}}</span>
										</div>
										<div class="timeline-body">
											<p>{{$str->desc}}</p>
										</div>
									</div>
								</li>
								@endforeach
							</ul>
						@else
							<div class="text-center animate-box">
								<p>No stories.</p>
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>

		{{--
		<div id="fh5co-guest">
			<div class="container">
				<div class="row animate-box">
					<div class="col-md-8 col-md-offset-2 text-center heading-section">
						<h2>The Groomsmen</h2>
					</div>
				</div>
				<div class="row row-bottom-padded-lg">
					<div class="col-md-3 text-center animate-box">
						<div class="groom-men">
							<img src="{{asset('assets/template/wedding/nuptial/images/groom-men-1.jpg')}}" class="img-responsive" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
							<h3>Arthur Stone</h3>
						</div>
					</div>
					<div class="col-md-3 text-center animate-box">
						<div class="groom-men">
							<img src="{{asset('assets/template/wedding/nuptial/images/groom-men-2.jpg')}}" class="img-responsive" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
							<h3>Mike Paterson</h3>
						</div>
					</div>
					<div class="col-md-3 text-center animate-box">
						<div class="groom-men">
							<img src="{{asset('assets/template/wedding/nuptial/images/groom-men-3.jpg')}}" class="img-responsive" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
							<h3>Brench Thompson</h3>
						</div>
					</div>
					<div class="col-md-3 text-center animate-box">
						<div class="groom-men">
							<img src="{{asset('assets/template/wedding/nuptial/images/groom-men-4.jpg')}}" class="img-responsive" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
							<h3>Blake Haste</h3>
						</div>
					</div>
				</div>
				<div class="row animate-box">
					<div class="col-md-8 col-md-offset-2 text-center heading-section">
						<h2>The Bridesmaids</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 text-center animate-box">
						<div class="groom-men">
							<img src="{{asset('assets/template/wedding/nuptial/images/bridesmaid-1.jpg')}}" class="img-responsive" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
							<h3>Arthur Stone</h3>
						</div>
					</div>
					<div class="col-md-3 text-center animate-box">
						<div class="groom-men">
							<img src="{{asset('assets/template/wedding/nuptial/images/bridesmaid-2.jpg')}}" class="img-responsive" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
							<h3>Mike Paterson</h3>
						</div>
					</div>
					<div class="col-md-3 text-center animate-box">
						<div class="groom-men">
							<img src="{{asset('assets/template/wedding/nuptial/images/bridesmaid-3.jpg')}}" class="img-responsive" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
							<h3>Brench Thompson</h3>
						</div>
					</div>
					<div class="col-md-3 text-center animate-box">
						<div class="groom-men">
							<img src="{{asset('assets/template/wedding/nuptial/images/bridesmaid-4.jpg')}}" class="img-responsive" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
							<h3>Blake Haste</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
		--}}

		<div id="fh5co-gallery">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
						<h2>Wedding Gallery</h2>
					</div>
				</div>
				<div class="row">
					@if (count($gallery) > 0)
						@foreach ($gallery as $gallery_no => $glr)
							<div class="col-md-6">
								<div class="gallery animate-box">
									<a class="gallery-img image-popup" href="{{asset('assets/img/wedding/photo/gallery/'.$glr->photo)}}"><img src="{{asset('assets/img/wedding/photo/gallery/'.$glr->photo)}}" class="img-responsive" alt="{{$glr->name}}"></a>
								</div>
							</div>
						@endforeach
					@else
						<div class="col-md-12">
							<div class="text-center animate-box">
								<p>No photos found.</p>
							</div>
						</div>
					@endif
				</div>
			</div>
		</div>

		<div id="fh5co-blog-section" class="fh5co-section-gray">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center heading-section">
						<h2>Friends Wishes</h2>
						@if($is_has_guest)
						<button id="btn-create-greeting" class="btn btn-primary">Make a wish</button>
						@endif
					</div>
				</div>
			</div>
			<div class="container">
				@if (count($greeting) > 0)
					<div class="row row-bottom-padded-md">
						@foreach ($greeting as $greeting_no => $grt)
							<div
								@if (count($greeting) == 1)
									class="col-lg-offset-4 col-md-offset-4 col-sm-offset-3 col-lg-4 col-md-4 col-sm-6"
								@elseif (count($greeting) == 2)
									class="col-lg-6 col-md-6 col-sm-6"
								@elseif (count($greeting) == 3)
									class="col-lg-4 col-md-4 col-sm-6"
								@else
									class="col-lg-3 col-md-3 col-sm-6"
								@endif
								>
								<div class="fh5co-blog animate-box">
									{{--<a href="#"><img class="img-responsive" src="{{asset('assets/template/wedding/nuptial/images/cover_bg_1.jpg')}}" alt=""></a>--}}
									<div class="blog-text">
										<div class="prod-title">
											{{--<h3><a href="#">{{$grt->guest->name}}</a></h3>--}}
											<span class="by">{{$grt->guest->name}}</span>
											<span class="posted_date" style="font-size:12px;">{{Carbon\Carbon::parse($grt->date)->format('d M Y H:i')}}</span>
											{{--<span class="comment"><a href="">21<i class="icon-bubble2"></i></a></span>--}}
											<p>
												<q>{{$grt->greeting}}</q>
											</p>
											{{--<p><a href="#">Learn More...</a></p>--}}
										</div>
									</div> 
								</div>
							</div>
						@endforeach
					</div>
					{{-- DI BAWAH INI HARUSNYA KONDISI count($greeting) > Constant::MAX_GREETING_DISPLAYED --}}
					{{-- KARENA SUDAH DILIMIT 8 DI BELAKANG, SETIDAKNYA KALO SUDAH MENCAPAI BATAS MAKS, MUNCUL BUTTON LOAD MORE --}}
					@if (count($greeting) >= Constant::MAX_GREETING_DISPLAYED)
						<div class="row">
							<div class="col-md-4 col-md-offset-4 text-center animate-box">
								<span id="btn-load-greeting" class="btn btn-outline-primary btn-lg">More Wishes</span>
							</div>
						</div>
					@endif
				@else
					<div class="row row-bottom-padded-md">
						<div class="col-md-4 col-md-offset-4 text-center animate-box">
							<p>Friends Wishes will appear here.</p>
						</div>
					</div>
				@endif
			</div>
		</div>

		@if ($is_has_guest)
		<div id="fh5co-started" style="background-image:url({{asset('assets/template/wedding/nuptial/images/cover_bg_2.jpg')}});" {{--data-stellar-background-ratio="0.5"--}}>
			<div class="overlay"></div>
			<div class="container">
				<div class="row animate-box">
					<div class="col-md-8 col-md-offset-2 text-center heading-section">
						<h2>Are You Attending?</h2>
						{{--<p>Please Fill-up the form to notify you that you're attending. Thanks.</p>--}}
						<p>Silakan isi formulir di bawah untuk memberi tahu {{empty($groom->nickname) ? 'Pengantin Pria' : $groom->nickname}} dan {{empty($bride->nickname) ? 'Pengantin Wanita' : $bride->nickname}} bahwa Anda akan hadir. <i id="info-batal-atau-abaikan">{{$guest->status == Constant::TRUE_CONDITION ? "Klik 'Batalkan'" : 'Abaikan ini'}}</i> jika Anda tidak berkenan hadir. Terima kasih.</p>
						<div class="row">
							<div class="{{$guest->status == Constant::TRUE_CONDITION ? 'col-12 col-sm-4 col-md-4 col-lg-4' : 'col-12 col-sm-12 col-md-12 col-lg-12'}} div-info-status-hadir"><p>Status kehadiran: <span id="info-status-hadir" class="badge badge-primary">{{$guest->status == Constant::TRUE_CONDITION ? 'Hadir' : 'Tidak Hadir'}}</span></p></div>
							<div class="col-12 col-sm-4 col-md-4 col-lg-4 info-jumlah-tamu-dan-tombol-batalkan" @if ($guest->status == Constant::FALSE_CONDITION) style="display:none;" @endif><p>Tamu yang akan hadir: <span id="info-jumlah-hadir" class="badge badge-primary">{{$guest->presence}}</span></p></div>
							<div class="col-12 col-sm-4 col-md-4 col-lg-4 info-jumlah-tamu-dan-tombol-batalkan" @if ($guest->status == Constant::FALSE_CONDITION) style="display:none;" @endif><a style="cursor:pointer" class="btn-update-presence" data-type="CANCEL">Batalkan</a></div>
						</div>
					</div>
				</div>
				<div class="row animate-box">
					<div class="col-md-10 col-md-offset-1">
						<form class="form-inline">
						{{--<form class="form-inline" action="{{route('invitation.guest.update_presence',[$template_category->name,$template_user->user_url])}}" method="POST">
							@csrf
							@method('put')--}}
							<div class="col-md-4 col-sm-4">
								<div class="form-group">
									<label for="name" class="sr-only">Name</label>
									<input type="text" class="form-control" id="guest_name" name="name" placeholder="Name" value="{{$guest_name}}" disabled>
								</div>
							</div>
							<div class="col-md-4 col-sm-4">
								<div class="form-group">
									<label for="presence" class="sr-only">Berapa banyak yang akan hadir?</label>
									<input type="number" class="form-control" id="guest_presence" name="presence" placeholder="Berapa banyak yang akan hadir?" min="{{Constant::MIN_PRESENCE_OF_EACH_GUEST}}" max="{{Constant::MAX_PRESENCE_OF_EACH_GUEST}}">
								</div>
							</div>
							<div class="col-md-4 col-sm-4">
								<button type="button" class="btn btn-primary btn-block btn-update-presence" data-type="UPDATE" style="overflow:hidden; text-overflow:ellipsis;">{{$guest->status == Constant::TRUE_CONDITION ? 'Update kehadiran' : 'Saya akan datang'}}</button>
							</div>
						{{--</form>--}}
						</form>
					</div>
				</div>
				{{-- add space --}}
				<div class="row animate-box"><div class="col-md-10 col-md-offset-1 text-center heading-section"></div></div>
				{{-- end add space --}}
				<div class="row animate-box">
					<div class="col-md-10 col-md-offset-1 text-center heading-section">
						<div>{!!$guest_qr_code!!}</div>
						<p>Show me to reception to confirm your presence</p>
					</div>
				</div>
			</div>
		</div>
		@endif

		<footer>
			<div id="footer">
				<div class="container">
					<div class="row">
						<div class="col-md-12 text-center">
							<h2>{{empty($groom->nickname) ? 'Pria' : $groom->nickname}} &amp; {{empty($bride->nickname) ? 'Wanitanya' : $bride->nickname}}</h2>
						</div>
						<div class="col-md-6 col-md-offset-3 text-center">
							{{--
								<p class="fh5co-social-icons">
									<a href="#"><i class="icon-twitter2"></i></a>
									<a href="#"><i class="icon-facebook2"></i></a>
									<a href="#"><i class="icon-instagram"></i></a>
									<a href="#"><i class="icon-dribbble2"></i></a>
									<a href="#"><i class="icon-youtube"></i></a>
								</p>
							--}}
							<p>
								&copy; {{Carbon\Carbon::now()->format('Y')}}
								<a href="/" target="_blank">{{config('app.name')}}</a>. All Rights Reserved. <br>
								{{--
									Made with <i class="icon-heart3"></i> by <a href="http://freehtml5.co/" target="_blank">Freehtml5.co</a> / Demo Images: <a href="https://unsplash.com/" target="_blank">Unsplash</a>
								--}}
							</p>
						</div>
					</div>
				</div>
			</div>
		</footer>

		</div>
		<!-- END fh5co-page -->

		</div>
		<!-- END fh5co-wrapper -->

		{{-- NAVBAR SUDAH STICKY
		<div class="gototop js-top" style="display:none;">
			<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
		</div>
		--}}

		<div class="music-console" style="cursor:pointer;">
			<span id="music-rotate" class="rotate" style="animation-play-state:paused;"><img src="{{asset('assets/template/wedding/nuptial/images/icon-music.png')}}" width="100%"></span>
			<div id="player" style="display:none;"></div>
		</div>

		<div class="invitation-cover" style="background-image:url({{empty($wedding->photo_sampul) ? asset('assets/template/wedding/nuptial/images/cover_bg_1.jpg') : asset('assets/img/wedding/photo/sampul/'.$wedding->photo_sampul)}});">
			<div class="invitation-cover-content" style="background-image:url({{asset('assets/template/wedding/nuptial/images/cover_bg_1.jpg')}});">
				<div class="row animate-box">
					<div class="invitation-cover-heading">
						<h3>The Wedding of</h3>
						<h2>{{empty($groom->nickname) ? 'Pria' : $groom->nickname}} &amp; {{empty($bride->nickname) ? 'Wanitanya' : $bride->nickname}}</h2>
						<br>
						<h3>{{count($event) > 0 ? Carbon\Carbon::parse($event[0]->startdate)->format('D, d M Y') : 'The date and venue will appear here.' }}</h3>
						<br>
						@if($is_has_guest)<h3><strong>{{$guest_name}}</strong></h3>@endif
						<p>{{$is_has_guest ? "We invited you to celebrate our wedding" : "Let's celebrate our wedding"}}</p>
						<br><br>
						<input type="button" id="btn-open" class="btn btn-primary" value="Open Invitation">
					</div>
				</div>
			</div>
		</div>

		@if($is_has_guest)
		@include('invitation.wedding.create_greeting_modal')
		@endif

		@include('invitation.wedding.load_greeting_modal')

		<!-- Google Map -->
		{{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCefOgb1ZWqYtj7raVSmN4PL2WkTrc-KyA&sensor=false"></script>--}}
		<!-- jQuery -->
		{{--<script src="{{asset('assets/template/wedding/nuptial/dist/scripts.min.js')}}"></script>--}}
		<script src="{{asset('assets/template/wedding/nuptial/dist/scripts.js')}}"></script>

		@include('invitation.wedding.script')

		<script>
			'use strict';

			$(document).on('ready', function() {
				//
			});

			// Set the date we're counting down to
			var countDownDate = new Date("{{count($event) > 0 ? Carbon\Carbon::parse($event[0]->startdate)->toIso8601String() : Carbon\Carbon::now()->add(66, 'day')->add(16, 'hour')->toIso8601String()}}").getTime();

			// Update the count down every 1 second
			var countDownX = setInterval(function() {
				// Get todays date and time
				var now = new Date().getTime();

				// Find the distance between now an the count down date
				var distance = countDownDate - now;

				// Time calculations for days, hours, minutes and seconds
				var days = Math.floor(distance / (1000 * 60 * 60 * 24));
				var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
				var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
				var seconds = Math.floor((distance % (1000 * 60)) / 1000);

				// Display the result in an element with id="demo"
				// document.getElementById("demo").innerHTML = days + "Days " + hours + "Hours "
				// + minutes + "Minutes " + seconds + "Seconds ";

				// Display the result in an element with id="demo"
				document.getElementById("days").innerHTML = days +" <small>days</small>";
				document.getElementById("hours").innerHTML = hours + " <small>hours</small> ";
				document.getElementById("minutes").innerHTML = minutes + " <small>minutes</small> ";
				document.getElementById("seconds").innerHTML = seconds + " <small>seconds</small> ";

				// If the count down is finished, write some text 
				if (distance < 0) {
					clearInterval(countDownX);
					$('.countdown').empty();
					document.getElementById("countdown").innerHTML = '<h1 style="color:white;">The Wedding has started</h1>';
				}
			}, 1000);

			$('#btn-open').click(function() {
				player.load("{{asset('assets/file/musik/'.$music->path)}}");
				$('#fh5co-page').css('display','block');
				$('.invitation-cover').fadeOut();
				$('#preview-alert').fadeIn();
			});

			function generate_greeting_item_html(name, date, text) {
				var customDate = dateTimeCustomFormat('d MMM yyyy hh:mm', date);
				return '<div style="padding:14px;border-radius:14px;margin-bottom:16px;background-color:#f8f9fa;">'
				+ '<span style="font-size:12px;float:right;"><i class="fas fa-calendar" style="font-size:12px;"></i> ' + customDate + '</span>'
				+ '<strong style="font-size:20px;">' + name + '</strong><br>'
				+ '<q>' + text + '</q>'
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
		</script>
	</body>
</html>