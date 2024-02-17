@extends('layouts.master_empty')
@section('title','Slideshow')
@push('pages-style')
<link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
<style>
    /* Hide Scrollbars But Keep Functionality */

    /* Hide scrollbar for Chrome, Safari and Opera */
    body::-webkit-scrollbar {
        display: none;
    }

    /* Hide scrollbar for IE, Edge and Firefox */
    body {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }

    /* END Hide Scrollbars But Keep Functionality */

    .swiper {
        width: 100%;
        height: 100%;
    }
    .swiper-item {
        width: 100%;
        height: 900px;
        margin: auto;
        background-position:center;
        background-repeat:no-repeat;
        background-size:cover;
    }
</style>
@endpush

@section('content')
    {{-- @include('layouts.alert') --}}

    @if (count($gallery) > 0)
        <!-- Slider main container -->
        <div class="swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                @foreach ($gallery as $gallery_no => $glr)
                    <div class="swiper-slide">
                        {{-- <img src="{{asset('assets/img/wedding/photo/gallery/'.$glr->photo)}}" title="{{$glr->name}}"> --}}
                        <div class="swiper-item" title="{{$glr->name}}" style="background-image:url({{asset('assets/img/wedding/photo/gallery/'.$glr->photo)}});"></div>
                    </div>
                @endforeach
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

            <!-- If we need scrollbar -->
            {{-- <div class="swiper-scrollbar"></div> --}}
        </div>
    @endif
@endsection

@section('modal')
@endsection

@push('page-script')
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script>
    $(document).ready(function() {
        setInterval(getGuestPresence, 10000);
    });

    function getGuestPresence () {
        $.ajax({
            url: "{{route('guest_presence.not_shown_first',$template_category_name)}}",
            type: 'get',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                if (data['success']) {
                    Swal.fire({
                        html:
                            `<h1 style="font-size: 5rem;">Selamat Datang</h1><br>` +
                            `<h5>Bapak/Ibu/Saudara/i:</h5>` +
                            `<h1 class="text-primary" style="font-size: 3.5rem;"><b>` + data['success'] + `</b></h1>`,
                        footer: `<p>by ` + `<a href="/" target="_blank">{{config('app.name')}}</a></p>`,
                        showConfirmButton: false,
                        timer: 5000,
                        timerProgressBar: true,
                        width: '80%',
                        imageUrl: `{{asset('assets/img/favicon.png')}}`,
                        imageWidth: '180px',
                        // imageHeight: '180px',
                        imageAlt: `{{config('app.name')}}`,
                    });
                } else if (data['info']) {
                    //
                } else {
                    //
                }
            },
            error: function (data) {
                console.log(data.responseText);
                // Swal.fire(data.responseText);
                // Swal.fire('Whoops Something went wrong!!\n\n' + data.responseText);
                // Swal.fire({ title: 'Whoops Something went wrong!!', icon: 'error' });
            }
        });
    }

    const swiper = new Swiper('.swiper', {
        // Optional parameters
        grabCursor: true,
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
        autoplay: {
            delay: 10000,
            disableOnInteraction: false,
        },
        autoHeight: true,
        centeredSlides: true,
        centeredSlidesBounds: true,
        speed: 5000,
        spaceBetween: 100,
        // direction: 'vertical',
        loop: true,
        // If we need pagination
        pagination: {
            el: '.swiper-pagination',
        },
        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        // And if we need scrollbar
        // scrollbar: {
        //     el: '.swiper-scrollbar',
        // },
    });
</script>
@endpush
