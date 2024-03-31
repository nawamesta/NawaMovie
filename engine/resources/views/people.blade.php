@extends('layouts')

@section('content')
    <div style="height: 6em"></div>
    <div class="container mt-5">
        <div class="watch-extra">
            <section class="info">
                <div class="poster">
                    <span><img itemprop="image" src="{{ img_poster($data->profile_path) }}" alt="{{ $data->name }}"></span>
                </div>
                <div class="info">
                    <h1 itemprop="name" class="title">{{ $data->name }}</h1>
                    <div itemprop="description" class="desc shorting">{{ $data->biography }}</div>
                    <div class="meta">
                        <div><span>{{ __('utilities.know_for') }}:</span> <span>{{ $data->known_for_department }}</span></div>
                        <div><span>{{ __('utilities.birthday') }}:</span> <span>{{ $data->birthday }}</span></div>
                        <div><span>{{ __('utilities.place_of_birth') }}:</span> <span>{{ $data->place_of_birth }}</span></div>
                        <div class="casts"><span>{{ __('utilities.also_know_as') }}:</span> <span>{{ implode(", ", $data->also_known_as) }}</span></div>
                    </div>
                </div>
            </section>
        </div>

        @isset($data->movie_credits->cast)
        <section class="bl">
            <div class="heading simple"> <h2 class="title">{{ __('section.title.movie_list_of', ['name' => $data->name]) }}</h2> </div>
            <div class="content">
                <div class="filmlist">
                    @foreach ($data->movie_credits->cast as $item)
                        @include('components.item-movie')
                    @endforeach
                    <div class="clearfix"></div>
                </div>
            </div>
        </section>
        @endisset
    </div>
@endsection