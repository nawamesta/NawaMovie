<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
    @foreach ($items as $item)
        <url>
            <loc>{{ route('tv.single',['id' => $item->id, 'slug' => Str::slug($item->original_name)]) }}</loc>
            <lastmod>{{ $item->first_air_date }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>
