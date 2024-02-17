<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="copyright" content="MACode ID, https://macodeid.com">

  <meta property="og:image" content="https://undanganajib.com/assets/lp/img/logo-3.png">
  <meta property="og:image:width" content="300" />
  <meta property="og:image:height" content="300" />

  <title>{{config('app.name')}}</title>

  <link rel="stylesheet" href="{{asset('assets/lp/vendor/animate/animate.css')}}">

  <link rel="stylesheet" href="{{asset('assets/lp/css/bootstrap.css')}}">

  <link rel="stylesheet" href="{{asset('assets/lp/css/maicons.css')}}">

  <link rel="stylesheet" href="{{asset('assets/lp/vendor/owl-carousel/css/owl.carousel.css')}}">

  <link rel="stylesheet" href="{{asset('assets/lp/css/theme.css')}}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans&family=Josefin+Sans:ital,wght@1,300&family=Merriweather+Sans:ital,wght@0,300;0,400;1,300&family=Mukta:wght@300;700&display=swap" rel="stylesheet">
  <style>
    .shadow-image {
      box-shadow: 6px 6px 13px -9px rgba(103,119,239,1);
      -webkit-box-shadow: 6px 6px 13px -9px rgba(103,119,239,1);
      -moz-box-shadow: 6px 6px 13px -9px rgba(103,119,239,1);
    }
    .case-study-page .case-study-card {
      -webkit-transition: 0.4s;
      transition: 0.4s;
      border-bottom-left-radius: 8px;
      border-bottom-right-radius: 8px;
    }
    .case-study-page .case-study-card .card-img {
      border-top-left-radius: 8px;
      border-top-right-radius: 8px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
      overflow: hidden;
      position: relative;
    }
    .case-study-page .case-study-card .card-img > img {
      width: 100%;
    }
    @media (min-width: 576px) {
      .case-study-page .case-study-card .card-img > img {
        width: auto;
      }
    }
    .case-study-page .case-study-card .card-img .brand-img {
      position: absolute;
      bottom: 15px;
      left: 15px;
      background: #fe8f8a;
      padding: 5px 20px;
      color: #fff;
      border-radius: 5px;
    }
    .case-study-page .case-study-card .card-content {
      padding-top: 20px;
      padding-bottom: 20px;
      padding-left: 35px;
      padding-right: 35px;
      border-left: 1px solid #eae9f2;
      border-right: 1px solid #eae9f2;
      border-bottom: 1px solid #eae9f2;
      background-color: #fff;
      border-bottom-left-radius: 8px;
      border-bottom-right-radius: 8px;
    }
    .case-study-page .case-study-card .card-content .title {
      color: #19191b;
      font-size: 21px;
      font-weight: 700;
      letter-spacing: -0.66px;
      margin-bottom: 13px;
    }
    .case-study-page .case-study-card .card-content p {
      color: #767581;
      font-size: 16px;
      font-weight: 300;
      letter-spacing: -0.5px;
      line-height: 26px;
    }
    /* .page-section{
      background-color: #f6f8fd;
    } */
    .zoom-in {
      -ms-transition: transform .4s;
      -webkit-transition: transform .4s;
      -moz-transition: transform .4s;
      transition: transform .4s;
      /* margin: 0 auto; */
    }
    .zoom-in-container:hover .zoom-in {
      -ms-transform: scale(1.18); /* IE 9 */
      -webkit-transform: scale(1.18); /* Safari 3-8 */
      -moz-transform: scale(1.18);
      transform: scale(1.18);
    }
    .highlight {
      -ms-transform: scale(1.1); /* IE 9 */
      -webkit-transform: scale(1.1); /* Safari 3-8 */
      -moz-transform: scale(1.1);
      transform: scale(1.1);
    }
    body {
      font-family: 'DM Sans', sans-serif;
      font-family: 'Josefin Sans', sans-serif;
      font-family: 'Merriweather Sans', sans-serif;
      font-family: 'Mukta', sans-serif;
    }
  </style>
