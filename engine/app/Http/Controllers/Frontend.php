<?php
/**
 * Movos = The php Script for Landing Page Movies and TV Series
 *
 * @author Mas Zee <facebook.com/mas.zee.9619>
 * @copyright 2022 Nanosia.com
 * @link https://Nanosia.com
 * @license Reselling is prohibited, or can only be used alone
 * @version 1.0.0
 */
namespace App\Http\Controllers;

use SEO;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Frontend extends Controller
{
    public function home(Request $request)
    {
        $this->getSEOMeta(
            __('seo.home_title'),
            __('seo.home_description')
        );

        if ($request->s != null) {
            $keyword = str_replace(' ', '-', $request->s);
            return redirect()->route('search', ['keyword' => $keyword]);
        }

        return view('home');
    }

    public function moviePopular(Request $request)
    {
        $page = $request->page ?? 1;

        $type = 'movie';
        $data = $this->paginator(getMovies('popular', $page), route('movie.popular'));

        $title = __('section.title.popular');

        $this->getSEOMeta(
            __('seo.movie_title', ['title' => Str::title($title)]),
            __('seo.movie_title', ['title' => Str::title($title)])
        );

        return view('archive', compact('data', 'title', 'type'));
    }

    public function movieNowPlaying(Request $request)
    {
        $page = $request->page ?? 1;

        $type = 'movie';
        $data = $this->paginator(getMovies('now_playing', $page), route('movie.now.playing'));

        $title = __('section.title.now_playing');

        $this->getSEOMeta(
            __('seo.movie_title', ['title' => Str::title($title)]),
            __('seo.movie_title', ['title' => Str::title($title)])
        );

        return view('archive', compact('data', 'title', 'type'));
    }

    public function movieTopRated(Request $request)
    {
        $page = $request->page ?? 1;

        $type = 'movie';
        $data = $this->paginator(getMovies('top_rated', $page), route('movie.top.rated'));

        $title = __('section.title.movie_top_rated');

        $this->getSEOMeta(
            __('seo.movie_title', ['title' => Str::title($title)]),
            __('seo.movie_title', ['title' => Str::title($title)])
        );

        return view('archive', compact('data', 'title', 'type'));
    }

    public function movieUpcoming(Request $request)
    {
        $page = $request->page ?? 1;

        $type = 'movie';
        $data = $this->paginator(getMovies('upcoming', $page), route('movie.upcoming'));

        $title = __('section.title.movie_upcoming');

        $this->getSEOMeta(
            __('seo.movie_title', ['title' => Str::title($title)]),
            __('seo.movie_title', ['title' => Str::title($title)])
        );

        return view('archive', compact('data', 'title', 'type'));
    }

    public function singleMovie($id, $slug = '')
    {
        $movie = getMovie($id);
        $backdrop = img_backdrop($this->randomBackdrop($movie));

        $this->getSEOMeta(
            __('seo.movie_title', ['title' => Str::title($movie->title)]),
            __('seo.movie_title', ['title' => Str::title($movie->title)]).' - '.$movie->overview,
            $backdrop,
            $this->getSeoKeywords($movie->keywords->keywords)
        );

        return view('movie', compact('movie', 'backdrop'));
    }

    public function tvPopular(Request $request)
    {
        $page = $request->page ?? 1;

        $type = 'tv';
        $data = $this->paginator(getTvShows('popular', $page), route('tv.popular'));

        $title = __('section.title.tv_popular');

        $this->getSEOMeta(
            __('seo.tv_title', ['title' => Str::title($title)]),
            __('seo.tv_title', ['title' => Str::title($title)])
        );

        return view('archive', compact('data', 'title', 'type'));
    }

    public function tvTopRated(Request $request)
    {
        $page = $request->page ?? 1;

        $type = 'tv';
        $data = $this->paginator(getTvShows('top_rated', $page), route('tv.top.rated'));

        $title = __('section.title.tv_top_rated');

        $this->getSEOMeta(
            __('seo.tv_title', ['title' => Str::title($title)]),
            __('seo.tv_title', ['title' => Str::title($title)])
        );

        return view('archive', compact('data', 'title', 'type'));
    }

    public function tvAiringToday(Request $request)
    {
        $page = $request->page ?? 1;

        $type = 'tv';
        $data = $this->paginator(getTvShows('airing_today', $page), route('tv.airing.to.day'));

        $title = __('section.title.tv_airing_today');

        $this->getSEOMeta(
            __('seo.tv_title', ['title' => Str::title($title)]),
            __('seo.tv_title', ['title' => Str::title($title)])
        );

        return view('archive', compact('data', 'title', 'type'));
    }

    public function tvOnTheAir(Request $request)
    {
        $page = $request->page ?? 1;

        $type = 'tv';
        $data = $this->paginator(getTvShows('on_the_air', $page), route('tv.on.the.air'));

        $title = __('section.title.tv_on_the_air');

        $this->getSEOMeta(
            __('seo.tv_title', ['title' => Str::title($title)]),
            __('seo.tv_title', ['title' => Str::title($title)])
        );

        return view('archive', compact('data', 'title', 'type'));
    }

    public function singleTVSeasonEpisode($id, $season, $episode, $slug = '')
    {
        $tv = getTvShow($id);
        $season_info = getTvSeason($id, $season);
        $season_select = $season_info->episodes;
        $episode_info = getTvSeasonEpisode($id, $season, $episode);

        $backdrop = $episode_info->still_path != null ? $episode_info->still_path : $this->randomBackdrop($tv);
        $backdrop = img_backdrop($backdrop);
        $title = "{$tv->name} {$season_info->name} {$episode_info->name}";

        $this->getSEOMeta(
            __('seo.tv_title', ['title' => Str::title($title)]),
            __('seo.tv_title', ['title' => Str::title($title)]).' - '.$tv->overview,
            $backdrop,
            $this->getSeoKeywords($tv->keywords->results)
        );

        return view('tv', compact('tv', 'backdrop', 'season', 'episode_info', 'season_select', 'title'));
    }

    public function singleTVSeason($id, $season, $slug = '')
    {
        $tv = getTvShow($id);
        $season_info = getTvSeason($id, $season);
        $season_select = $season_info->episodes;
        $backdrop = img_backdrop($this->randomBackdrop($tv));
        $title = $tv->name.' '.$season_info->name;

        $this->getSEOMeta(
            __('seo.tv_title', ['title' => Str::title($title)]),
            __('seo.tv_title', ['title' => Str::title($title)]).' - '.$tv->overview,
            $backdrop,
            $this->getSeoKeywords($tv->keywords->results)
        );

        return view('tv', compact('tv', 'backdrop', 'season', 'season_select', 'title'));
    }

    public function singleTv($id, $slug = '')
    {
        $tv = getTvShow($id);
        $season_info = getTvSeason($id, $tv->number_of_seasons);
        $season_select = $season_info->episodes;
        $backdrop = img_backdrop($this->randomBackdrop($tv));
        $title = $tv->name;

        $this->getSEOMeta(
            __('seo.tv_title', ['title' => Str::title($tv->name)]),
            __('seo.tv_title', ['title' => Str::title($tv->name)]).' - '.$tv->overview,
            $backdrop,
            $this->getSeoKeywords($tv->keywords->results)
        );

        return view('tv', compact('tv', 'backdrop', 'season_select', 'title'));
    }

    public function people($id)
    {
        $data = getPeople($id);
        $title = $data->name;

        $this->getSEOMeta(
            Str::title($title),
            Str::title($title)
        );

        return view('people', compact('data', 'title'));
    }

    public function peoplePopular(Request $request)
    {
        $page = $request->page ?? 1;
        $type = 'people';

        $data = $this->paginator(getPeoplePopular($page), route('people.popular'));
        $title = __('section.title.popular_people');

        $this->getSEOMeta(
            Str::title($title),
            Str::title($title)
        );

        return view('archive', compact('data', 'title', 'type'));
    }

    public function search($keyword, Request $request)
    {
        $page = $request->page ?? 1;
        $title = Str::title(str_replace('-', ' ', $keyword));

        $data = $this->paginator(getSearch($keyword, $page), route('search', ['keyword' => $keyword]));

        $this->getSEOMeta($title, $title);

        return view('search', compact('title', 'data'));
    }

    public function genre($id, $slug = '', Request $request)
    {
        $page = $request->page ?? 1;
        $type = 'movie';

        $data = $this->paginator(getMovieByGenre($id, $page), route('genre', ['id' => $id, 'slug' => $slug]));
        $title = Str::title( __('section.title.genre')).' "'.Str::title(str_replace('-', ' ', $slug)).'"';

        $this->getSEOMeta(
            Str::title($title),
            Str::title($title)
        );

        return view('archive', compact('data', 'title', 'type'));
    }

    public function keyword($id, $slug = '', Request $request)
    {

    }

    public function pages($page)
    {
        $this->getSEOMeta(
            Str::title($page),
            Str::title($page)
        );

        return view('page', ['page' => $page]);
    }

    public function loading(Request $request)
    {
        $title = isset($request->title) ? $request->title : '';
        $id = isset($request->id) ? $request->id : '';

        $country_code = get_country_code();
        $splitOffers = collect(conf('split_offer'));

        $offer = $splitOffers->filter(function ($value) use ($country_code) {
            return empty($value['code_country']);
        });

        if(! empty($country_code)) {
            $offer = $splitOffers->filter(function ($value) use ($country_code) {
                return in_array($country_code, $value['code_country']);
            });
        }

        if ( $offer->isEmpty() ) {
            $offer = $splitOffers->filter(function($value) {
                return empty($value['code_country']);
            });
        }

        $url_offer = $offer->first()['url_offer'];

        return view('loading', compact('url_offer'));
    }

    private function getSEOMeta($title, $description = '', $img = '', $keyword = [])
    {
        SEO::setTitle($title);
        SEO::setCanonical(URL::current());
        (empty($description))?:SEO::setDescription($description);
        (empty($img))?:SEO::addImages($img);
        (empty($keyword))?:\SEOMeta::addKeyword($keyword);

        $this->getHrefLang();
    }

    private function getHrefLang()
    {
        $hrefLang = [];

        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $value) {
            // $replaceLang = str_replace(request()->segment(1), $key, request()->path());
            if ($localeCode != LaravelLocalization::getCurrentLocale()) {
                $url = LaravelLocalization::getLocalizedURL($localeCode, null, [], true) ;
                $hrefLang[] = SEO::metatags()->addAlternateLanguage($localeCode, $url);
            }
        }

        return $hrefLang;
    }

    private function randomBackdrop($path)
    {
        if (! empty($path->images->backdrops)) {
            $path = Arr::random($path->images->backdrops);
            return $path->file_path;
        }

        return $path->backdrop_path;
    }

    private function getSeoKeywords($data = [])
    {
        $kwList = [];

        foreach ($data as $data) {
            $kwList[] = $data->name;
        }

        return $kwList;
    }

    private function paginator($results, $pathRoute)
    {
        $totalPage = $results->total_pages > 500 ? 500 : $results->total_pages;

        return new LengthAwarePaginator(
            $results->results,
            $totalPage*20,
            20,
            $results->page,
            [ 'path' => $pathRoute]
        );
    }

    public function clearCache()
    {
        try {
            Cache::flush();

            return "Success... Cache is clean";
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

    }
}
