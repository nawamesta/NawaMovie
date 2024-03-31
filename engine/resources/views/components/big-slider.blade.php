<div id="slider" class="swiper-container">
    <div class="swiper-wrapper">
        @foreach (collect(getMovies('now_playing')->results)->take(10) as $item)
            <div class="item swiper-slide lazyload"
                style="background-image: url({{ img_backdrop($item->backdrop_path, 'original') }})">
                <div class="container">
                    <div class="info">
                        <h3 class="title">{{ $item->title }}</h3>
                        <div class="meta">
                            <span class="quality">HD</span>
                            <span class="imdb">
                                <i class="fa fa-star"></i>
                                {{ $item->vote_average }}</span>
                            <span>{{ to_year($item->release_date ?? '') }}</span>
                        </div>
                        <div class="desc">{{ $item->overview }}</div>
                        <div class="actions">
                            <a class="watchnow" href="{{ route('movie.single',['id' => $item->id, 'slug' => Str::slug($item->original_title)]) }}">
                                <i class="fa fa-play"></i>
                                {{ __('utilities.watch_now') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="paging swiper-pagination"></div>
</div>