</head>
<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>

  <header>
    <nav class="navbar navbar-expand-lg navbar-light fix-top" id="home">
      <div class="container">
        <a href="#" class="navbar-brand"><img src="{{asset('assets/lp/img/logo-3.png')}}" width="200px"></a>

        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="navbarContent">
          <ul class="navbar-nav ml-lg-4 pt-3 pt-lg-0 mr-4">
            <li class="nav-item active">
              <a href="#" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
              <a href="#fitur" class="nav-link">Fitur</a>
            </li>
            <li class="nav-item">
              <a href="#tema" class="nav-link">Tema</a>
            </li>
            <li class="nav-item">
              <a href="#paket" class="nav-link">Paket</a>
            </li>
          </ul>

          <div class="ml-auto">
            @if (Route::has('login'))
              @auth
                <a href="{{ route('dashboard') }}" class="btn btn-primary rounded-pill">Dashboard</a>
              @else
                <a href="{{ route('login') }}" class="btn btn-outline-primary rounded-pill mr-2">Masuk</a>
                @if (Route::has('register'))
                  <a href="{{ route('register') }}" class="btn btn-primary rounded-pill">Daftar</a>
                @endif
              @endauth
            @endif
          </div>
        </div>
      </div>
    </nav>

    <div class="page-banner home-banner" style="margin-bottom:0px">
      <div class="container h-100">
        <div class="row align-items-center h-100">
          <div class="col-lg-6 py-3 wow fadeInUp">
            <h1 class="mb-4 text-dark"><b>Website Undangan Online</b></h1>
            <p class="text-lg mb-5">
              Undang orang-orang terdekat dalam setiap momen kebahagiaan Anda dengan cara yang simpel dan menarik mewujudkan impian Anda bersama <b><span class="text-primary">{{config('app.name')}}</span></b>
            </p>
            <a href="{{route('register')}}" class="btn btn-primary rounded-pill text-white">Buat Undangan</a>
          </div>
          <div class="col-lg-6 py-3 wow zoomIn">
            <div class="img-place">
              {{-- <img src="{{asset('assets/lp/img/image-2.png')}}" alt=""> --}}
              <img src="{{asset('assets/lp/img/poster_mobile/poster_mobile_3.png')}}">
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <main>
    <div class="page-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-3 col-lg-3 py-3 wow fadeInUp">
            <h3 class="text-dark"><b>Kenapa Harus Punya Website Undangan?</b></h3>
          </div>
          <div class="col-md-3 col-lg-3 py-3 wow fadeInUp">
            <div class="d-flex flex-row">
              <div class="img-fluid mr-3">
                <img src="{{asset('assets/lp/img/icon_gif/icon_info.gif')}}" alt="" width="100%">
              </div>
              <div>
                <h5>Unik & Kekinian</h5>
                <p>Di era serba digital seperti saat ini, website undangan bisa menjadi pilihan undangan yang unik dan menarik namun tetap fungsional.</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-lg-3 py-3 wow fadeInUp">
            <div class="d-flex flex-row">
              <div class="img-fluid mr-3">
                <img src="{{asset('assets/lp/img/icon_gif/icon_info.gif')}}" alt="" width="100%">
              </div>
              <div>
                <h5>Info & Fitur Lengkap</h5>
                <p>Semua informasi ditampilkan dalam undangan dengan fitur peta lokasi, galeri pre-wedding, countdown timer, hingga cerita cinta Anda.</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-lg-3 py-3 wow fadeInUp">
            <div class="d-flex flex-row">
              <div class="img-fluid mr-3">
                <img src="{{asset('assets/lp/img/icon_gif/icon_info.gif')}}" alt="" width="100%">
              </div>
              <div>
                <h5>Mudah dibagikan</h5>
                <p>Dengan adanya website undangan, Anda dapat dengan mudah membagikannya kepada keluarga dan semua teman Anda.</p>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- .container -->
    </div> <!-- .page-section -->

    <div class="page-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 py-3 wow zoomIn">
            <div class="img-place text-center">
              <img src="{{asset('assets/lp/img/bg_image_2.png')}}" alt="">
            </div>
          </div>
          <div class="col-lg-6 py-3 wow fadeInRight">
            <h2 class="title-section text-dark">Alasan Memilih <span class="marked">{{config('app.name')}}</span></h2>
            <div class="divider"></div>
            <p>Kami hadir sebagai layanan untuk membuat website undangan online mulai dari 0 Rupiah.</p>
            <div class="img-place mb-3">
              {{-- <img src="{{asset('assets/lp/img/bg_image_2.png')}}" alt=""> --}}
              <div class="card mb-2">
                <div class="card-body text-justify ">
                  <h5 class="">Fitur lengkap, mudah dan murah.</h5>
                  <hr>
                  <p class="sub-title">Hanya perlu waktu 5 menit untuk membuat website undangan
                    online menggunakan <span class="text-primary">{{config('app.name')}}</span> dengan segala fiturnya. Kamu bisa mencobanya secara gratis dan
                    undangan Kamu akan langsung aktif.
                  </p>
                  <a href="{{route('register')}}" class="btn btn-primary rounded-pill text-white">Coba Sekarang</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- .container -->
    </div> <!-- .page-section -->

    <div class="page-section" style="background-color:white">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="content">
              <div class="img-1" data-aos="fade-down" data-aos-duration="400" data-aos-once="true">
                {{-- <img src="{{asset('assets/lp/img/content-img1-mobile.webp')}}" alt="Website undangan pernikahan"> --}}
                <img src="{{asset('assets/lp/img/poster_mobile/tablet-2.png')}}" width="80%" alt="Website undangan pernikahan">
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <h2 class="title text-dark">Dapatkan Alamat Website Idamanmu</h2>
            <p>
              Periksa ketersediaan alamat website undangan idamanmu bersama pasangan. Amankan segera sebelum dipesan pasangan lain!
            </p>
            <form class="form-inline check-subdomain mt-5" action="{{route('register')}}">
              <div class="input-group mb-3 w-100">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon3">
                    <i class="d-none d-md-block d-lg-block d-xl-block">{{route('invitation.index',[strtolower(Constant::CODE_WEDDING),''])}}/</i>
                  </span>
                </div>
                <input type="text" class="form-control" name="user_url" id="user_url" placeholder="akudia" aria-label="akudia" aria-describedby="basic-addon3" required>
              </div>
              <div class="domain-validation" style="display:none;color:red;margin-bottom:10px;width:100%;" role="alert">
                <strong>Alamat sudah digunakan!</strong>
              </div>
              <br>
              <button type=submit class="btn btn-primary rounded-pill col-md-12">Buat Undangan</button>
            </form>
          </div>
        </div>
      </div> <!-- .container -->
    </div> <!-- .page-section -->

    <!-- fitur -->
    <div id="fitur" class="page-section" style="background-color:white">
      <div class="container">
        <div class="text-center wow fadeInUp">
          {{-- <div class="subhead">Why Choose Us</div> --}}
          <h2 class="title-section text-dark">Fitur <span class="marked">Terbaik</span></h2>
          <div class="divider mx-auto"></div>
        </div>
        <div class="row mt-5 text-center">
          <div class="col-lg-4 py-3 wow fadeInUp">
            <div><img src="{{asset('assets/lp/img/icon_gif/refresh.gif')}}" width="15%"></div>
            <h5>Tema yang sangat dinamis & responsive</h5>
            <p>Terdapat berbagai macam pilihan tema dengan desain yang cantik, elegan, dinamis, dan responsive. Juga mudah diterapkan kapanpun Kamu mau</p>
          </div>
          <div class="col-lg-4 py-3 wow fadeInUp">
            <div><img src="{{asset('assets/lp/img/icon_gif/no-credit-cards.gif')}}" width="15%"></div>
            <h5>Mulai dari gratis</h5>
            <p>Kamu bisa memulai dengan <b>0 Rupiah</b></p>
          </div>
          <div class="col-lg-4 py-3 wow fadeInUp">
            <div><img src="{{asset('assets/lp/img/icon_gif/whatsapp.gif')}}" width="15%"></div>
            <h5>Kirim undangan dengan Whatsapp</h5>
            <p>Kirim undangan Kamu dengan sekali klik dan terintegrasi dengan Whatsapp</p>
          </div>
          {{--
            <div class="col-lg-4 py-3 wow fadeInUp">
              <div><img src="{{asset('assets/lp/img/icon_gif/mobile_message_gif.gif')}}" width="15%"></div>
              <h5>Dapatkan pemberitahuan</h5>
              <p>Dapatkan pemberitahuan kapanpun melalui email Kamu</p>
            </div>
          --}}
          <div class="col-lg-4 py-3 wow fadeInUp">
            <div><img src="{{asset('assets/lp/img/icon_gif/qr-code.gif')}}" width="15%"></div>
            <h5>Input data kehadiran tamu dengan cepat</h5>
            <p>Dengan QR-Code, input data kehadiran tamu menjadi lebih cepat tanpa input manual</p>
          </div>
          <div class="col-lg-4 py-3 wow fadeInUp">
            <div><img src="{{asset('assets/lp/img/icon_gif/welcome_screen.gif')}}" width="15%"></div>
            <h5>Welcome Screen</h5>
            <p>Ucapkan "Selamat Datang" kepada tamu-tamu Kamu saat mereka datang</p>
          </div>
          <div class="col-lg-4 py-3 wow fadeInUp">
            <div><img src="{{asset('assets/lp/img/icon_gif/musik_gif.gif')}}" width="15%"></div>
            <h5>Background lagu yang dinamis</h5>
            <p>Pilih background lagu yang manapun sesuai selera Kamu</p>
          </div>
        </div>
      </div> <!-- .container -->
    </div> <!-- .page-section -->

    <div class="page-section" style="background-color:white">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 py-3 wow fadeInLeft">
            <h2 class="title-section text-dark">4 Langkah Mudah Menggunakan <span class="marked">{{config('app.name')}}</span></h2>
            <div class="divider"></div>
            <p class="mb-4">Cukup lakukan 4 langkah ini untuk membuat website undangan pernikahanmu sendiri. Wujudkan undangan pernikahan impian Kamu bersama {{config('app.name')}}. Untuk lebih jelasnya silakan ikuti petunjuk dalam video tutorial di bawah ini</p>
            <a href="{{Constant::LINK_HOW_TO_USE_APP}}" target="_blank" class="btn btn-primary btn-split ml-2">Tonton Tutorial <div class="fab"><span class="mai-play"></span></div></a>
          </div>
          <div class="col-lg-6 py-3 wow zoomIn">
            <div class="img-place text-center">
              <img src="{{asset('assets/lp/img/bg_image_3.png')}}" alt="">
            </div>
          </div>
        </div>
      </div> <!-- .container -->
    </div> <!-- .page-section -->

    <div id="tema" class="page-section border-top">
      <div class="container">
        <div class="text-center wow fadeInUp">
          <h2 class="title-section text-dark">Pilihan Tema <span class="marked">Eksklusif</span></h2>
          <p>Temukan tema undangan unik dan menarik di {{config('app.name')}}. Berbagai pilihan desain undangan yang eksklusif ada di sini.</p>
          <div class="divider mx-auto"></div>
        </div>
        <div class="row my-5 row">
          @foreach ($template as $template_row)
            <div class="col-md-6 col-lg-4 py-4 wow fadeInUp">
              {{-- <div class="card">
                <div class="card-img">
                  <img src="{{asset('assets/img/wedding/template/'.$template_row->photo)}}" width="348px" height="348px">
                </div>
                <!-- <div class="post-excerpt"><h5>Exclusive</h5>.</div> -->
                <div class="footer">
                  <a href="blog-single.html" class="btn btn-sm btn-primary">Lihat Tema</a>
                </div>
              </div> --}}
              <a href="{{route('invitation.preview', ['template_category_name' => strtolower($template_row->template_category->name), 'user_url' => Constant::EXAMPLE_USER_URL, 'template_id' => $template_row->id])}}" target="_blank">
                <div class="card border-light zoom-in-container">
                  <div style="padding:18px;">
                    <img class="card-img-top zoom-in shadow-image" style="border-radius:8px;" src="{{asset('assets/img/wedding/template/'.$template_row->photo)}}" width="200px" height="200px" alt="Card image cap">
                  </div>
                  <div class="card-body text-center">
                    <h5 class="text-primary"><b>{{$template_row->name}}</b></h5>
                    {{-- <button class="btn btn-primary btn-sm rounded-pill">Preview</button> --}}
                    <h5></h5>
                  </div>
                </div>
              </a>
            </div>
          @endforeach
        </div>
        {{-- <div class="text-center">
          <a href="blog.html" class="btn btn-outline-primary rounded-pill">Tema Lainnya</a>
        </div> --}}
      </div> <!-- .container -->
    </div> <!-- .page-section -->

    @if(count($feedbacks) > 0)
      <div class="page-section"style="background-color: #f6f8fd">
        <div class="container">
          <div class="text-center wow fadeInUp">
            <div class="subhead"><h1>Mereka Yang Percaya Dengan Kami</h1></div>
            <div class="divider mx-auto"></div>
          </div>
          <div class="owl-carousel wow fadeInUp" id="testimonials">
            @foreach($feedbacks as $fb_no => $fb)
              <div class="item">
                <div class="row align-items-center">
                  <div class="col-md-6 py-3">
                    <div class="testi-image">
                      <img src="{{asset('assets/img/avatar/'.(empty($fb->user->photo) ? 'avatar-1.png' : $fb->user->photo))}}" alt="">
                    </div>
                  </div>
                  <div class="col-md-6 py-3">
                    <div class="testi-content">
                      <p>{{$fb->ulasan}}</p>
                      <div class="entry-footer">
                        <strong>{{$fb->user->name}}</strong> &mdash; <span class="text-grey">{{$fb->user->email}}</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div> <!-- .container -->
      </div> <!-- .page-section -->
    @endif

    @if (count($invoice_types) > 0)
      <div id="paket" class="page-section border-top">
        <div class="container">
          <div class="text-center wow fadeInUp">
            <h2 class="title-section text-dark">Pilihan Paket <span class="marked">Terjangkau!</span></h2>
            <div class="divider mx-auto"></div>
          </div>
          <div class="row justify-content-center">
            @foreach ($invoice_types as $it_no => $it)
              <div class="col-12 col-lg-auto py-3 wow {{ $it_no % 3 == 0 ? 'fadeInLeft' : ($it_no % 3 == 1 ? 'fadeInUp' : 'fadeInRight') }}">
                <div class="card-pricing {{$it->highlight == Constant::TRUE_CONDITION ? 'highlight' : null}}">
                  <div class="header">
                    @if ($it->highlight == Constant::TRUE_CONDITION) <div class="price-labled">Best</div> @endif
                    <div class="price-icon mb-4"><img style="height:100px;" src="{{asset('assets/img/levels/'.$it->invoice_level->image)}}" alt="{{$it->invoice_level->name}}"></div>
                    {{--<div class="price-icon"><span class="mai-people"></span></div>--}}
                    {{--<div class="price-icon"><span class="mai-business"></span></div>--}}
                    {{--<div class="price-icon"><span class="mai-rocket-outline"></span></div>--}}
                    <div class="price-title">{{$it->name}}</div>
                  </div>
                  <div class="body py-3">
                    <div class="price-tag">
                      @if ($it->amount > 0) <span class="currency">IDR</span> @endif
                      <h2 class="display-4">{{$it->amount == 0 ? 'Gratis!' : number_format($it->amount/1000, 0, ',', '.').'K'}}</h2>
                      <span class="period">/{{$it->expired_day}} hari</span>
                    </div>
                    <div class="price-info">
                      @foreach ($rules as $no_rule => $r)
                        @foreach ($r->rule_value as $no_rule_value => $rv)
                          @if ($rv->invoice_type_id == $it->id)
                            <p><i class="{{ $rv->value == '0' ? 'mai-remove-circle text-danger' : 'mai-checkmark-circle text-success' }}"></i> @if ($rv->value == '0') {{$r->name}} @else <strong>{{$r->name}}</strong> @endif {{$r->countable == 'Y' ? '(' . ($rv->value == Constant::CODE_UNLIMITED ? "unlimited" : $rv->value) . ')' : null }}</p>
                          @endif
                        @endforeach
                      @endforeach
                    </div>
                  </div>
                  <div class="footer">
                    <a href="{{route('subscribe.index.package_id',$it->id)}}" class="btn btn-outline-primary rounded-pill">{{$it->amount == 0 ? 'Cobain' : 'Pesan'}}</a>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div> <!-- .container -->
      </div> <!-- .page-section -->
    @endif

    {{-- STATIC BANK ACCOUNT --}}
    {{--
    <div class="page-section client-section">
      <div class="container-fluid">
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 justify-content-center">
          <div class="item wow zoomIn">
            <img src="{{asset('assets/lp/img/logo-bank/bca.png')}}" alt="" width="50%">
          </div>
          <div class="item wow zoomIn">
            <img src="{{asset('assets/lp/img/logo-bank/permata-bank.png')}}" alt="" width="100%">
          </div>
        </div>
      </div> <!-- .container-fluid -->
    </div> <!-- .page-section -->
    --}}

    {{-- DYNAMIC BANK ACCOUNT --}}
    @if (count($banks) > 0)
      <div class="page-section client-section">
        <div class="container-fluid">
          <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 justify-content-center">
            @foreach ($banks as $bank_no => $bank)
              <div class="item wow zoomIn">
                <img src="{{asset('assets/img/banks/'.$bank->bank_master->image)}}" alt="{{$bank->bank_master->code}}" width="60%">
              </div>
            @endforeach
          </div>
        </div> <!-- .container-fluid -->
      </div> <!-- .page-section -->
    @endif
  </main>

  <footer class="page-footer" style="background-color: white;">
    <div class="container">
      <div class="row justify-content-center mb-5">
        <div class="col-lg-3 py-3">
          <h4><span class="text-primary">{{config('app.name')}}</span></h4>
          <p>Layanan membuat website undangan online semudah bermain media sosial</p>
          <a href="mailto:{{Constant::DEFAULT_ADMIN_EMAIL}}">{{Constant::DEFAULT_ADMIN_EMAIL}}</a>
          @foreach (Constant::DEFAULT_ADMIN_PHONES as $phone_no => $phone)
            <a href="tel:{{$phone}}" style="display:block;">{{$phone}}</a>
          @endforeach
        </div>
        <div class="col-lg-3 py-3">
          <h5>Informasi</h5>
          <ul class="footer-menu">
            <li><a href="{{ route('login') }}">Masuk</a></li>
            <li><a href="#" data-toggle="modal" data-target="#tnc">Syarat dan Ketentuan</a></li>
            <li><a href="{{ route('register') }}">Daftar</a></li>
          </ul>
        </div>
        <div class="col-lg-3 py-3">
          <h5>Utama</h5>
          <ul class="footer-menu">
            <li><a href="#home">Beranda</a></li>
            <li><a href="#fitur">Fitur</a></li>
            <li><a href="#tema">Tema</a></li>
            <li><a href="#paket">Paket</a></li>
          </ul>
        </div>
        <div class="col-lg-3 py-3">
          <h5>Sosial Media</h5>
          <div class="sosmed-button mt-4">
            <a href="https://www.instagram.com/undanganajib" target="_blank"><span class="mai-logo-instagram"></span></a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6 py-2">
          <p id="copyright">&copy; <script>document.write(new Date().getFullYear());</script> <a href="#">{{config('app.name')}}</a>. All rights reserved.</p>
        </div>
      </div>
    </div> <!-- .container -->
  </footer> <!-- .page-footer -->

  <div class="modal fade" id="tnc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Syarat dan Ketentuan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {!! Constant::TNC_HTML_CONTENT !!}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">OK</button>
        </div>
      </div>
    </div>
  </div>

  <script src="{{asset('assets/lp/js/jquery-3.5.1.min.js')}}"></script>

  <script src="{{asset('assets/lp/js/bootstrap.bundle.min.js')}}"></script>

  <script src="{{asset('assets/lp/vendor/wow/wow.min.js')}}"></script>

  <script src="{{asset('assets/lp/vendor/owl-carousel/js/owl.carousel.min.js')}}"></script>

  <script src="{{asset('assets/lp/vendor/waypoints/jquery.waypoints.min.js')}}"></script>

  <script src="{{asset('assets/lp/vendor/animateNumber/jquery.animateNumber.min.js')}}"></script>

  <script src="{{asset('assets/lp/js/google-maps.js')}}"></script>

  <script src="{{asset('assets/lp/js/theme.js')}}"></script>

  <script>
    $(document).ready(function() {
      // Add smooth scrolling to all links
      $("a").on('click', function(event) {

        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
          // Prevent default anchor click behavior
          event.preventDefault();

          // Store hash
          var hash = this.hash;

          // Using jQuery's animate() method to add smooth page scroll
          // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
          $('html, body').animate({
            scrollTop: $(hash).offset().top
          }, 800, function() {

            // Add hash (#) to URL when done scrolling (default click behavior)
            window.location.hash = hash;
          });
        } // End if
      });
    });

    $('.nav-link').click(function () {
      $('.navbar-toggler').addClass('collapsed');
      $('.navbar-toggler').attr('aria-expanded','false');
      $('#navbarContent').removeClass('show');
    });
  </script>
</body>
</html>
