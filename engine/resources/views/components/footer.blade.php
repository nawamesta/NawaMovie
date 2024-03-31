<footer>
    <div class="top">
        <div class="container">
            <div class="about">
                <div>
                    <div class="logo" style="background-image: url({{ asset('logo.png') }})"></div>
                    <div class="desc text-center text-md-left">
                        <p>{{ __('section.title.home_2') }}</p>
                    </div>
                </div>
            </div>
            <div class="links">
                <div class="bl">
                    <div class="heading">{{ __('menu.movies') }}</div>
                    <ul>
                        <li><a href="{{ route('movie.popular') }}" title="{{ __('menu.popular') }}">{{ __('menu.popular') }}</a></li>
                        <li><a href="{{ route('movie.now.playing') }}" title="{{ __('menu.now_playing') }}">{{ __('menu.now_playing') }}</a></li>
                        <li><a href="{{ route('movie.top.rated') }}" title="{{ __('menu.top_rated') }}">{{ __('menu.top_rated') }}</a></li>
                        <li><a href="{{ route('movie.upcoming') }}" title="{{ __('menu.upcoming') }}">{{ __('menu.upcoming') }}</a></li>
                    </ul>
                </div>
                <div class="bl">
                    <div class="heading">{{ __('menu.tv_shows') }}</div>
                    <ul>
                        <li><a href="{{ route('tv.popular') }}" title="{{ __('menu.popular') }}">{{ __('menu.popular') }}</a></li>
                        <li><a href="{{ route('tv.top.rated') }}" title="{{ __('menu.top_rated') }}">{{ __('menu.top_rated') }}</a></li>
                        <li><a href="{{ route('tv.on.the.air') }}" title="{{ __('menu.on_tv') }}">{{ __('menu.on_tv') }}</a></li>
                        <li><a href="{{ route('tv.airing.to.day') }}" title="{{ __('menu.airing_today') }}">{{ __('menu.airing_today') }}</a></li>
                    </ul>
                </div>
                <div class="bl">
                    <div class="heading">Page</div>
                    <ul>
                        <li>
                            <a href="{{ route('page', 'contact') }}" title="Contact">Contact</a>
                        </li>
                        <li>
                            <a href="{{ route('page', 'copyright') }}" title="Copyright">Copyright</a>
                        </li>
                        <li>
                            <a href="{{ route('page', 'dmca') }}" title="DMCA">DMCA</a>
                        </li>
                        <li>
                            <a href="{{ route('page', 'privacy-policy') }}" title="Privacy Policy">PrivacyPolicy</a>
                        </li>
                        {{-- @foreach ($pages as $page)
                        @endforeach --}}
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</footer>