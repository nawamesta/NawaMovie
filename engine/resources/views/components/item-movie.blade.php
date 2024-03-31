<div class="item">
    <div class="icons">
        <div class="quality">HD</div>
    </div>
    <a href="{{ route('movie.single',['id' => $item->id, 'slug' => Str::slug($item->original_title)]) }}" title="{{ $item->title }}" class="poster">
        <img src="{{ img_poster($item->poster_path) }}">
    </a>
    <h3>
        <a class="title" title="{{ $item->title }}" href="{{ route('movie.single',['id' => $item->id, 'slug' => Str::slug($item->original_title)]) }}">{{ $item->title }}</a>
    </h3>
    <div class="meta">
        {{ to_year($item->release_date ?? '') }}
        <i class="type">Movie</i>
    </div>
</div>