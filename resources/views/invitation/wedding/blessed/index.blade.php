<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      @include('invitation.wedding.link')
      <!-- bootstrap css -->
      <link rel="stylesheet" href="{{asset('assets/template/wedding/blessed/css/bootstrap.min.css')}}">
      <!-- style css -->
      <link rel="stylesheet" href="{{asset('assets/template/wedding/blessed/css/style.css')}}">
      <!-- Responsive-->
      <link rel="stylesheet" href="{{asset('assets/template/wedding/blessed/css/responsive.css')}}">
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="{{asset('assets/template/wedding/blessed/css/jquery.mCustomScrollbar.min.css')}}">
      <!-- Galleria Folio CSS -->
      <link rel="stylesheet" href="{{asset('assets/template/wedding/blessed/css/galleria.twelve.min.css')}}">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
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
   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="{{asset('assets/template/wedding/blessed/images/loading.gif')}}" alt="#" /></div>
      </div>
      <!-- end loader -->
      @if ($is_preview)
         @include('invitation.wedding.preview_alert')
      @endif
      <!-- header -->
      <header>
         <!-- header inner -->
         <div  class="head_top" style="background-image: url({{empty($wedding->photo_sampul) ? asset('assets/template/wedding/blessed/images/banner.jpg') : asset('assets/img/wedding/photo/sampul/'.$wedding->photo_sampul)}});">
            <div class="container">
               <div class="header">
                  <div class="row">
                     <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                        <div class="full">
                           <div class="center-desk">
                              <div class="logo">
                                 <a href="#"><img src="{{asset('assets/template/wedding/blessed/images/logo.png')}}" alt="#" /></a>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                        <nav class="navigation navbar navbar-expand-md navbar-dark ">
                           <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                           <span class="navbar-toggler-icon"></span>
                           </button>
                           <div class="collapse navbar-collapse" id="navbarsExample04">
                              <ul class="navbar-nav mr-auto">
                                 <li class="nav-item">
                                    <a class="nav-link" href="#">Home</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="#couple">Couple</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="#event">Event</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="#gallery">Gallery</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="#wishes">Wishes</a>
                                 </li>
                              </ul>
                           </div>
                        </nav>
                     </div>
                  </div>
               </div>
            </div>
            <!-- end header inner -->
            <!-- end header -->
            <!-- banner -->
            <section class="banner_main">
               <div class="container">
                  <div class="row d_flex">
                     <div class="col-md-12">
                        <div class="text-bg">
                           <span>We Are Getting Married</span>
                           <h1>{{empty($groom->nickname) ? 'Pria' : $groom->nickname}} &amp; {{empty($bride->nickname) ? 'Wanitanya' : $bride->nickname}}</h1>
                           <div class="simply-countdown simply-countdown-one"></div>
                           @if ($event_count > 0)
                              <a href="{{$save_date_link}}" target="_blank" class="mt-5">Save the date</a>
                           @endif
                        </div>
                     </div>
                  </div>
               </div>
            </section>
         </div>
      </header>
      <!-- end banner -->
      <!-- weare -->
      <div id="couple" class="weare">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Hello!</h2>
                     <h3>{{count($event) > 0 ? Carbon\Carbon::parse($event[0]->startdate)->format('D, d M Y') . ' - ' . $event[0]->place : 'Tanggal dan Tempat acara akan tampil di sini.' }}</h3>
                     <span>We invited you to celebrate our wedding</span>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-10 offset-md-1 mb-4">
                  <div class="row">
                     <div class="col-md-6 margin_boo">
                        <div class="weare_box ">
                           <figure><img src="{{empty($groom->photo) ? asset('assets/template/wedding/blessed/images/weare_img1.png') : asset('assets/img/wedding/photo/bride/'.$groom->photo)}}" alt="#" style="width:300px;"/></figure>
                           <h1 class="mt-2">{{empty($groom->name) ? 'Pengantin Pria' : $groom->name }}</h1>
                           @if (!empty($groom->mother) && !empty($groom->father))
                              <h3>{{ $groom->gender == Constant::CODE_MALE ? 'Putra' : 'Putri' }} dari Bapak <strong>{{$groom->father}}</strong>, dan Ibu <strong>{{$groom->mother}}</strong>.</h3>
                           @endif
                           @if (!empty($groom->about))
                              <p>{{ $groom->about }}</p>
                           @endif
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="weare_box">
                           <figure><img src="{{empty($bride->photo) ? asset('assets/template/wedding/blessed/images/weare_img2.png') : asset('assets/img/wedding/photo/bride/'.$bride->photo)}}" alt="#" style="width:300px;"/></figure>
                           <h1 class="mt-2">{{empty($bride->name) ? 'Pengantin Wanita' : $bride->name }}</h1>
                           @if (!empty($bride->mother) && !empty($bride->father))
                              <h3>{{ $bride->gender == Constant::CODE_MALE ? 'Putra' : 'Putri' }} dari Bapak <strong>{{$bride->father}}</strong>, dan Ibu <strong>{{$bride->mother}}</strong>.</h3>
                           @endif
                           @if (!empty($bride->about))
                              <p>{{ $bride->about }}</p>
                           @endif
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="weare_box">
                     <a class="read_more" href="#event">Read more</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- weare -->
      <!-- Our -->
      <div id="event" class="Our">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Wedding Events</h2>
                     <span>Our Special Events</span>
                  </div>
               </div>
            </div>
            <div class="row">
               @if (count($event) > 0)
                  @foreach ($event as $event_no => $evn)
                     <div class="{{count($event) > 1 ? 'col-md-6' : 'col-md-6 offset-md-3'}}">
                        <div class="Our_box">
                           {{--<i><img src="{{asset('assets/template/wedding/blessed/images/plan1.png')}}" alt="#"/></i>--}}
                           <h4>{{empty($evn->name) ? $evn->event_type->name : $evn->name}}</h4>
                           <div class="row">
                              <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                                 <p><i class="fas fa-clock"></i></p>
                                 <p>{{Carbon\Carbon::parse($evn->startdate)->format('H:i T')}}</p>
                                 <p>{{Carbon\Carbon::parse($evn->enddate)->format('H:i T')}}</p>
                              </div>
                              <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                                 <p><i class="fas fa-calendar"></i></p>
                                 @if (Carbon\Carbon::parse($evn->startdate)->format('d-M-Y') == Carbon\Carbon::parse($evn->enddate)->format('d-M-Y'))
                                    <p>{{Carbon\Carbon::parse($evn->startdate)->format('D')}}</p>
                                    <p>{{Carbon\Carbon::parse($evn->startdate)->format('d M Y')}}</p>
                                 @else
                                    <p>{{Carbon\Carbon::parse($evn->startdate)->format('D, d M Y')}}</p>
                                    <p>{{Carbon\Carbon::parse($evn->enddate)->format('D, d M Y')}}</p>
                                 @endif
                              </div>
                           </div>
                           <p><i class="fas fa-location-arrow"></i></p>
                           <p>{{$evn->place}}</p>
                           <p>{{$evn->address}}</p>
                           @if ($gmaps_rule_value)
                              <div>{!! $evn->map !!}</div>
                           @endif
                        </div>
                     </div>
                  @endforeach
               @else
                  <div class="col-md-12">
                     <div class="Our_box">
							   <h4>Tidak ada acara, acara belum diisi.</h4>
                     </div>
						</div>
               @endif
               <div class="col-md-12 mt-4">
                  <a class="read_more" href="#story">Read more</a>
               </div>
            </div>
         </div>
      </div>
      <!-- end Our -->
      <!-- story -->
      <div id="story" class="story" style="display:none;">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Our Story</h2>
                     @if (count($story) > 0) <span>We love each other as told below</span> @endif
                  </div>
               </div>
            </div>
         </div>
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  @if (count($story) > 0)
                     <div class="timeline-wrapper">
                        <div class="timeline">
                           @foreach($story as $story_no => $str)
                              <div class="timeline-container {{$story_no % 2 > 0 ? 'timeline-container-right' : 'timeline-container-left' }}">
                                 <div class="timeline-content">
                                    <h2 class="float-right">{{Carbon\Carbon::parse($str->date)->format('d M Y')}}</h2>
                                    <h2>{{$str->title}}</h2>
                                    <q>{{$str->desc}}</q>
                                 </div>
                              </div>
                           @endforeach
                        </div>
                     </div>
                  @else
                     <div class="text-center">
                        <p>Tidak ada cerita yang bisa ditampilkan.</p>
                     </div>
                  @endif
               </div>
            </div>
         </div>
      </div>
      <!-- end story -->
      <!-- Gallery -->
      <div id="gallery" class="Our" style="display:none;">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Wedding Gallery</h2>
                     <span>Our Memories</span>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-10 offset-md-1">
                  @if (count($gallery) > 0)
                     {{--
                     <div class="galleria">
                        @foreach ($gallery as $gallery_no => $glr)
                           <img src="{{asset('assets/img/wedding/photo/gallery/'.$glr->photo)}}" data-title="{{$glr->name}}" data-description="Photo by {{empty($groom->nickname) ? 'Pria' : $groom->nickname}} & {{empty($bride->nickname) ? 'Wanitanya' : $bride->nickname}} at {{config('app.name')}}" alt="{{$glr->name}}"/>
                        @endforeach
                     </div>
                     --}}
                     <!-- Pake Swiper -->
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
                  @else
                     <div class="text-center">
                        <h4 style="color:white;">Tidak ada Gallery yang ditemukan.</h4>
                     </div>
                  @endif
               </div>
               <div class="col-md-12 mt-4">
                  <a class="read_more" href="{{$is_has_guest ? '#regist' : '#wishes'}}">Read more</a>
               </div>
            </div>
         </div>
      </div>
      <!-- end Gallery -->
      <!-- regist -->
      @if ($is_has_guest)
      <div id="regist" class="regist">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Are You Attending?</h2>
                     <span>Silakan isi formulir di bawah untuk memberi tahu {{empty($groom->nickname) ? 'Pengantin Pria' : $groom->nickname}} dan {{empty($bride->nickname) ? 'Pengantin Wanita' : $bride->nickname}} bahwa Anda akan hadir. <i id="info-batal-atau-abaikan">{{$guest->status == Constant::TRUE_CONDITION ? "Klik 'Batalkan'" : 'Abaikan ini'}}</i> jika Anda tidak berkenan hadir. Terima kasih.</span>
                     <div class="row mt-4">
                        <div class="{{$guest->status == Constant::TRUE_CONDITION ? 'col-12 col-sm-4 col-md-4 col-lg-4' : 'col-12 col-sm-12 col-md-12 col-lg-12'}} mt-2 div-info-status-hadir"><p>Status kehadiran: <span id="info-status-hadir" class="badge badge-primary">{{$guest->status == Constant::TRUE_CONDITION ? 'Hadir' : 'Tidak Hadir'}}</span></p></div>
                        <div class="col-12 col-sm-4 col-md-4 col-lg-4 info-jumlah-tamu-dan-tombol-batalkan mt-2" @if ($guest->status == Constant::FALSE_CONDITION) style="display:none;" @endif><p>Tamu yang akan hadir: <span id="info-jumlah-hadir" class="badge badge-primary">{{$guest->presence}}</span></p></div>
                        <div class="col-12 col-sm-4 col-md-4 col-lg-4 info-jumlah-tamu-dan-tombol-batalkan mt-2" @if ($guest->status == Constant::FALSE_CONDITION) style="display:none;" @endif><button class="btn-blessed btn-blessed-dark btn-update-presence" data-type="CANCEL">Batalkan</button></div>
					      </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="container">
            <div class="row">
               <div class="col-md-12 ">
                  <div class="main_form">
                     <div class="row">
                        <div class="col-md-6 ">
                           <input class="contactus" placeholder="Name" type="text" id="guest_name" name="name" value="{{$guest_name}}" disabled>
                        </div>
                        <div class="col-md-6">
                           <input class="contactus" placeholder="Berapa banyak yang akan hadir?" type="number" id="guest_presence" name="presence" min="{{Constant::MIN_PRESENCE_OF_EACH_GUEST}}" max="{{Constant::MAX_PRESENCE_OF_EACH_GUEST}}">
                        </div>
                        <div class="col-sm-12">
                           <button class="register btn-update-presence" data-type="UPDATE">{{$guest->status == Constant::TRUE_CONDITION ? 'Update kehadiran' : 'Saya akan datang'}}</button>
                        </div>
                        <div class="col-sm-12 text-center mt-5">
                           <div>{!!$guest_qr_code!!}</div>
					            <p>Show me to reception to confirm your presence</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      @endif
      <!-- end regist -->
      <!-- testimonial -->
      <div id="wishes" class="testimonial" style="display:none;">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Friends Wishes</h2>
                     <p>Best Wishes</p>
                     @if($is_has_guest)
                        <button id="btn-create-greeting" class="btn-blessed btn-blessed-light mt-4">Buat ucapan Kamu</button>
                     @endif
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  @if (count($greeting) > 0)
                     <div id="myCarousel" class="carousel slide testimonial_Carousel" data-ride="carousel">
                        <ol class="carousel-indicators">
                           @foreach ($greeting as $greeting_no => $grt)
                              <li data-target="#myCarousel" data-slide-to="{{$greeting_no}}" class="{{$greeting_no == 0 ? 'active' : null}}"></li>
                           @endforeach
                        </ol>
                        <div class="carousel-inner">
                           @foreach ($greeting as $greeting_no => $grt)
                              <div class="carousel-item {{$greeting_no == 0 ? 'active' : null}}">
                                 <div class="container">
                                    <div class="carousel-caption">
                                       <div class="row">
                                          <div class="col-md-6 offset-md-3">
                                             <div class="test_box">
                                                <div class="jons">
                                                   {{--<i><img src="{{asset('assets/img/avatar/avatar-5.png')}}" width="84" alt="default-profile-photo"/></i>--}}
                                                   <h4>{{$grt->guest->name}}</h4>
                                                </div>
                                                <p><b><q>{{$grt->greeting}}</q></b><br>{{Carbon\Carbon::parse($grt->date)->format('d M Y H:i')}}</p>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                           <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                           <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                           <span class="carousel-control-next-icon" aria-hidden="true"></span>
                           <span class="sr-only">Next</span>
                        </a>
                     </div>
                     <div class="text-center mt-5">
								<p id="btn-load-greeting" style="cursor:pointer;color:white;">Lihat semua <i class="fas fa-external-link-alt"></i></p>
							</div>
                  @else
                     <div class="titlepage">
								<p>Friends Wishes will appear here.</p>
							</div>
                  @endif
               </div>
            </div>
         </div>
      </div>
      <!-- end testimonial -->

      <div class="music-console" style="cursor:pointer;">
         <span id="music-rotate" class="rotate" style="animation-play-state:paused;"><img src="{{asset('assets/template/wedding/blessed/images/icon-music.png')}}" width="100%"></span>
         <div id="player" style="display:none;"></div>
	   </div>

      <div class="invitation-cover" style="background-image:url({{empty($wedding->photo_sampul) ? asset('assets/template/wedding/blessed/images/banner.jpg') : asset('assets/img/wedding/photo/sampul/'.$wedding->photo_sampul)}});">
         <div class="invitation-cover-content" style="background-image:url({{asset('assets/template/wedding/blessed/images/img_bg_1.jpg')}});">
            <div class="row">
               <div class="text-center invitation-cover-heading">
                  <h3>The Wedding of</h3>
                  <h2>{{empty($groom->nickname) ? 'Pria' : $groom->nickname}} &amp; {{empty($bride->nickname) ? 'Wanitanya' : $bride->nickname}}</h2>
                  <br>
                  <h3>{{count($event) > 0 ? Carbon\Carbon::parse($event[0]->startdate)->format('D, d M Y') : 'Tanggal dan Tempat acara akan tampil di sini.' }}</h3>
                  <br>
                  @if($is_has_guest)<h3><strong>{{$guest_name}}</strong></h3>@endif
                  <p>{{$is_has_guest ? "We invited you to celebrate our wedding" : "Let's celebrate our wedding"}}</p>
                  <br><br>
                  <input type="button" id="btn-open" class="btn-blessed btn-blessed-dark" value="Open Invitation">
               </div>
            </div>
         </div>
      </div>

      @if($is_has_guest)
	   @include('invitation.wedding.create_greeting_modal')
	   @endif

	   @include('invitation.wedding.load_greeting_modal')

      <!--  footer -->
      <footer style="display:none;">
         <div class="footer">
            <div class="container">
               <div class="row">
                  <div class="col-md-10 offset-md-1">
                     <div class="cont">
                        <h3><strong class="multi">The Wedding of</strong><br>
                           {{empty($groom->nickname) ? 'Pria' : $groom->nickname}} &amp; {{empty($bride->nickname) ? 'Wanitanya' : $bride->nickname}}
                        </h3>
                     </div>
                  </div>
               </div>
            </div>
            <div class="copyright">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        <p>
                           &copy; Copyright {{Carbon\Carbon::now()->format('Y')}} <a href="/" target="_blank">{{config('app.name')}}</a>. All Rights Reserved.
                           {{-- By <a href="https://html.design/" target="_blank"> Free html Templates</a> --}}
                        </p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <!-- end footer -->
      <!-- Javascript files-->
      <script src="{{asset('assets/template/wedding/blessed/js/jquery.min.js')}}"></script>
      <script src="{{asset('assets/template/wedding/blessed/js/popper.min.js')}}"></script>
      <script src="{{asset('assets/template/wedding/blessed/js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{asset('assets/template/wedding/blessed/js/jquery-3.0.0.min.js')}}"></script>
      <script src="{{asset('assets/template/wedding/blessed/js/plugin.js')}}"></script>
      <!-- sidebar -->
      <script src="{{asset('assets/template/wedding/blessed/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
      <script src="{{asset('assets/template/wedding/blessed/js/custom.js')}}"></script>
      <script src="{{asset('assets/template/wedding/blessed/js/simplyCountdown.min.js')}}"></script>
      <script src="{{asset('assets/template/wedding/blessed/js/galleria.min.js')}}"></script>
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
      <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

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
            $('.testimonial').fadeIn();
            $('footer').fadeIn();
            $('#story').fadeIn();
            $('.invitation-cover').fadeOut();
            $('#preview-alert').fadeIn();
            // @if (count($gallery) > 0)
            //    Galleria.loadTheme('{{asset("assets/template/wedding/blessed/js/galleria.twelve.min.js")}}');
            //    Galleria.run('.galleria');
            // @endif

            $('#gallery').fadeIn();
            // Pake Swiper
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
            return '<blockquote>'
            + '<strong style="font-size:20px;">' + name + '</strong><br>'
            + '<span style="font-size:12px;"><i class="fas fa-calendar"></i> ' + customDate + '</span><br>'
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
      </script>
   </body>
</html>