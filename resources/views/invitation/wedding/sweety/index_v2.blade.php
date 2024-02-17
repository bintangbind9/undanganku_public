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

    Version:        v2
	//////////////////////////////////////////////////////
	 -->

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content="{{$template_category->name}} - {{empty($groom->nickname) ? 'Pria' : $groom->nickname}} & {{empty($bride->nickname) ? 'Wanitanya' : $bride->nickname}}"/>
	<meta property="og:image" content="{{empty($wedding->photo_sampul) ? asset('assets/template/wedding/sweety/images/img_bg_1.jpg') : asset('assets/img/wedding/photo/sampul/'.$wedding->photo_sampul)}}"/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content="{{config('app.name')}}"/>
	<meta property="og:description" content="{{$template_category->name}} {{$groom->name}} & {{$bride->name}} - Undangan Ajib {{$template->name}} Template by {{config('app.name')}}"/>
	<meta name="twitter:title" content="{{$template_category->name}} - {{empty($groom->nickname) ? 'Pria' : $groom->nickname}} & {{empty($bride->nickname) ? 'Wanitanya' : $bride->nickname}}" />
	<meta name="twitter:image" content="{{empty($wedding->photo_sampul) ? asset('assets/template/wedding/sweety/images/img_bg_1.jpg') : asset('assets/img/wedding/photo/sampul/'.$wedding->photo_sampul)}}" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href='https://fonts.googleapis.com/css?family=Work+Sans:400,300,600,400italic,700' rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/css?family=Sacramento" rel="stylesheet">

	<!-- Animate.css -->
	<link rel="stylesheet" href="{{asset('assets/template/wedding/sweety/css/animate.css')}}">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="{{asset('assets/template/wedding/sweety/css/icomoon.css')}}">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="{{asset('assets/template/wedding/sweety/css/bootstrap_v2.css')}}">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="{{asset('assets/template/wedding/sweety/css/magnific-popup.css')}}">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="{{asset('assets/template/wedding/sweety/css/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/template/wedding/sweety/css/owl.theme.default.min.css')}}">

	<!-- Theme style  -->
	<link rel="stylesheet" href="{{asset('assets/template/wedding/sweety/css/style_v2.css')}}">

	<!-- Modernizr JS -->
	<script src="{{asset('assets/template/wedding/sweety/js/modernizr-2.6.2.min.js')}}"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="{{asset('assets/template/wedding/sweety/js/respond.min.js')}}"></script>
	<![endif]-->

	<!-- SweetAlert2 -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">

    <style>
        #page {
            margin: 0px 0px 56px 0px;
        }
        .navbar-expand {
            -ms-flex-flow: row nowrap;
            flex-flow: row nowrap;
            -ms-flex-pack: start;
            justify-content: flex-start;
        }
        .navbar-expand .navbar-nav {
            -ms-flex-direction: row;
            flex-direction: row;
        }
        .navbar-expand .navbar-nav .dropdown-menu {
            position: absolute;
        }
        .navbar-expand .navbar-nav .nav-link {
            padding-right: .5rem;
            padding-left: .5rem;
        }
        .navbar-expand > .container, .navbar-expand > .container-fluid {
            -ms-flex-wrap: nowrap;
            flex-wrap: nowrap;
            padding-right: 0;
            padding-left: 0;
        }
        .navbar-expand .navbar-collapse {
            display: -ms-flexbox !important;
            display: flex !important;
            -ms-flex-preferred-size: auto;
            flex-basis: auto;
        }
        .navbar-expand .navbar-toggler {
            display: none;
        }
        .nav-justified .nav-item {
            -ms-flex-preferred-size: 0;
            flex-basis: 0;
            -ms-flex-positive: 1;
            flex-grow: 1;
            text-align: center;
        }
        .w-100 {
            width: 100% !important;
        }
    </style>
	</head>
	<body>

	<div class="fh5co-loader"></div>

	@if ($is_preview)
	@include('invitation.wedding.preview_alert')
	@endif

	<div id="page">
	<nav id="fh5co-nav" class="navbar navbar-default navbar-expand navbar-fixed-bottom" role="navigation" style="display:none;">
        <ul class="nav navbar-nav nav-justified w-100">
            <li class="nav-item"><a href="#" class="nav-link"><i class="text-primary icon-home"></i></a></li>
            <li class="nav-item"><a href="#fh5co-couple" class="nav-link"><i class="text-primary fas fa-user-friends"></i></a></li>
            <li class="nav-item"><a href="#fh5co-event" class="nav-link"><i class="text-primary icon-calendar"></i></a></li>
			@if (count($story) > 0)
				<li class="nav-item"><a href="#fh5co-couple-story" class="nav-link"><i class="text-primary fas fa-dove"></i></a></li>
			@endif
            <li class="nav-item"><a href="#fh5co-gallery" class="nav-link"><i class="text-primary fas fa-image"></i></a></li>
            <li class="nav-item"><a href="#fh5co-testimonial" class="nav-link"><i class="text-primary fas fa-comment"></i></a></li>
            @if ($is_has_guest && count($bank_acc_donations) > 0)
                <li class="nav-item"><a href="#fh5co-services" class="nav-link"><i class="text-primary fas fa-gift"></i></a></li>
            @endif
        </ul>
	</nav>

	<header id="fh5co-header" class="fh5co-cover" role="banner" style="background-image:url({{empty($wedding->photo_sampul) ? asset('assets/template/wedding/sweety/images/img_bg_1.jpg') : asset('assets/img/wedding/photo/sampul/'.$wedding->photo_sampul)}});" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<div class="display-t">
						<div class="display-tc animate-box" data-animate-effect="fadeIn">
							<h1>{{empty($groom->nickname) ? 'Pria' : $groom->nickname}} &amp; {{empty($bride->nickname) ? 'Wanitanya' : $bride->nickname}}</h1>
							<h2>We Are Getting Married</h2>
							<div class="simply-countdown simply-countdown-one"></div>
							@if ($event_count > 0)
								<p><a href="{{$save_date_link}}" target="_blank" class="btn btn-default btn-sm">Save the date</a></p>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<div id="fh5co-couple">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box">
					<h2>Hello!</h2>
					<h3>{{count($event) > 0 ? Carbon\Carbon::parse($event[0]->startdate)->format('D, d M Y') . ' - ' . $event[0]->place : 'Tanggal dan Tempat acara akan tampil di sini.' }}</h3>
					<p>We invited you to celebrate our wedding</p>
				</div>
			</div>
			<div class="couple-wrap animate-box">
				<div class="couple-half">
					<div class="groom">
						<img src="{{empty($groom->photo) ? asset('assets/template/wedding/sweety/images/groom.jpg') : asset('assets/img/wedding/photo/bride/'.$groom->photo)}}" alt="groom" class="img-responsive">
					</div>
					<div class="desc-groom">
						<h3 class="animate-slideInLeft">{{empty($groom->name) ? 'Pengantin Pria' : $groom->name }}</h3>
						@if (!empty($groom->mother) && !empty($groom->father))
							<h5>{{ $groom->gender == Constant::CODE_MALE ? 'Putra' : 'Putri' }} dari Bapak <strong>{{$groom->father}}</strong>, dan Ibu <strong>{{$groom->mother}}</strong>.</h5>
						@endif
						@if (!empty($groom->about))
							<p style="font-size:12px;">{{ $groom->about }}</p>
						@endif
					</div>
				</div>
				<p class="heart text-center"><i class="icon-heart2"></i></p>
				<div class="couple-half">
					<div class="bride">
						<img src="{{empty($bride->photo) ? asset('assets/template/wedding/sweety/images/bride.jpg') : asset('assets/img/wedding/photo/bride/'.$bride->photo)}}" alt="bride" class="img-responsive">
					</div>
					<div class="desc-bride">
						<h3 class="animate-slideInRight">{{empty($bride->name) ? 'Pengantin Wanita' : $bride->name }}</h3>
						@if (!empty($bride->mother) && !empty($bride->father))
							<h5>{{ $bride->gender == Constant::CODE_MALE ? 'Putra' : 'Putri' }} dari Bapak <strong>{{$bride->father}}</strong>, dan Ibu <strong>{{$bride->mother}}</strong>.</h5>
						@endif
						@if (!empty($bride->about))
							<p style="font-size:12px;">{{ $bride->about }}</p>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="fh5co-event" class="fh5co-bg" style="background-image:url({{asset('assets/template/wedding/sweety/images/img_bg_3.jpg')}});">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box">
					<span>Our Special Events</span>
					<h2>Wedding Events</h2>
				</div>
			</div>
			<div class="row">
				<div class="display-t">
					<div class="display-tc">
						<div class="col-md-10 col-md-offset-1">
							@if (count($event) > 0)
								@foreach ($event as $event_no => $evn)
									<div class="col-md-6 col-sm-6 text-center">
										<div class="event-wrap animate-box">
											<h3>{{empty($evn->name) ? $evn->event_type->name : $evn->name}}</h3>
											<div class="event-col">
												<i class="icon-clock"></i>
												<span>{{Carbon\Carbon::parse($evn->startdate)->format('H:i T')}}</span>
												<span>{{Carbon\Carbon::parse($evn->enddate)->format('H:i T')}}</span>
											</div>
											<div class="event-col">
												<i class="icon-calendar"></i>
												@if (Carbon\Carbon::parse($evn->startdate)->format('d-M-Y') == Carbon\Carbon::parse($evn->enddate)->format('d-M-Y'))
													<span>{{Carbon\Carbon::parse($evn->startdate)->format('D')}}</span>
													<span>{{Carbon\Carbon::parse($evn->startdate)->format('d M Y')}}</span>
												@else
													<span>{{Carbon\Carbon::parse($evn->startdate)->format('D, d M Y')}}</span>
													<span>{{Carbon\Carbon::parse($evn->enddate)->format('D, d M Y')}}</span>
												@endif
											</div>
											<i class="icon-location-pin"></i>
											<p>{{$evn->place}}</p>
											<p>{{$evn->address}}</p>
											@if ($gmaps_rule_value)
												<div>{!! $evn->map !!}</div>
											@endif
										</div>
									</div>
								@endforeach
							@else
								<div class="text-center event-wrap animate-box">
									<h3>Tidak ada acara, acara belum diisi.</h3>
								</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	@if (count($story) > 0)
		<div id="fh5co-couple-story">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box">
						<span>We Love Each Other</span>
						<h2>Our Story</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-md-offset-0">
						<ul class="timeline animate-box">
							@foreach($story as $story_no => $str)
								<li class="animate-box {{$story_no % 2 > 0 ? 'timeline-inverted' : null }}">
									<div class="timeline-badge" style="background-image:url({{empty($str->photo) ? asset('assets/template/wedding/sweety/images/couple-1.jpg') : asset('assets/img/wedding/photo/story/'.$str->photo)}});"></div>
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
					</div>
				</div>
			</div>
		</div>
	@endif

	<div id="fh5co-gallery" class="fh5co-section-gray">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box">
					<span>Our Memories</span>
					<h2>Wedding Gallery</h2>
				</div>
			</div>
			<div class="row row-bottom-padded-md">
				<div class="col-md-12">
					@if (count($gallery) > 0)
						<ul id="fh5co-gallery-list">
							@foreach ($gallery as $gallery_no => $glr)
								<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url({{asset('assets/img/wedding/photo/gallery/'.$glr->photo)}});"
									data-img-src="{{asset('assets/img/wedding/photo/gallery/'.$glr->photo)}}"
									data-img-title="{{empty($glr->name) ? 'Wedding Photo' : $glr->name}}"
									onclick="$('#viewPictTitle').text($(this).data('img-title'));
										$('#viewPictImage').attr('src',$(this).data('img-src'));
										$('#viewPictModal').modal('show');">
									<a style="cursor:pointer;">
										<div class="case-studies-summary">
											{{-- <span>14 Photos</span> --}}
											<h2>{{$glr->name}}</h2>
										</div>
									</a>
								</li>
							@endforeach
						</ul>
					@else
						<div class="fh5co-heading text-center animate-box">
							<p>Tidak ada Gallery yang ditemukan.</p>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>

	<div id="fh5co-counter" class="fh5co-bg fh5co-counter" style="background-image:url({{asset('assets/template/wedding/sweety/images/img_bg_5.jpg')}});">
		<div class="overlay"></div>
		<div class="container">
			<div class="row" style="padding-top:40px;">
				<div class="display-t">
					<div class="display-tc">
						<div class="col-md-3 col-sm-6 animate-box">
							<div class="feature-center">
								<span class="icon">
									<i class="icon-users"></i>
								</span>
								<span class="counter js-counter" data-from="0" data-to="{{$guest_estimate}}" data-speed="5000" data-refresh-interval="50">1</span>
								<span class="counter-label">Estimasi Tamu</span>
							</div>
						</div>
						<div class="col-md-3 col-sm-6 animate-box">
							<div class="feature-center">
								<span class="icon">
									<i class="icon-user"></i>
								</span>
								<span class="counter js-counter" data-from="0" data-to="{{$guest_act_presence}}" data-speed="5000" data-refresh-interval="50">1</span>
								<span class="counter-label">Kehadiran Tamu</span>
							</div>
						</div>
						<div class="col-md-3 col-sm-6 animate-box">
							<div class="feature-center">
								<span class="icon">
									<i class="icon-calendar"></i>
								</span>
								<span class="counter js-counter" data-from="0" data-to="{{$event_count}}" data-speed="5000" data-refresh-interval="50">1</span>
								<span class="counter-label">Jumlah Acara</span>
							</div>
						</div>
						<div class="col-md-3 col-sm-6 animate-box">
							<div class="feature-center">
								<span class="icon">
									<i class="icon-clock"></i>
								</span>
								<span class="counter js-counter" data-from="0" data-to="{{$hours_spent}}" data-speed="5000" data-refresh-interval="50">1</span>
								<span class="counter-label">Lama Acara (Jam)</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="fh5co-testimonial">
		<div class="container">
			<div class="row">
				<div class="row animate-box">
					<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
						<span>Best Wishes</span>
						<h2>Friends Wishes</h2>
						@if($is_has_guest)
						<button id="btn-create-greeting" class="btn btn-primary">Buat ucapan Kamu</button>
						@endif
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 animate-box">
						@if (count($greeting) > 0)
							<div class="wrap-testimony">
								<div class="{{count($greeting) > 1 ? 'owl-carousel-fullwidth' : null }}">
									@foreach ($greeting as $greeting_no => $grt)
										<div class="item">
											<div class="testimony-slide active text-center">
												{{-- <figure>
													<img src="{{asset('assets/template/wedding/sweety/images/couple-1.jpg')}}" alt="{{$grt->guest->name}}">
												</figure> --}}
												<h3>{{$grt->guest->name}}</h3>
												<span>{{Carbon\Carbon::parse($grt->date)->format('d M Y H:i')}}</span>
												<blockquote>
													<p>"{{$grt->greeting}}"</p>
												</blockquote>
											</div>
										</div>
									@endforeach
								</div>
							</div>
							<div class="text-center">
								<span id="btn-load-greeting" class="text-primary" style="cursor:pointer;">Lihat semua <i class="icon-open"></i></span>
							</div>
						@else
							<div class="fh5co-heading text-center animate-box">
								<p>Friends Wishes will appear here.</p>
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>

	{{--
	<div id="fh5co-services" class="fh5co-section-gray">
		<div class="container">

			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<h2>We Offer Services</h2>
					<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="feature-left animate-box" data-animate-effect="fadeInLeft">
						<span class="icon">
							<i class="icon-calendar"></i>
						</span>
						<div class="feature-copy">
							<h3>We Organized Events</h3>
							<p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto culpa amet.</p>
						</div>
					</div>

					<div class="feature-left animate-box" data-animate-effect="fadeInLeft">
						<span class="icon">
							<i class="icon-image"></i>
						</span>
						<div class="feature-copy">
							<h3>Photoshoot</h3>
							<p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto culpa amet.</p>
						</div>
					</div>

					<div class="feature-left animate-box" data-animate-effect="fadeInLeft">
						<span class="icon">
							<i class="icon-video"></i>
						</span>
						<div class="feature-copy">
							<h3>Video Editing</h3>
							<p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto culpa amet.</p>
						</div>
					</div>

				</div>

				<div class="col-md-6 animate-box">
					<div class="fh5co-video fh5co-bg" style="background-image: url({{asset('assets/template/wedding/sweety/images/img_bg_3.jpg')}}); ">
						<a href="https://vimeo.com/channels/staffpicks/93951774" class="popup-vimeo"><i class="icon-video2"></i></a>
						<div class="overlay"></div>
					</div>
				</div>
			</div>


		</div>
	</div>
	--}}

	@if ($is_has_guest)
        @if (count($bank_acc_donations) > 0)
            <div id="fh5co-services" class="fh5co-section-gray">
                <div class="container">
                    <div class="row animate-box">
                        <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                            <h2>Send Gifts</h2>
                            <p>Kirim hadiah untuk kedua pengantin.</p>
                        </div>
                    </div>

                    <div class="row">
                        @foreach ($bank_acc_donations as $bank_no => $bank_obj)
                            @if (count($bank_acc_donations) > 3)
                            <div class="col-md-3 col-sm-6 animate-box">
                            @elseif (count($bank_acc_donations) > 2)
                            <div class="col-md-4 col-sm-4 animate-box">
                            @elseif (count($bank_acc_donations) > 1)
                            <div class="col-md-6 col-sm-6 animate-box">
                            @else
                            <div class="col-md-12 col-sm-12 animate-box">
                            @endif
                                <div class="feature-center" id="copy-bank-no" data-id="{{$bank_obj->id}}">
                                    <span class="icon" style="margin: 0 auto 0 auto;">
                                        <i><img alt="{{$bank_obj->bank_master->name}}" src="{{asset('assets/img/banks/'.$bank_obj->bank_master->image)}}"></i>
                                    </span>
                                    <span>{{$bank_obj->bank_master->name}}</span></br>
                                    <span>{{$bank_obj->number}} ({{$bank_obj->currency->code}}) <i class="icon-copy"></i></span></br>
                                    <input type="text" value="{{$bank_obj->number}}" id="bank_id_{{$bank_obj->id}}" style="display:none;">
                                    <span>{{$bank_obj->name}}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

	<div id="fh5co-started" class="fh5co-bg" style="background-image:url({{asset('assets/template/wedding/sweety/images/img_bg_4.jpg')}});">
		<div class="overlay"></div>
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<h2>Are You Attending?</h2>
					{{-- <p>Please fill out the form to notify {{empty($groom->nickname) ? 'the groom' : $groom->nickname}} and {{empty($bride->nickname) ? 'the bride' : $bride->nickname}} that you will be attending. Ignore this if you do not wish to attend. Thanks.</p> --}}
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
					{{-- <form class="form-inline" action="{{route('invitation.guest.update_presence',[$template_category->name,$template_user->user_url])}}" method="POST">
						@csrf
						@method('put') --}}
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
							<button type="submit" class="btn btn-default btn-block btn-update-presence" data-type="UPDATE" style="overflow:hidden; text-overflow:ellipsis;">{{$guest->status == Constant::TRUE_CONDITION ? 'Update kehadiran' : 'Saya akan datang'}}</button>
						</div>
					{{-- </form> --}}
				</div>
			</div>
			{{-- add space --}}
			<div class="row animate-box"><div class="col-md-10 col-md-offset-1 text-center fh5co-heading"></div></div>
			{{-- end add space --}}
			<div class="row animate-box">
				<div class="col-md-10 col-md-offset-1 text-center fh5co-heading">
					<div>{!!$guest_qr_code!!}</div>
					<p>Show me to reception to confirm your presence</p>
				</div>
			</div>
		</div>
	</div>
	@endif

	<footer id="fh5co-footer" role="contentinfo">
		<div class="container">

			<div class="row copyright">
				<div class="col-md-12 text-center">
					<p>
						<small class="block">&copy; {{Carbon\Carbon::now()->format('Y')}} <a href="/" target="_blank">{{config('app.name')}}</a>. All Rights Reserved.</small>
						{{--<small class="block">Designed by <a href="http://freehtml5.co/" target="_blank">FREEHTML5.co</a> Demo Images: <a href="http://unsplash.co/" target="_blank">Unsplash</a></small>--}}
					</p>
					{{--
					<p>
						<ul class="fh5co-social-icons">
							<li><a href="#"><i class="icon-twitter"></i></a></li>
							<li><a href="#"><i class="icon-facebook"></i></a></li>
							<li><a href="#"><i class="icon-instagram"></i></a></li>
							<li><a href="#"><i class="icon-linkedin"></i></a></li>
							<li><a href="#"><i class="icon-dribbble"></i></a></li>
						</ul>
					</p>
					--}}
				</div>
			</div>

		</div>
	</footer>
	</div>

	<div class="gototop js-top" style="display:none;">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>

	<div class="music-console" style="cursor:pointer;">
		<span id="music-rotate" class="rotate" style="animation-play-state:paused;"><img src="{{asset('assets/template/wedding/sweety/images/icon-music.png')}}" width="100%"></span>
		<div id="player" style="display:none;"></div>
	</div>

	<div class="invitation-cover" style="background-image:url({{empty($wedding->photo_sampul) ? asset('assets/template/wedding/sweety/images/img_bg_5.jpg') : asset('assets/img/wedding/photo/sampul/'.$wedding->photo_sampul)}});">
		<div class="invitation-cover-content">
			<div class="row animate-box">
				<div class="invitation-cover-heading">
					<h3>The Wedding of</h3>
					<h2>{{empty($groom->nickname) ? 'Pria' : $groom->nickname}} &amp; {{empty($bride->nickname) ? 'Wanitanya' : $bride->nickname}}</h2>
					<br>
					<h3>{{count($event) > 0 ? Carbon\Carbon::parse($event[0]->startdate)->format('D, d M Y') : 'Tanggal dan Tempat acara akan tampil di sini.' }}</h3>
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

	<div class="modal fade" tabindex="-1" role="dialog" id="viewPictModal">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 id="viewPictTitle" class="modal-title"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						{{--<span aria-hidden="true">&times;</span>--}}
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<img id="viewPictImage" src="" style="width: 100%">
						</div>
					</div>
				</div>
				<div class="modal-footer bg-whitesmoke br">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<!-- jQuery -->
	<script src="{{asset('assets/template/wedding/sweety/js/jquery.min.js')}}"></script>
	<!-- jQuery Easing -->
	<script src="{{asset('assets/template/wedding/sweety/js/jquery.easing.1.3.js')}}"></script>
	<!-- Bootstrap -->
	<script src="{{asset('assets/template/wedding/sweety/js/bootstrap.min.js')}}"></script>
	<!-- Waypoints -->
	<script src="{{asset('assets/template/wedding/sweety/js/jquery.waypoints.min.js')}}"></script>
	<!-- Carousel -->
	<script src="{{asset('assets/template/wedding/sweety/js/owl.carousel.min.js')}}"></script>
	<!-- countTo -->
	<script src="{{asset('assets/template/wedding/sweety/js/jquery.countTo.js')}}"></script>

	<!-- Stellar -->
	<script src="{{asset('assets/template/wedding/sweety/js/jquery.stellar.min.js')}}"></script>
	<!-- Magnific Popup -->
	<script src="{{asset('assets/template/wedding/sweety/js/jquery.magnific-popup.min.js')}}"></script>
	<script src="{{asset('assets/template/wedding/sweety/js/magnific-popup-options.js')}}"></script>

	<!-- // <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/0.0.1/prism.min.js"></script> -->
	<script src="{{asset('assets/template/wedding/sweety/js/simplyCountdown.min.js')}}"></script>
	<!-- Main -->
	<script src="{{asset('assets/template/wedding/sweety/js/main_v2.js')}}"></script>

	@include('invitation.wedding.script')

	<script>

		var d = 0;
		@if (count($event) > 0)
			d = new Date(new Date('{{Carbon\Carbon::parse($event[0]->startdate)->toIso8601String()}}').getTime());
		@else
			d = new Date(new Date().getTime() + 200 * 120 * 120 * 2000);
		@endif

		// default example
		simplyCountdown('.simply-countdown-one', {
			year: d.getFullYear(),
			month: d.getMonth() + 1,
			day: d.getDate(),
			hours: d.getHours(),
			minutes: d.getMinutes(),
			seconds: d.getSeconds(),
		});

		$('#btn-open').click(function() {
			player.load("{{asset('assets/file/musik/'.$music->path)}}");
			$('#fh5co-nav').css('display','flex');
            $('.fh5co-nav-toggle').remove();
            $('#fh5co-offcanvas').remove();
			// $('.gototop').css('display','block');
			$('.invitation-cover').fadeOut();
			$('#preview-alert').fadeIn();
		});

		function generate_greeting_item_html(name, date, text) {
			var customDate = dateTimeCustomFormat('d MMM yyyy hh:mm', date);
			return '<blockquote>'
			+ '<strong style="font-size:20px;">' + name + '</strong><br>'
			+ '<span style="font-size:12px;"><i class="icon-calendar"></i> ' + customDate + '</span><br>'
			+ '<q>' + text + '</q>'
			+ '</blockquote>';
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

        $('#copy-bank-no.feature-center').click(function() {
            var bank_id = $(this).data('id');
            var bank_no = $('input#bank_id_' + bank_id).val();
            // var bank_input = $('input#bank_id_' + bank_id);
            // bank_input.select();
            // bank_input.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            // navigator.clipboard.writeText(bank_input.value);
            navigator.clipboard.writeText(bank_no);

            // Alert the copied text
            swal("Copied: " + bank_no, { icon: "success" });
        });


        // Remove the transition class
        const animateSlideInLeft = document.querySelector('.animate-slideInLeft');
        animateSlideInLeft.classList.remove('animated');
        animateSlideInLeft.classList.remove('slideInLeft');

        // Create the observer, same as before:
        const animateSlideInLeftObserver = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateSlideInLeft.classList.add('animated');
                    animateSlideInLeft.classList.add('slideInLeft');
                    return;
                }

                animateSlideInLeft.classList.remove('animated');
                animateSlideInLeft.classList.remove('slideInLeft');
            });
        });

        animateSlideInLeftObserver.observe(document.querySelector('.animate-slideInLeft'));


        // Remove the transition class
        const animateSlideInRight = document.querySelector('.animate-slideInRight');
        animateSlideInRight.classList.remove('animated');
        animateSlideInRight.classList.remove('slideInRight');

        // Create the observer, same as before:
        const animateSlideInRightObserver = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateSlideInRight.classList.add('animated');
                    animateSlideInRight.classList.add('slideInRight');
                    return;
                }

                animateSlideInRight.classList.remove('animated');
                animateSlideInRight.classList.remove('slideInRight');
            });
        });

        animateSlideInRightObserver.observe(document.querySelector('.animate-slideInRight'));
	</script>

	</body>
</html>
