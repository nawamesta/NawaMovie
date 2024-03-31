<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach (getSupportLanguages() as $lang => $locale)
        <sitemap>
            <loc>{{ URL::to('/'). '/' .$lang. '/sitemap/movie/popular' }}</loc>
            <lastmod>{{ date('Y-m-d') }}</lastmod>
        </sitemap>
        <sitemap>
            <loc>{{ URL::to('/'). '/' .$lang. '/sitemap/movie/top-rated' }}</loc>
            <lastmod>{{ date('Y-m-d') }}</lastmod>
        </sitemap>
        <sitemap>
            <loc>{{ URL::to('/'). '/' .$lang. '/sitemap/movie/upcoming' }}</loc>
            <lastmod>{{ date('Y-m-d') }}</lastmod>
        </sitemap>
        <sitemap>
            <loc>{{ URL::to('/'). '/' .$lang. '/sitemap/movie/now-playing' }}</loc>
            <lastmod>{{ date('Y-m-d') }}</lastmod>
        </sitemap>

        <sitemap>
            <loc>{{ URL::to('/'). '/' .$lang. '/sitemap/tv/popular' }}</loc>
            <lastmod>{{ date('Y-m-d') }}</lastmod>
        </sitemap>
        <sitemap>
            <loc>{{ URL::to('/'). '/' .$lang. '/sitemap/tv/top-rated' }}</loc>
            <lastmod>{{ date('Y-m-d') }}</lastmod>
        </sitemap>
        <sitemap>
            <loc>{{ URL::to('/'). '/' .$lang. '/sitemap/tv/on-tv' }}</loc>
            <lastmod>{{ date('Y-m-d') }}</lastmod>
        </sitemap>
        <sitemap>
            <loc>{{ URL::to('/'). '/' .$lang. '/sitemap/tv/airing-today' }}</loc>
            <lastmod>{{ date('Y-m-d') }}</lastmod>
        </sitemap>
    @endforeach
</sitemapindex>
