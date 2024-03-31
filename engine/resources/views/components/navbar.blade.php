<header class="home">
    <div class="container">
        <div id="menu-toggler">
            <i class="fa fa-list-ul"></i>
        </div>
        <a href="{{ route('home') }}" id="logo" style="background-image: url({{ asset('logo.png') }})">
            <h2>Watch Movies Online Free</h2>
        </a>
        <ul id="menu">
            <li>
                <a>{{ __('menu.genres') }}</a>
                <ul class="genre">
                    @foreach (getGenreLists('movie') as $item)
                        <li>
                            <a title="{{ $item->name }}" href="{{ route('genre', ['id' => $item->id, 'slug' => Str::slug($item->name)]) }}">{{ $item->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
            <li>
                <a title="{{ __('menu.movies') }}">{{ __('menu.movies') }}</a>
                <ul class="movie">
                    <li><a href="{{ route('movie.popular') }}" title="{{ __('menu.popular') }}">{{ __('menu.popular') }}</a></li>
                    <li><a href="{{ route('movie.now.playing') }}" title="{{ __('menu.now_playing') }}">{{ __('menu.now_playing') }}</a></li>
                    <li><a href="{{ route('movie.top.rated') }}" title="{{ __('menu.top_rated') }}">{{ __('menu.top_rated') }}</a></li>
                    <li><a href="{{ route('movie.upcoming') }}" title="{{ __('menu.upcoming') }}">{{ __('menu.upcoming') }}</a></li>
                </ul>
            </li>
            <li>
                <a title="{{ __('menu.tv_shows') }}">{{ __('menu.tv_shows') }}</a>
                <ul class="movie">
                    <li><a href="{{ route('tv.popular') }}" title="{{ __('menu.popular') }}">{{ __('menu.popular') }}</a></li>
                    <li><a href="{{ route('tv.top.rated') }}" title="{{ __('menu.top_rated') }}">{{ __('menu.top_rated') }}</a></li>
                    <li><a href="{{ route('tv.on.the.air') }}" title="{{ __('menu.on_tv') }}">{{ __('menu.on_tv') }}</a></li>
                    <li><a href="{{ route('tv.airing.to.day') }}" title="{{ __('menu.airing_today') }}">{{ __('menu.airing_today') }}</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ route('people.popular') }}">{{ __('menu.popular_people') }}</a>
            </li>
            <li>
                <a><span><i class="fa fa-globe"></i></span></a>
                <ul class="country">
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li>
                        <a rel="alternate" hreflang="{{ $localeCode }}" title="{{ $properties['native'] }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{ $properties['native'] }}</a>
                    </li>
                    @endforeach
                </ul>
            </li>
        </ul>
        <div id="user">
            <a class="guest" href="{{ route('loading') }}" style="color: #bbb;">
                <i class="fa fa-user-circle"></i>
                <span>{{ __('utilities.register') }}</span>
            </a>
        </div>
        <div id="search-toggler">
            <i class="fa fa-search"></i>
        </div>
        <form id="search" autocomplete="off" action="{{ route('home') }}">
            <input
                type="text"
                name="s"
                placeholder="{{ __('menu.search') }}"
                autocomplete="off">
                <button></button>
                <div class="suggestions"></div>
            </form>
        </div>
    </header>