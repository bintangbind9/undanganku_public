<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    @include('invitation.wedding.link')

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@400;600&display=swap" rel="stylesheet"> 

    {{--
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    --}}

    <!-- Libraries Stylesheet -->
    <link href="{{asset('assets/template/wedding/metro/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/template/wedding/metro/lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('assets/template/wedding/metro/css/style.css')}}" rel="stylesheet">
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="51">

    <div id="invitation-main-content" style="display:none;">

    <!-- Navbar Start -->
    <nav class="navbar fixed-top shadow-sm navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-lg-5">
        <a href="#" class="navbar-brand d-block d-lg-none">
            <h1 class="font-secondary text-white mb-n2">{{empty($groom->nickname) ? 'Pria' : $groom->nickname}} <span class="text-primary">&</span> {{empty($bride->nickname) ? 'Wanitanya' : $bride->nickname}}</h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="navbar-nav ml-auto py-0">
                <a href="#home" class="nav-item nav-link active">Home</a>
                <a href="#about" class="nav-item nav-link">About</a>
                <a href="#story" class="nav-item nav-link">Story</a>
                <a href="#gallery" class="nav-item nav-link">Gallery</a>
            </div>
            <a href="#" class="navbar-brand mx-5 d-none d-lg-block">
                <h1 class="font-secondary text-white mb-n2">{{empty($groom->nickname) ? 'Pria' : $groom->nickname}} <span class="text-primary">&</span> {{empty($bride->nickname) ? 'Wanitanya' : $bride->nickname}}</h1>
            </a>
            <div class="navbar-nav mr-auto py-0">
                <a href="#event" class="nav-item nav-link">Event</a>
                <a href="#wishes" class="nav-item nav-link">Wishes</a>
                <a href="{{$is_has_guest ? '#rsvp' : '#'}}" class="nav-item nav-link">RSVP</a>
                <a href="#contact" class="nav-item nav-link">End</a>
            </div>
        </div>
        @if ($is_preview)
            <div class="row mt-3">
                <div class="col-md-12">
                    @include('invitation.wedding.preview_alert')
                </div>
            </div>
        @endif
    </nav>
    <!-- Navbar End -->

    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5 pb-5" id="home">
        <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
                @if (count($gallery) > 0)
                    @foreach ($gallery as $no_g => $g)
                        <div class="carousel-item position-relative {{ $no_g == 0 ? 'active' : null }}" style="height: 100vh; min-height: 400px;">
                            <img class="position-absolute w-100 h-100" src="{{asset('assets/img/wedding/photo/gallery/'.$g->photo)}}" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 900px;">
                                    <h1 class="display-1 font-secondary text-white mt-n3 mb-md-4">{{empty($groom->nickname) ? 'Pria' : $groom->nickname}} & {{empty($bride->nickname) ? 'Wanitanya' : $bride->nickname}}</h1>
                                    <div class="d-inline-block border-top border-bottom border-light py-3 px-4">
                                        <h3 class="text-uppercase font-weight-normal text-white m-0" style="letter-spacing: 2px;">We're getting married</h3>
                                    </div>
                                    {{-- View Embedded Video, bisa ganti dengan button save date.
                                        <button type="button" class="btn-play mx-auto" data-toggle="modal"
                                            data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-target="#videoModal">
                                            <span></span>
                                        </button>
                                    --}}
                                    @if ($event_count > 0)
                                        <div class="mt-4">
                                            <p><a href="{{$save_date_link}}" target="_blank" class="btn btn-primary">Save the date</a></p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{-- MAX 3 foto yang ditampilkan --}}
                        @if ($no_g == 2)
                            @break
                        @endif
                    @endforeach
                @else
                    <div class="carousel-item position-relative active" style="height: 100vh; min-height: 400px;">
                        <img class="position-absolute w-100 h-100" src="{{asset('assets/template/wedding/metro/images/cover_bg_1.jpg')}}" style="object-fit: cover;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 900px;">
                                <h1 class="display-1 font-secondary text-white mt-n3 mb-md-4">{{empty($groom->nickname) ? 'Pria' : $groom->nickname}} & {{empty($bride->nickname) ? 'Wanitanya' : $bride->nickname}}</h1>
                                <div class="d-inline-block border-top border-bottom border-light py-3 px-4">
                                    <h3 class="text-uppercase font-weight-normal text-white m-0" style="letter-spacing: 2px;">We're getting married</h3>
                                </div>
                                {{-- View Embedded Video, bisa ganti dengan button save date.
                                    <button type="button" class="btn-play mx-auto" data-toggle="modal"
                                        data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-target="#videoModal">
                                        <span></span>
                                    </button>
                                --}}
                                @if ($event_count > 0)
                                    <div class="mt-4">
                                        <p><a href="{{$save_date_link}}" target="_blank" class="btn btn-primary">Save the date</a></p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            @if (count($gallery) > 1)
                <a class="carousel-control-prev justify-content-start" href="#header-carousel" data-slide="prev">
                    <div class="btn btn-primary px-0" style="width: 68px; height: 68px;">
                        <span class="carousel-control-prev-icon mt-3"></span>
                    </div>
                </a>
                <a class="carousel-control-next justify-content-end" href="#header-carousel" data-slide="next">
                    <div class="btn btn-primary px-0" style="width: 68px; height: 68px;">
                        <span class="carousel-control-next-icon mt-3"></span>
                    </div>
                </a>
            @endif
        </div>
    </div>
    <!-- Carousel End -->

    {{-- Embedded Video Modal
        <!-- Video Modal Start -->
        <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>        
                        <!-- 16:9 aspect ratio -->
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Video Modal End -->
    --}}

    <!-- About Start -->
    <div class="container-fluid py-5" id="about">
        <div class="container py-5">
            <div class="section-title position-relative text-center">
                <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;">About</h6>
                <h1 class="font-secondary display-4">Groom & Bride</h1>
                <i class="far fa-heart text-dark"></i>
            </div>
            <div class="row m-0 mb-4 mb-md-0 pb-2 pb-md-0">
                <div class="col-md-6 p-0 text-center text-md-right">
                    <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-5">
                        <h3 class="mb-3">The Groom</h3>
                        @if (!empty($groom->about))
							<p>{{ $groom->about }}</p>
						@endif
                        @if (!empty($groom->mother) && !empty($groom->father))
							<p>{{ $groom->gender == Constant::CODE_MALE ? 'Putra' : 'Putri' }} dari Bapak <strong>{{$groom->father}}</strong>, dan Ibu <strong>{{$groom->mother}}</strong>.</p>
						@endif
                        <h3 class="font-secondary font-weight-normal text-muted mb-3"><i class="fa fa-male text-primary pr-3"></i>{{empty($groom->name) ? 'Pengantin Pria' : $groom->name }}</h3>
                        {{--
                            <div class="position-relative">
                                <a class="btn btn-outline-primary btn-square mr-1" href="#"><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-outline-primary btn-square mr-1" href="#"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-outline-primary btn-square mr-1" href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-outline-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        --}}
                    </div>
                </div>
                <div class="col-md-6 p-0" style="min-height: 400px;">
                    <img class="position-absolute w-100 h-100" src="{{empty($groom->photo) ? asset('assets/template/wedding/metro/images/groom.jpg') : asset('assets/images/wedding/photo/bride/'.$groom->photo)}}" style="object-fit: cover;">
                </div>
            </div>
            <div class="row m-0">
                <div class="col-md-6 p-0" style="min-height: 400px;">
                    <img class="position-absolute w-100 h-100" src="{{empty($bride->photo) ? asset('assets/template/wedding/metro/images/bride.jpg') : asset('assets/images/wedding/photo/bride/'.$bride->photo)}}" style="object-fit: cover;">
                </div>
                <div class="col-md-6 p-0 text-center text-md-left">
                    <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-5">
                        <h3 class="mb-3">The Bride</h3>
                        @if (!empty($bride->about))
							<p>{{ $bride->about }}</p>
						@endif
                        @if (!empty($bride->mother) && !empty($bride->father))
							<p>{{ $bride->gender == Constant::CODE_MALE ? 'Putra' : 'Putri' }} dari Bapak <strong>{{$bride->father}}</strong>, dan Ibu <strong>{{$bride->mother}}</strong>.</p>
						@endif
                        <h3 class="font-secondary font-weight-normal text-muted mb-3"><i class="fa fa-female text-primary pr-3"></i>{{empty($bride->name) ? 'Pengantin Wanita' : $bride->name }}</h3>
                        {{--
                            <div class="position-relative">
                                <a class="btn btn-outline-primary btn-square mr-1" href="#"><i class="fab fa-instagram"></i></a>
                                <a class="btn btn-outline-primary btn-square mr-1" href="#"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-outline-primary btn-square mr-1" href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-outline-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Story Start -->
    <div class="container-fluid py-5" id="story">
        <div class="container pt-5 pb-3">
            <div class="section-title position-relative text-center">
                <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;">Story</h6>
                <h1 class="font-secondary display-4">Our Love Story</h1>
                <i class="far fa-heart text-dark"></i>
            </div>
            @if (count($story) > 0)
                <div class="container timeline position-relative p-0">
                    @foreach($story as $story_no => $str)
                        <div class="row">
                            <div class="col-md-6 text-center text-md-right">
                                @if ($story_no % 2 == 0)
                                    <img class="img-fluid mr-md-3" src="{{empty($str->photo) ? asset('assets/template/wedding/metro/images/couple-1.png') : asset('assets/img/wedding/photo/story/'.$str->photo)}}" alt="">
                                @else
                                    <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-4 mr-md-3">
                                        <h4 class="mb-2">{{$str->title}}</h4>
                                        <p class="text-uppercase mb-2">{{Carbon\Carbon::parse($str->date)->format('d M Y')}}</p>
                                        <p class="m-0">{{$str->desc}}</p>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6 text-center text-md-left">
                                @if ($story_no % 2 == 0)
                                    <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-4 ml-md-3">
                                        <h4 class="mb-2">{{$str->title}}</h4>
                                        <p class="text-uppercase mb-2">{{Carbon\Carbon::parse($str->date)->format('d M Y')}}</p>
                                        <p class="m-0">{{$str->desc}}</p>
                                    </div>
                                @else
                                    <img class="img-fluid ml-md-3" src="{{empty($str->photo) ? asset('assets/template/wedding/metro/images/couple-1.png') : asset('assets/img/wedding/photo/story/'.$str->photo)}}" alt="">
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="position-relative text-center">
                    <p>Tidak ada cerita</p>
                </div>
            @endif
        </div>
    </div>
    <!-- Story End -->

    <!-- Gallery Start -->
    <div class="container-fluid bg-gallery" id="gallery" style="padding: 120px 0; margin: 90px 0; background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{ count($gallery) > 0 ? asset('assets/img/wedding/photo/gallery/'.$gallery[rand(0,count($gallery)-1)]->photo) : asset('assets/template/wedding/metro/images/gallery.jpg') }}), no-repeat center center; background-size: cover;">
        <div class="section-title position-relative text-center" style="margin-bottom: 120px;">
            <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;">Gallery</h6>
            <h1 class="font-secondary display-4 text-white">Our Photo Gallery</h1>
            <i class="far fa-heart text-white"></i>
        </div>
        @if (count($gallery) > 0)
            <div class="owl-carousel gallery-carousel">
                @foreach ($gallery as $gallery_no => $glr)
                    <div class="gallery-item">
                        <img class="img-fluid w-100" src="{{asset('assets/img/wedding/photo/gallery/'.$glr->photo)}}" alt="">
                        <a href="{{asset('assets/img/wedding/photo/gallery/'.$glr->photo)}}" data-lightbox="gallery">
                            <i class="fa fa-2x fa-search text-white"></i>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="position-relative text-center">
                <p class="text-white">Tidak ada foto</p>
            </div>
        @endif
    </div>
    <!-- Gallery End -->

    <!-- Event Start -->
    <div class="container-fluid py-5" id="event">
        <div class="container py-5">
            <div class="section-title position-relative text-center">
                <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;">Event</h6>
                <h1 class="font-secondary display-4">Our Wedding Event</h1>
                <i class="far fa-heart text-dark"></i>
            </div>
            @if ($is_has_guest && count($event) > 0)
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center">
                        <h5 class="font-weight-normal text-muted mb-3 pb-3">We invite you to celebrate our wedding on</h5>
                    </div>
                </div>
            @endif
            <div class="row">
                @if (count($event) > 0)
                    @foreach ($event as $event_no => $evn)
                        <div class="{{ count($event) == 1 ? 'offset-md-3 col-md-6' : ($event_no % 2 == 0 ? 'col-md-6 border-right border-primary' : 'col-md-6' ) }}">
                            <div class="text-center p-4">
                                {{--<img class="img-fluid mb-4" src="{{asset('assets/template/wedding/metro/images/gallery.jpg')}}" alt="">--}}
                                <h4 class="mb-3">{{empty($evn->name) ? $evn->event_type->name : $evn->name}}</h4>
                                <p class="mb-2">
                                    <i class="fas fa-calendar text-primary"></i>
                                    @if (Carbon\Carbon::parse($evn->startdate)->format('d-M-Y') == Carbon\Carbon::parse($evn->enddate)->format('d-M-Y'))
                                        {{Carbon\Carbon::parse($evn->startdate)->format('D, d M Y')}}
                                    @else
                                        {{Carbon\Carbon::parse($evn->startdate)->format('D, d M Y')}} - {{Carbon\Carbon::parse($evn->enddate)->format('D, d M Y')}}
                                    @endif
                                </p>
                                <p class="mb-2"><i class="fas fa-clock text-primary"></i> {{Carbon\Carbon::parse($evn->startdate)->format('H:i T')}} - {{Carbon\Carbon::parse($evn->enddate)->format('H:i T')}}</p>
                                <p class="mb-2"><i class="fas fa-home text-primary"></i> {{$evn->place}}</p>
                                <p class="mb-2" style="font-size:14px;">{{$evn->address}}</p>
                                @if ($gmaps_rule_value)
                                    <div class="mb-0">{!! $evn->map !!}</div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-12">
                        <div class="text-center">
                            <p>Tidak ada acara</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Event End -->

    <!-- Wishes Start -->
    <div class="container-fluid py-5" id="wishes">
        <div class="container pt-5 pb-3">
            <div class="section-title position-relative text-center">
                <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;">Best Wishes</h6>
                <h1 class="font-secondary display-4">Friends Wishes</h1>
                <i class="far fa-heart text-dark"></i>
            </div>
            <div class="row">
                <div class="col-12 text-center mb-2">
                    <ul class="list-inline mb-4" id="portfolio-flters">
                        @if($is_has_guest)
                        <li id="btn-create-greeting" class="btn btn-outline-primary font-weight-bold m-1 py-2 px-4">Buat ucapan Kamu</li>
                        @endif
                        <li id="btn-show-wishes-item" class="btn btn-outline-primary font-weight-bold m-1 py-2 px-4 d-none" data-filter=".wishes-item">Wishes Item</li>
                    </ul>
                    {{--
                        <ul class="list-inline mb-4" id="portfolio-flters">
                            <li class="btn btn-outline-primary font-weight-bold m-1 py-2 px-4" data-filter=".first">Groomsmen</li>
                            <li class="btn btn-outline-primary font-weight-bold m-1 py-2 px-4" data-filter=".second">Bridesmaid</li>
                        </ul>
                    --}}
                </div>
            </div>
            @if (count($greeting) > 0)
                <div class="row portfolio-container">
                    {{--
                        <div class="col-lg-4 col-md-6 mb-4 portfolio-item first">
                            <div class="position-relative mb-2">
                                <img class="img-fluid w-100" src="{{asset('assets/template/wedding/metro/images/groomsmen-1.jpg')}}" alt="">
                                <div class="bg-secondary text-center p-4">
                                    <h4 class="mb-3">Full Name</h4>
                                    <p class="text-uppercase">Best Friend</p>
                                    <div class="d-inline-block">
                                        <a class="mx-2" href="#"><i class="fab fa-twitter"></i></a>
                                        <a class="mx-2" href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a class="mx-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                                        <a class="mx-2" href="#"><i class="fab fa-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-4 portfolio-item second">
                            <div class="position-relative mb-2">
                                <img class="img-fluid w-100" src="{{asset('assets/template/wedding/metro/images/bridesmaid-1.jpg')}}" alt="">
                                <div class="bg-secondary text-center p-4">
                                    <h4 class="mb-3">Full Name</h4>
                                    <p class="text-uppercase">Best Friend</p>
                                    <div class="d-inline-block">
                                        <a class="mx-2" href="#"><i class="fab fa-twitter"></i></a>
                                        <a class="mx-2" href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a class="mx-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                                        <a class="mx-2" href="#"><i class="fab fa-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    --}}
                    @foreach ($greeting as $greeting_no => $grt)
                        <div
                            @if (count($greeting) == 1)
                                class="offset-lg-4 offset-md-3 col-lg-4 col-md-6 mb-4 portfolio-item wishes-item"
                            @elseif (count($greeting) == 2)
                                class="col-lg-6 col-md-6 mb-4 portfolio-item wishes-item"
                            @else
                                class="col-lg-4 col-md-6 mb-4 portfolio-item wishes-item"
                            @endif
                            >
                            <div class="position-relative mb-2">
                                {{--<img class="img-fluid w-100" src="images/groomsmen-2.jpg" alt="">--}}
                                <div class="bg-secondary text-center p-4">
                                    <h4 class="mb-3">{{$grt->guest->name}}</h4>
                                    <p class="text-uppercase">{{Carbon\Carbon::parse($grt->date)->format('d M Y H:i')}}</p>
                                    <div class="d-inline-block">
                                        {{--
                                            <a class="mx-2" href="#"><i class="fab fa-twitter"></i></a>
                                            <a class="mx-2" href="#"><i class="fab fa-facebook-f"></i></a>
                                            <a class="mx-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                                            <a class="mx-2" href="#"><i class="fab fa-instagram"></i></a>
                                        --}}
                                        <q>{{$grt->greeting}}</q>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- DI BAWAH INI HARUSNYA KONDISI count($greeting) > Constant::MAX_GREETING_DISPLAYED --}}
				    {{-- KARENA SUDAH DILIMIT 8 DI BELAKANG, SETIDAKNYA KALO SUDAH MENCAPAI BATAS MAKS, MUNCUL BUTTON LOAD MORE --}}
                    @if (count($greeting) >= Constant::MAX_GREETING_DISPLAYED)
                        <div class="col-lg-4 col-md-6 mb-4 portfolio-item wishes-item">
                            <div class="position-relative mb-2">
                                <div id="btn-load-greeting" class="bg-secondary text-center p-4" style="
                                    display:flex;
                                    justify-content:center;
                                    align-items:center;
                                    height:180px;
                                    cursor:pointer;"
                                    >
                                    <span style="font-size:48px;"><i class="fas fa-ellipsis-h"></i></span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <div class="row">
                    <div class="col-lg-12 col-md-12 mb-4 text-center">
                        <p>Ucapan teman-teman akan tampil di sini.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- Wishes End -->

    <!-- RSVP Start -->
    @if ($is_has_guest)
    <div class="container-fluid py-5" id="rsvp">
        <div class="container py-5">
            <div class="section-title position-relative text-center">
                <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;">RSVP</h6>
                <h1 class="font-secondary display-4">Join Our Party</h1>
                <i class="far fa-heart text-dark"></i>
            </div>
            <div class="row justify-content-center mb-4">
                <div class="col-lg-8">
                    <div class="text-center">
                        <p>Silakan isi formulir di bawah untuk memberi tahu {{empty($groom->nickname) ? 'Pengantin Pria' : $groom->nickname}} dan {{empty($bride->nickname) ? 'Pengantin Wanita' : $bride->nickname}} bahwa Anda akan hadir. <i id="info-batal-atau-abaikan">{{$guest->status == Constant::TRUE_CONDITION ? "Klik 'Batalkan'" : 'Abaikan ini'}}</i> jika Anda tidak berkenan hadir. Terima kasih.</p>
                        <div class="row">
                            <div class="{{$guest->status == Constant::TRUE_CONDITION ? 'col-12 col-sm-4 col-md-4 col-lg-4' : 'col-12 col-sm-12 col-md-12 col-lg-12'}} div-info-status-hadir"><p>Status kehadiran: <span id="info-status-hadir" class="badge badge-primary">{{$guest->status == Constant::TRUE_CONDITION ? 'Hadir' : 'Tidak Hadir'}}</span></p></div>
                            <div class="col-12 col-sm-4 col-md-4 col-lg-4 info-jumlah-tamu-dan-tombol-batalkan" @if ($guest->status == Constant::FALSE_CONDITION) style="display:none;" @endif><p>Tamu yang akan hadir: <span id="info-jumlah-hadir" class="badge badge-primary">{{$guest->presence}}</span></p></div>
                            <div class="col-12 col-sm-4 col-md-4 col-lg-4 info-jumlah-tamu-dan-tombol-batalkan" @if ($guest->status == Constant::FALSE_CONDITION) style="display:none;" @endif><a style="cursor:pointer" class="btn-update-presence" data-type="CANCEL">Batalkan</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center">
                        {{-- <form action="{{route('invitation.guest.update_presence',[$template_category->name,$template_user->user_url])}}" method="POST">
                            @csrf
                            @method('put') --}}
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    <input type="text" class="form-control bg-secondary border-0 py-4 px-3" id="guest_name" name="name" placeholder="Your Name" value="{{$guest_name}}" disabled>
                                </div>
                                <div class="form-group col-sm-6">
                                    <input type="number" class="form-control bg-secondary border-0 py-4 px-3" id="guest_presence" name="presence" placeholder="Berapa banyak yang akan hadir?" min="{{Constant::MIN_PRESENCE_OF_EACH_GUEST}}" max="{{Constant::MAX_PRESENCE_OF_EACH_GUEST}}">
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn-update-presence btn btn-primary font-weight-bold py-3 px-5" data-type="UPDATE" style="overflow:hidden; text-overflow:ellipsis;">{{$guest->status == Constant::TRUE_CONDITION ? 'Update kehadiran' : 'Saya akan datang'}}</button>
                            </div>
                        {{-- </form> --}}
                        {{-- QR Code --}}
                            <div class="mt-5">
                                <div>{!!$guest_qr_code!!}</div>
                                <p>Show me to reception to confirm your presence</p>
                            </div>
                        {{-- END QR Code --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- RSVP End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white py-5" id="contact" style="margin-top: 90px;">
        <div class="container text-center py-5">
            <div class="section-title position-relative text-center">
                <h1 class="font-secondary display-3 text-white">Thank You</h1>
                <i class="far fa-heart text-white"></i>
            </div>
            {{--
                <div class="d-flex justify-content-center mb-4">
                    <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-lg btn-outline-light btn-lg-square" href="#"><i class="fab fa-instagram"></i></a>
                </div>
                <div class="d-flex justify-content-center py-2">
                    <p class="text-white" href="#">info@example.com</p>
                    <span class="px-3">|</span>
                    <p class="text-white" href="#">+012 345 6789</p>
                </div>
            --}}
            <p class="m-0">&copy; {{Carbon\Carbon::now()->format('Y')}} <a class="text-primary" href="/" target="_blank">{{config('app.name')}}</a>. Designed by <a class="text-primary" href="https://htmlcodex.com" target="_blank">HTML Codex</a>
            </p>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Scroll to Bottom -->
    <i class="fa fa-2x fa-angle-down text-white scroll-to-bottom"></i>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-outline-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>

    </div> {{-- END DIV ID invitation-main-content --}}

    <div class="music-console" style="cursor:pointer;">
		<span id="music-rotate" class="rotate" style="animation-play-state:paused;"><i class="fas fa-music"></i></span>
		<div id="player" style="display:none;"></div>
	</div>

	<div class="invitation-cover">
		<div class="invitation-cover-content" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{empty($wedding->photo_sampul) ? asset('assets/template/wedding/metro/images/img_bg_5.jpg') : asset('assets/img/wedding/photo/sampul/'.$wedding->photo_sampul)}}), no-repeat center center; background-size: cover;">
			<div class="row">
				<div class="invitation-cover-heading">
					<h3 style="color: #cfcfcf;">The Wedding of</h3>
                    <h1 class="display-1 font-secondary text-white">{{empty($groom->nickname) ? 'Pria' : $groom->nickname}} &amp; {{empty($bride->nickname) ? 'Wanitanya' : $bride->nickname}}</h1>
					<br>
                    <div class="border-top border-bottom border-light">
					    <h3 class="text-white mt-2">{{count($event) > 0 ? Carbon\Carbon::parse($event[0]->startdate)->format('D, d M Y') : 'Tanggal dan Tempat acara akan tampil di sini.' }}</h3>
                    </div>
					<br>
					@if($is_has_guest)<h3 class="text-white"><strong>{{$guest_name}}</strong></h3>@endif
					<p style="color: #cfcfcf;">{{$is_has_guest ? "We invited you to celebrate our wedding" : "Let's celebrate our wedding"}}</p>
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


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('assets/template/wedding/metro/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('assets/template/wedding/metro/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('assets/template/wedding/metro/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/template/wedding/metro/lib/isotope/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/template/wedding/metro/lib/lightbox/js/lightbox.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('assets/template/wedding/metro/js/main.js')}}"></script>

    @include('invitation.wedding.script')

    <script>
        "use strict";

		$(document).on('ready', function() {
			//
		});

		$('#btn-open').click(function() {
			player.load("{{asset('assets/file/musik/'.$music->path)}}");
			$('.invitation-cover').fadeOut();
            $('div#invitation-main-content').fadeIn();
            $('#btn-show-wishes-item').click();
			$('#preview-alert').fadeIn();
		});

		function generate_greeting_item_html(name, date, text) {
            var customDate = dateTimeCustomFormat('d MMM yyyy hh:mm', date);
            return '<blockquote class="bg-secondary" style="padding:14px;border-radius:14px;">'
            + '<span class="float-right" style="font-size:12px;">' + customDate + '</span>'
            + '<strong style="font-size:20px;">' + name + '</strong><br>'
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

        $('a.nav-item').on('click', function() {
            if ($(this).attr('href') == '#') {
                swal('Maaf, Anda bukan Tamu terdaftar.');
            } else {
                $('button.navbar-toggler').click();
            }
        });
	</script>
</body>

</html>