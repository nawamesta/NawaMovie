@extends('layouts')

@section('content')
    @include('components.big-slider')
    <div class="container">
        <section class="bl">
            <div class="heading">
                <h2>{{ __('menu.movies') }}</h2>
                <div class="tabs">
                    <span class="active">
                        <i class="fa fa-play-circle"></i>
                        {{ __('section.title.popular') }}</span>
                    <span><a href="{{ route('movie.now.playing') }}">{{ __('menu.now_playing') }}</a></span>
                    <span><a href="{{ route('movie.top.rated') }}">{{ __('menu.top_rated') }}</a></span>
                    <span><a href="{{ route('movie.upcoming') }}">{{ __('menu.upcoming') }}</a></span>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="content tab-content" data-name="movies">
                <div class="filmlist">
                    @foreach (collect(getMovies('popular')->results)->take(16) as $item)
                        @include('components.item-movie')
                    @endforeach
                    <div class="clearfix"></div>
                </div>
            </div>
        </section>

        <section class="bl">
            <div class="heading">
                <h2>{{ __('menu.tv_shows') }}</h2>
                <div class="tabs">
                    <span class="active">
                        <i class="fa fa-play-circle"></i>
                        Movies</span>
                    <span><a href="{{ route('tv.top.rated') }}">{{ __('menu.top_rated') }}</a></span>
                    <span><a href="{{ route('tv.on.the.air') }}">{{ __('menu.on_tv') }}</a></span>
                    <span><a href="{{ route('tv.airing.to.day') }}">{{ __('menu.airing_today') }}</a></span>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="content tab-content" data-name="movies">
                <div class="filmlist">
                    @foreach (collect(getTvShows('popular')->results)->take(16) as $item)
                        @include('components.item-tv')
                    @endforeach
                    <div class="clearfix"></div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('footer')
<script>
    new Swiper('.swiper-container', {
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        autoplay: {
            delay: 5000,
        },
    })
</script>
@endsection