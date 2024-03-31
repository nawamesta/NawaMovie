@extends('layouts')

@php
    $this_episode = isset($episode_info) ? $episode_info->episode_number : false;
    $season = $season ?? $tv->number_of_seasons;
@endphp

@section('content')
    <div id="watch">
        @include('components.player', ['backdrop' => $backdrop, 'video' => asset('/movie.mp4')])

        <div class="container py-4">
            <div class="row">
                <div class="col d-flex justify-content-center">
                    <a href="{{ route('loading', ['id' => $tv->id ,'title' => $tv->original_name, 'action' => 'play']) }}" class="btn btn-outline-info mx-1">{{ __('utilities.watch_now') }} <i class="fa fa-film" aria-hidden="true"></i></a>
                    <a href="{{ route('loading', ['id' => $tv->id ,'title' => $tv->original_name, 'action' => 'register']) }}" class="btn btn-outline-info mx-1">{{ __('utilities.download') }} <i class="fa fa-cloud-download" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>

        <div class="container">
            <div id="episodes">
                <div class="bl-seasons">
                    <div class="heading">{{ __('utilities.season') }}</div>
                    <ul class="seasons">
                        @foreach (collect($tv->seasons)->sortKeysDesc()->all() as $item)
                            @if ($item->season_number == $season)
                                <li class="active">
                                    {{ __('utilities.season') }} {{ $item->season_number }} <span>{{ $item->air_date }}
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('tv.single.season', ['id' => $tv->id, 'season' => $item->season_number, 'slug' => Str::slug($tv->original_name)]) }}">{{ __('utilities.season') }} {{ $item->season_number }} <span>{{ $item->air_date }}</span></a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>

                <div class="bl-servers">
                    <div class="heading">
                        <span><i class="fa fa-hdd-o"></i> {{ __('utilities.episode') }}</span>
                    </div>
                    <ul class="episodes">
                        @foreach ($season_select as $item)
                            <li><a class="{{ $item->episode_number == $this_episode ? 'active' : '' }}" href="{{ route('tv.single.season.episode', ['id'=>$tv->id, 'season' => $season, 'episode'=>$item->episode_number, 'slug' => Str::slug($tv->original_name.' '.$item->name) ]) }}" title="{{ $item->name }}">
                                {{ __('utilities.episode') }} {{$item->episode_number }}: <span>{{ $item->name }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="watch-extra">
                <section class="info">
                    <div class="poster"> <span><img itemprop="image" src="{{ img_poster($tv->poster_path) }}" alt="{{ $title }} {{ to_year($tv->last_air_date) }}"></span> </div>
                    <div class="info">
                        <h1 itemprop="name" class="title">{{ $title }}</h1>
                        <div class="meta lg"> <span class="quality">HD</span> <span class="imdb"><i class="fa fa-star"></i> {{ $tv->vote_average }}</span> <span>{{ $tv->episode_run_time[0] }} {{ __('utilities.minutes') }}</span> </div>
                        <div itemprop="description" class="desc shorting" data-type="text">{{ $tv->overview }}</div>
                        <div class="meta">
                            <div> <span>{{ __('utilities.genre') }}:</span> <span>{{ collect($tv->genres)->implode('name', ', ') }}</span> </div>
                            <div> <span>{{ __('utilities.released') }}:</span> <span>{{ $tv->last_air_date }}</span> </div>
                            <div><span>{{ __('utilities.director') }}:</span> <span>{!! director_comma($tv->credits->crew, 5) !!}</span> </div>
                            <div class="casts"> <span>{{ __('utilities.stars') }}:</span> <span>{!! star_comma($tv->credits->cast, 5) !!}</span> </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </section>
            </div>

            <div class="clearfix"></div>

            @if ($tv->similar)
                <section class="bl">
                    <div class="heading simple"> <h2 class="title">{{ __('section.title.similar') }}</h2> </div>
                    <div class="content">
                        <div class="filmlist">
                            @foreach (collect($tv->similar->results)->take(16) as $item)
                                @include('components.item-tv')
                            @endforeach
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </section>
            @endif

            @if ($tv->recommendations)
                <section class="bl">
                    <div class="heading simple"> <h2 class="title">{{ __('section.title.recommendation') }}</h2> </div>
                    <div class="content">
                        <div class="filmlist">
                            @foreach (collect($tv->recommendations->results)->take(16) as $item)
                                @include('components.item-tv')
                            @endforeach
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </section>
                <div class="clearfix"></div>
            @endif

            <div class="clearfix"></div>
        </div>
    </div>

    @include('components.modal_watch', ['backdrop' => $backdrop, 'id' => $tv->id, 'title' => $tv->original_name])
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