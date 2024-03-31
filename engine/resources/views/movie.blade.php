@extends('layouts')

@section('content')
    <div id="watch">
        @include('components.player', ['backdrop' => $backdrop, 'video' => asset('/movie.mp4')])

        <div class="container py-4">
            <div class="row">
                <div class="col d-flex justify-content-center">
                    <a href="{{ route('loading', ['id' => $movie->id ,'title' => $movie->original_title, 'action' => 'play']) }}" class="btn btn-outline-info mx-1">Watch Now <i class="fa fa-film" aria-hidden="true"></i></a>
                    <a href="{{ route('loading', ['id' => $movie->id ,'title' => $movie->original_title, 'action' => 'register']) }}" class="btn btn-outline-info mx-1">Download <i class="fa fa-cloud-download" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>

        <div style="height: 6em"></div>
        <div class="container">
            <div class="watch-extra">
                <section class="info">
                    <div class="poster"> <span><img itemprop="image" src="{{ img_poster($movie->poster_path) }}" alt="{{ $movie->title }} {{ to_year($movie->release_date) }}"></span> </div>
                    <div class="info">
                        <h1 itemprop="name" class="title">{{ $movie->title }}</h1>
                        <div class="meta lg"> <span class="quality">HD</span> <span class="imdb"><i class="fa fa-star"></i> {{ $movie->vote_average }}</span> <span>{{ $movie->runtime }} {{ __('utilities.minutes') }}</span> </div>
                        <div itemprop="description" class="desc shorting" data-type="text">{{ $movie->overview }}</div>
                        <div class="meta">
                            <div> <span>{{ __('utilities.genre') }}:</span> <span>{!! genre_comma($movie->genres) !!}</span> </div>
                            <div> <span>{{ __('utilities.released') }}:</span> <span>{{ $movie->release_date }}</span> </div>
                            <div><span>{{ __('utilities.director') }}:</span> <span>{!! director_comma($movie->credits->crew, 5) !!}</span> </div>
                            <div class="casts"> <span>{{ __('utilities.stars') }}:</span> <span>{!! star_comma($movie->credits->cast, 5) !!}</span> </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </section>
            </div>

            @if ($movie->similar)
                <section class="bl">
                    <div class="heading simple"> <h2 class="title">{{ __('section.title.movie_similar') }}</h2> </div>
                    <div class="content">
                        <div class="filmlist">
                            @foreach (collect($movie->similar->results)->take(16) as $item)
                                @include('components.item-movie')
                            @endforeach
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </section>
            @endif

            @if ($movie->recommendations)
                <section class="bl">
                    <div class="heading simple"> <h2 class="title">{{ __('section.title.movie_recommendation') }}</h2> </div>
                    <div class="content">
                        <div class="filmlist">
                            @foreach (collect($movie->recommendations->results)->take(16) as $item)
                                @include('components.item-movie')
                            @endforeach
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </section>
                <div class="clearfix"></div>
            @endif
        </div>
    </div>

    @include('components.modal_watch', ['backdrop' => $backdrop, 'id' => $movie->id, 'title' => $movie->original_title])
@endsection

@section('header')
    <link href="https://vjs.zencdn.net/7.10.2/video-js.css" rel="stylesheet" />
    <style>
        .video-js .vjs-big-play-button {
            line-height: 2.5em;
            height: 2.8em;
            width: 2.8em;
            border: .15em solid #00acc1;
            background-color: #1c242c;
            background-color: rgba(28,36,44,.7);
            border-radius: 50%;
        }
        .vjs-big-play-centered .vjs-big-play-button {
            margin-top: -1.4em;
            margin-left: -1.4em;
        }
        .vjs-icon-play:before, .video-js .vjs-play-control .vjs-icon-placeholder:before, .video-js .vjs-big-play-button .vjs-icon-placeholder:before {
            color: #00acc1;
        }
    </style>
@endsection

@section('footer')
    <script src="https://vjs.zencdn.net/7.10.2/video.min.js"></script>
    <script>
        var playDuration = 129*60;
        var myPlayer = videojs('play-video', {
            controlBar: {
                'pictureInPictureToggle': false
            }
        });
        var pausetime = 15;
        myPlayer.on('timeupdate', function(e) {
            if (myPlayer.currentTime() >= pausetime) {
                myPlayer.pause();
                $('#pop-login').modal({show: true, backdrop: 'static'});

                if (myPlayer.isFullscreen()) {
                    myPlayer.exitFullscreen();
                }
            }
        });
        myPlayer.paused();

        if ( $(".ep-item").length ) {
            $(".ep-item").on('click', function() {
                myPlayer.currentTime(0);
                myPlayer.play();
            });
        }
    </script>
@endsection