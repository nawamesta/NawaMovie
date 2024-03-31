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

use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class Sitemaps extends Controller
{
    public function index()
    {
        return response()->view('sitemaps.index')->header('Content-Type', 'text/xml');
    }

    public function moviePopular()
    {
        $items = $this->getMovieTv('popular', 'movie');

        return response()->view('sitemaps.movie', compact('items'))->header('Content-Type', 'text/xml');
    }

    public function movieTopRated()
    {
        $items = $this->getMovieTv('top_rated', 'movie');
        return response()->view('sitemaps.movie', compact('items'))->header('Content-Type', 'text/xml');
    }

    public function movieUpcoming()
    {
        $items = $this->getMovieTv('upcoming', 'movie');
        return response()->view('sitemaps.movie', compact('items'))->header('Content-Type', 'text/xml');
    }

    public function movieNowPlaying()
    {
        $items = $this->getMovieTv('now_playing', 'movie');
        return response()->view('sitemaps.movie', compact('items'))->header('Content-Type', 'text/xml');
    }

    public function tvPopular()
    {
        $items = $this->getMovieTv('popular', 'tv');
        return response()->view('sitemaps.tv', compact('items'))->header('Content-Type', 'text/xml');
    }

    public function tvTopRated()
    {
        $items = $this->getMovieTv('top_rated', 'tv');
        return response()->view('sitemaps.tv', compact('items'))->header('Content-Type', 'text/xml');
    }

    public function tvOnTheAir()
    {
        $items = $this->getMovieTv('on_the_air', 'tv');
        return response()->view('sitemaps.tv', compact('items'))->header('Content-Type', 'text/xml');
    }

    public function tvAiringToday()
    {
        $items = $this->getMovieTv('airing_today', 'tv');
        return response()->view('sitemaps.tv', compact('items'))->header('Content-Type', 'text/xml');
    }

    private function getMovieTv($action, $type)
    {
        $movies = [];

        for ($i=1; $i <= conf('max_limit_page_sitemap'); $i++) {
            $movies[] = $type == 'movie' ? getMovies($action, $i) : getTvShows($action, $i);
        }

        $datas = [];

        foreach ($movies as $data) {
            $datas[] = $data->results;
        }

        return Arr::collapse($datas);
    }
}
