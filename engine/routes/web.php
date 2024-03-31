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

use App\Http\Controllers\Frontend;
use App\Http\Controllers\Sitemaps;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeCookieRedirect', 'localizationRedirect' ]], function() {
	Route::get('/', [Frontend::class, 'home'])->name('home');

    Route::name('movie.')->group(function () {
        Route::get('movie-popular', [Frontend::class, 'moviePopular'])->name('popular');
        Route::get('movie-now-playing', [Frontend::class, 'movieNowPlaying'])->name('now.playing');
        Route::get('movie-top-rated', [Frontend::class, 'movieTopRated'])->name('top.rated');
        Route::get('movie-upcoming', [Frontend::class, 'movieUpcoming'])->name('upcoming');
        Route::prefix('movie')->group(function () {
            Route::get('/', [Frontend::class, 'movieNowPlaying']);
            Route::get('/{id}/{slug?}', [Frontend::class, 'singleMovie'])->name('single');
        });
    });

    Route::name('tv.')->group(function () {
        Route::get('tv-popular', [Frontend::class, 'tvPopular'])->name('popular');
        Route::get('tv-top-rated', [Frontend::class, 'tvTopRated'])->name('top.rated');
        Route::get('tv-airing-to-day', [Frontend::class, 'tvAiringToday'])->name('airing.to.day');
        Route::get('tv-on-the-air', [Frontend::class, 'tvOnTheAir'])->name('on.the.air');
        Route::prefix('tv')->group(function () {
            Route::get('/', [Frontend::class, 'tvAiringToday'])->name('tv');
            Route::get('/{id}-{season}-{episode}/{slug?}', [Frontend::class, 'singleTVSeasonEpisode'])->where([
                    'id' => '[0-9]+',
                    'season' => '[0-9]+',
                    'episode' => '[0-9]+'
                ])->name('single.season.episode');
            Route::get('/{id}-{season}/{slug?}', [Frontend::class, 'singleTVSeason'])->where([
                'id' => '[0-9]+',
                'season' => '[0-9]+'
                ])->name('single.season');
            Route::get('/{id}/{slug?}', [Frontend::class, 'singleTv'])->where('id', '[tt0-9]+')->name('single');
        });
    });

    Route::prefix('person')->name('people.')->group( function () {
        Route::get('/{id}', [Frontend::class, 'people'])->where(['id' => '[0-9]+'])->name('single');
        Route::get('/popular', [Frontend::class, 'peoplePopular'])->name('popular');
    });

    //search
    Route::get('/search/{keyword}', [Frontend::class, 'search'])->name('search');

    // Genres
    Route::get('/genre/{id}/{slug?}', [Frontend::class, 'genre'])->where(['id' => '[0-9]+'])->name('genre');

    //Keyword
    Route::get('/keyword/{id}/{slug?}', [Frontend::class, 'keyword'])->where(['id' => '[0-9]+'])->name('keyword');

    // Pages
    Route::get('page/{page}', [Frontend::class, 'pages'])->name('page');

    // Loading
    Route::get('loading', [Frontend::class, 'loading'])->name('loading');

    // Sitemaps
    Route::group(['prefix' => 'sitemap'], function () {
        Route::get('/', [Sitemaps::class, 'index'])->name('sitemap');

        Route::group(['prefix' => 'movie'], function () {
            Route::get('/', [Sitemaps::class, 'index']);
            Route::get('popular', [Sitemaps::class, 'moviePopular']);
            Route::get('top-rated', [Sitemaps::class, 'movieTopRated']);
            Route::get('upcoming', [Sitemaps::class, 'movieUpcoming']);
            Route::get('now-playing', [Sitemaps::class, 'movieNowPlaying']);
        });

        Route::group(['prefix' => 'tv'], function () {
            Route::get('/', [Sitemaps::class, 'index']);
            Route::get('popular', [Sitemaps::class, 'tvPopular']);
            Route::get('top-rated', [Sitemaps::class, 'tvTopRated']);
            Route::get('on-tv', [Sitemaps::class, 'tvOnTheAir']);
            Route::get('airing-today', [Sitemaps::class, 'tvAiringToday']);
        });
    });
});

Route::get('clear', [Frontend::class, 'clearCache']);
