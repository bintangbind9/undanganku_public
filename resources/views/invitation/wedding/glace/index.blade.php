<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('invitation.wedding.link')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/template/wedding/glace/css/theme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/template/wedding/glace/css/all.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Caveat|Quicksand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
      .swiper-slide .greeting-content {
        display: block;
        width: 100%;
        background-color: rgb(226, 226, 226);
        border-radius: 20px;
        padding: 30px;
      }
    </style>
  </head>
  <body>
  @if ($is_preview)
    @include('invitation.wedding.preview_alert')
  @endif

    <header class="header text-center" style="background-image: url({{empty($wedding->photo_sampul) ? asset('assets/template/wedding/glace/images/hero.jpeg') : asset('assets/img/wedding/photo/sampul/'.$wedding->photo_sampul)}});">
      <h1 class="heading">
        {{empty($groom->nickname) ? 'Pria' : $groom->nickname}} &amp; {{empty($bride->nickname) ? 'Wanitanya' : $bride->nickname}}
        <span class="heading-subtext">are getting married!</span>
      </h1>
    </header>
    <section class="section">
      @if ($is_preview)
        @include('invitation.wedding.preview_alert')
      @endif
      <div class="text-center">
        <h2 class="sub-heading">Hello!</h2>
        <h3>{{count($event) > 0 ? Carbon\Carbon::parse($event[0]->startdate)->format('D, d M Y') . ' - ' . $event[0]->place : 'Tanggal dan Tempat acara akan tampil di sini.' }}</h3>
        <p>We invited you to celebrate our wedding</p>
      </div>
      <div class="row text-center">
        <div class="col-md-6">
          <img src="{{empty($groom->photo) ? asset('assets/template/wedding/glace/images/groom.jpg') : asset('assets/img/wedding/photo/bride/'.$groom->photo)}}" alt="groom" class="img-couple">
          <h3>{{empty($groom->name) ? 'Pengantin Pria' : $groom->name }}</h3>
          @if (!empty($groom->mother) && !empty($groom->father))
            <p>{{ $groom->gender == Constant::CODE_MALE ? 'Putra' : 'Putri' }} dari Bapak <strong>{{$groom->father}}</strong>, dan Ibu <strong>{{$groom->mother}}</strong>.</p>
          @endif
          @if (!empty($groom->about))
            <p>{{ $groom->about }}</p>
          @endif
        </div>
        <div class="col-md-6">
          <img src="{{empty($bride->photo) ? asset('assets/template/wedding/glace/images/bride.jpg') : asset('assets/img/wedding/photo/bride/'.$bride->photo)}}" alt="bride" class="img-couple">
          <h3>{{empty($bride->name) ? 'Pengantin Wanita' : $bride->name }}</h3>
          @if (!empty($bride->mother) && !empty($bride->father))
            <p>{{ $bride->gender == Constant::CODE_MALE ? 'Putra' : 'Putri' }} dari Bapak <strong>{{$bride->father}}</strong>, dan Ibu <strong>{{$bride->mother}}</strong>.</p>
          @endif
          @if (!empty($bride->about))
            <p>{{ $bride->about }}</p>
          @endif
        </div>
      </div>
    </section>
    <section class="section text-center">
      @if ($is_preview)
        @include('invitation.wedding.preview_alert')
      @endif
      <h2 class="sub-heading mb-4">About The Weddings</h2>
      <hr class="mb-4">
      <div class="details">
        <i class="fas fa-calendar"></i>
        <h3 class="details-heading mb-4">When</h3>
        @if (count($event) > 0)
          <div class="row">
            @foreach ($event as $event_no => $evn)
              <div class="{{count($event) == 1 ? 'col-md-12' : 'col-md-6'}} mt-4">
                <b><h3>{{empty($evn->name) ? $evn->event_type->name : $evn->name}}</h3></b>
                <p><i class="fas fa-clock" style="font-size:16px;"></i> {{Carbon\Carbon::parse($evn->startdate)->format('H:i T')}} - {{Carbon\Carbon::parse($evn->enddate)->format('H:i T')}}</p>
                @if (Carbon\Carbon::parse($evn->startdate)->format('d-M-Y') == Carbon\Carbon::parse($evn->enddate)->format('d-M-Y'))
                  <p><i class="fas fa-calendar-check" style="font-size:16px;"></i> {{Carbon\Carbon::parse($evn->startdate)->format('D, d M Y')}}</p>
                @else
                  <p><i class="fas fa-calendar-check" style="font-size:16px;"></i> {{Carbon\Carbon::parse($evn->startdate)->format('D, d M Y')}} - {{Carbon\Carbon::parse($evn->enddate)->format('D, d M Y')}}</p>
                @endif
                {{--<a title="Add to Calendar" rel="noopener" href="#" target="_blank" rel="nofollow">Add to Calendar</a>--}}
              </div>
            @endforeach
          </div>
        @else
          <p>No events</p>
        @endif
      </div>
      @if (count($event) > 0)
        <div class="details">
          <i class="fas fa-map-marked-alt"></i>
          <h3 class="details-heading mb-4">Location</h3>
          <div class="row">
            @foreach ($event as $event_no => $evn)
              <div class="{{count($event) == 1 ? 'col-md-12' : 'col-md-6'}} mt-4">
                <b><h3>{{empty($evn->name) ? $evn->event_type->name : $evn->name}}</h3></b>
                <p><i class="fas fa-map-marker-alt" style="font-size:16px;"></i> {{$evn->place}}</p>
                <p>{{$evn->address}}</p>
                @if ($gmaps_rule_value)
                  <div>{!! $evn->map !!}</div>
                @endif
                {{--<img class="resort-image" src="{{asset('assets/template/wedding/glace/images/resort.jpeg')}}" alt="Resort" />--}}
              </div>
            @endforeach
          </div>
        </div>
      @endif
      <div class="details" id="story" style="display:none;">
        <i class="fas fa-feather"></i>
        <h3 class="details-heading mb-4">Story</h3>
        <div class="row">
          <div class="col-md-12">
            @if (count($story) > 0)
              <div class="timeline-wrapper">
                <div class="timeline">
                  @foreach($story as $story_no => $str)
                    <div class="timeline-container {{$story_no % 2 > 0 ? 'timeline-container-right' : 'timeline-container-left' }}">
                      <div class="timeline-content">
                        <span class="float-right font-italic">{{Carbon\Carbon::parse($str->date)->format('d M Y')}}</span>
                        <h5 class="text-left">{{$str->title}}</h5>
                        <q>{{$str->desc}}</q>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            @else
              <p>No Story</p>
            @endif
          </div>
        </div>
      </div>
      <div class="details" id="gallery" style="display:none;">
        <i class="fas fa-images"></i>
        <h3 class="details-heading mb-4">Gallery</h3>
        <div class="row">
          <div class="col-md-12">
            @if (count($gallery) > 0)
              <!-- Slider main container -->
              <div class="swiper swiper-gallery">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                  <!-- Slides -->
                  @foreach ($gallery as $gallery_no => $glr)
                    <div class="swiper-slide">
                      <img src="{{asset('assets/img/wedding/photo/gallery/'.$glr->photo)}}" title="{{$glr->name}}">
                    </div>
                  @endforeach
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>
              </div>
            @else
              <p>No Gallery</p>
            @endif
          </div>
        </div>
      </div>
      <div class="details" id="wishes" style="display:none;">
        <i class="fas fa-comments"></i>
        <h3 class="details-heading mb-4">Friends Wishes</h3>
        @if($is_has_guest)
					<button id="btn-create-greeting" class="btn btn-dark mb-4">Buat ucapan Kamu</button>
				@endif
        <div class="row">
          <div class="col-md-12">
            @if (count($greeting) > 0)
							<div class="swiper swiper-greeting">
								<div class="swiper-wrapper">
									@foreach ($greeting as $greeting_no => $grt)
										<div class="swiper-slide">
                      <div class="greeting-content">
                        <h3>{{$grt->guest->name}}</h3>
                        <span>{{Carbon\Carbon::parse($grt->date)->format('d M Y H:i')}}</span>
                        <blockquote>
                          <p>"{{$grt->greeting}}"</p>
                        </blockquote>
                      </div>
										</div>
									@endforeach
								</div>
                <div class="swiper-greeting-pagination mb-2"></div>
                <span id="btn-load-greeting" style="cursor:pointer;">Lihat semua <i class="fas fa-external-link-alt" style="font-size: 16px;"></i></span>
							</div>
						@else
              <p>No Wishes</p>
						@endif
          </div>
        </div>
      </div>
      @if ($is_has_guest)
        <div class="details">
          <i class="fas fa-users"></i>
          <h3 class="details-heading mb-4" id="rsvp">Are You Attending?</h3>
          <div class="row mb-4">
            <div class="col-md-12">
              <p>Silakan isi formulir di bawah untuk memberi tahu {{empty($groom->nickname) ? 'Pengantin Pria' : $groom->nickname}} dan {{empty($bride->nickname) ? 'Pengantin Wanita' : $bride->nickname}} bahwa Anda akan hadir. <i id="info-batal-atau-abaikan">{{$guest->status == Constant::TRUE_CONDITION ? "Klik 'Batalkan'" : 'Abaikan ini'}}</i> jika Anda tidak berkenan hadir. Terima kasih.</p>
              <div class="row">
                <div class="{{$guest->status == Constant::TRUE_CONDITION ? 'col-12 col-sm-4 col-md-4 col-lg-4' : 'col-12 col-sm-12 col-md-12 col-lg-12'}} div-info-status-hadir"><p>Status kehadiran: <span id="info-status-hadir" class="badge badge-dark">{{$guest->status == Constant::TRUE_CONDITION ? 'Hadir' : 'Tidak Hadir'}}</span></p></div>
                <div class="col-12 col-sm-4 col-md-4 col-lg-4 info-jumlah-tamu-dan-tombol-batalkan" @if ($guest->status == Constant::FALSE_CONDITION) style="display:none;" @endif><p>Tamu yang akan hadir: <span id="info-jumlah-hadir" class="badge badge-dark">{{$guest->presence}}</span></p></div>
                <div class="col-12 col-sm-4 col-md-4 col-lg-4 info-jumlah-tamu-dan-tombol-batalkan" @if ($guest->status == Constant::FALSE_CONDITION) style="display:none;" @endif><span class="btn btn-outline-dark btn-update-presence" data-type="CANCEL">Batalkan</span></div>
              </div>
            </div>
          </div>
          <div class="row mb-4">
            <div class="col-md-4 col-sm-4">
							<div class="form-group">
								<label for="name" class="sr-only">Name</label>
								<input type="text" class="form-control" id="guest_name" name="name" placeholder="Name" value="{{$guest_name}}" disabled>
							</div>
						</div>
						<div class="col-md-4 col-sm-4">
							<div class="form-group">
								<label for="presence" class="sr-only">Berapa yang hadir?</label>
								<input type="number" class="form-control" id="guest_presence" name="presence" placeholder="Berapa yang hadir?" min="{{Constant::MIN_PRESENCE_OF_EACH_GUEST}}" max="{{Constant::MAX_PRESENCE_OF_EACH_GUEST}}">
							</div>
						</div>
						<div class="col-md-4 col-sm-4">
							<button type="submit" class="btn btn-dark btn-block btn-update-presence" data-type="UPDATE">{{$guest->status == Constant::TRUE_CONDITION ? 'Update kehadiran' : 'Saya akan datang'}}</button>
						</div>
          </div>
          <div class="row">
				    <div class="col-md-12">
					    <div>{!!$guest_qr_code!!}</div>
					    <p>Show me to reception to confirm your presence</p>
				    </div>
			    </div>
        </div>
      @endif
    </section>
    <footer>
      <small class="block">&copy; {{Carbon\Carbon::now()->format('Y')}} <a href="/" target="_blank">{{config('app.name')}}</a>. All Rights Reserved.</small>
    </footer>

    <a data-scroll class="fixed-button" href="#" id="toTopButton" style="display:none;">
      <span>
        <i class="fas fa-chevron-up text-white"></i>
      </span>
    </a>

    <div class="music-console" style="cursor:pointer;">
      <span id="music-rotate" class="rotate" style="animation-play-state:paused;"><img src="{{asset('assets/template/wedding/glace/images/icon-music.png')}}" width="100%"></span>
      <div id="player" style="display:none;"></div>
    </div>

    <div class="invitation-cover" style="background-image:url({{empty($wedding->photo_sampul) ? asset('assets/template/wedding/glace/images/hero.jpeg') : asset('assets/img/wedding/photo/sampul/'.$wedding->photo_sampul)}});">
      <div class="invitation-cover-content" style="background-image:url({{asset('assets/template/wedding/glace/images/img_bg_1.jpg')}});">
        <div class="row">
          <div class="invitation-cover-heading">
            <h3>The Wedding of</h3>
            <h2>{{empty($groom->nickname) ? 'Pria' : $groom->nickname}} &amp; {{empty($bride->nickname) ? 'Wanitanya' : $bride->nickname}}</h2>
            <br>
            <h3>{{count($event) > 0 ? Carbon\Carbon::parse($event[0]->startdate)->format('D, d M Y') : 'Tanggal dan Tempat acara akan tampil di sini.' }}</h3>
            <br>
            @if($is_has_guest)<u><strong><h3>{{$guest_name}}</h3></strong></u>@endif
            <p>{{$is_has_guest ? "We invited you to celebrate our wedding" : "Let's celebrate our wedding"}}</p>
            <br><br>
            <input type="button" id="btn-open" class="btn btn-dark" value="Open Invitation">
          </div>
        </div>
      </div>
    </div>

    @if($is_has_guest)
      @include('invitation.wedding.create_greeting_modal')
    @endif

    @include('invitation.wedding.load_greeting_modal')

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="{{asset('assets/template/wedding/glace/js/smooth-scroll.polyfills.min.js')}}"></script>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

    @include('invitation.wedding.script')

    <script defer>
      var scroll = new SmoothScroll('a[href*="#"]');
      var toTopButton = document.getElementById('toTopButton')
      // When the user scrolls down 20px from the top of the document, show the button
      window.onscroll = function() {scrollFunction()};

      function scrollFunction() {
        if (document.body.scrollTop > 400 || document.documentElement.scrollTop > 400) {
          toTopButton.style.display = "block";
        } else {
          toTopButton.style.display = "none";
        }
      }

      $('#btn-open').click(function() {
        player.load("{{asset('assets/file/musik/'.$music->path)}}");
        // $('.fixed-button').css('display','block');
        $('#story').css('display','block');
        $('#gallery').css('display','block');
        $('#wishes').css('display','block');
        $('.invitation-cover').fadeOut();
        $('#preview-alert.alert.alert-warning').fadeIn();

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

        const swiper_greeting = new Swiper('.swiper-greeting', {
          // Optional parameters
          // effect: 'slide',
          grabCursor: true,
          autoHeight: true,
          centeredSlides: true,
          centeredSlidesBounds: true,
          loop: true,
          spaceBetween: 30,
          pagination: {
              el: '.swiper-greeting-pagination',
              clickable: true,
          },
        });
      });

      function generate_greeting_item_html(name, date, text) {
        var customDate = dateTimeCustomFormat('d MMM yyyy hh:mm', date);
        return '<blockquote class="bg-light" style="padding:14px;border-radius:14px;">'
        + '<span class="float-right" style="font-size:12px;"><i class="fas fa-calendar" style="font-size:12px;"></i> ' + customDate + '</span>'
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
    </script>
  </body>
</html>