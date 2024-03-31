<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="//fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/css/swiper.min.css">
    <link rel="stylesheet" href="{{ asset('assets/all.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    {!! SEO::generate() !!}
    @include('head')

    @yield('header')
    <style>
        a,
        section.bl .heading .title,
        section.bl .heading h1,
        section.bl .heading h2,
        section.bl .heading h3,
        #slider .item .info .actions .watchnow,
        .btn-outline-info,
        .filmlist .item:hover .title,
        .vjs-icon-play:before,
        .video-js .vjs-play-control .vjs-icon-placeholder:before,
        .video-js .vjs-big-play-button .vjs-icon-placeholder:before,
        header #menu>li>a:hover,
        header #menu>li>ul>li>a:hover,
        .page-link:hover,
        #episodes .bl-servers .heading,
        #episodes .bl-seasons .heading {
            color: {{ conf('theme.primary-color')}}
        }
        a:hover{
            opacity: .7;
            color: {{ conf('theme.primary-color')}}
        }
        .filmlist .item .poster:before {
            background-color: {{ conf('theme.primary-color') }};
            background-image: -webkit-gradient(linear,left top,left bottom,from({{ conf('theme.primary-color') }}),to({{ conf('theme.primary-color') }}));
            background-image: -webkit-linear-gradient(top,{{ conf('theme.primary-color') }},{{ conf('theme.primary-color') }});
        }
        #slider .paging>span.active,
        #slider .paging>span.swiper-pagination-bullet-active,
        #slider .item .info .actions .watchnow:hover,
        .btn-outline-info:hover,
        .btn-outline-info:not(:disabled):not(.disabled).active,
        .btn-outline-info:not(:disabled):not(.disabled):active,
        .show>.btn-outline-info.dropdown-toggle,
        #slider .item .info .meta .quality,
        .watch-extra section.info .info .meta .quality,
        section.bl .heading .tabs>span.active,
        .filmlist .item .icons>div.quality,
        #episodes .bl-seasons ul li.active,
        #episodes .bl-servers ul.episodes li a.active {
            background-color: {{ conf('theme.primary-color') }}
        }
        section.bl .heading .tabs>span.active {
            color: {{ conf('theme.button-tab-text-color')}}
        }
        #slider .item .info .actions .watchnow,
        .btn-outline-info:hover,
        .btn-outline-info:not(:disabled):not(.disabled).active,
        .show>.btn-outline-info.dropdown-toggle,
        .btn-outline-info,
        .video-js .vjs-big-play-button,
        .page-link,
        #episodes .bl-seasons ul li.active,
        #episodes .bl-servers ul.episodes li a.active {
            border-color: {{ conf('theme.primary-color') }}
        }
        .btn-outline-info.focus,
        .btn-outline-info:not(:disabled):not(.disabled).active:focus,
        .btn-outline-info:not(:disabled):not(.disabled):active:focus,
        .show>.btn-outline-info.dropdown-toggle:focus,
        .btn-outline-info:focus {
            box-shadow: 0 0 0 0.2rem {{ conf('theme.primary-color') }}50;
        }
        .proof>* {
            background-color: {{ conf('theme.bg-fake') }}
        }
        .proof .proof-data {
            color: {{ conf('theme.color-fake')}}
        }
    </style>
  </head>
  <body>
    @include('components.navbar')

    <div id="body">
        @yield('content')
    </div>

    @include('components.footer')

    <script>
      @php
          $popular_movie = collect(getMovies('popular')->results)->shuffle()->pluck('title')->toJson();
      @endphp
      var movies = {!! $popular_movie !!}
    </script>

    <script src="//code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/js/swiper.min.js"></script>
    <script src="{{ asset('assets/my.js') }}"></script>

    @yield('footer')

    @include('foot')
  </body>
</html>