<div class="item">
    <div class="icons">
        <div class="quality">HD</div>
    </div>
    <a href="{{ route('tv.single',['id' => $item->id, 'slug' => Str::slug($item->original_name)]) }}" title="{{ $item->name }}" class="poster">
        <img src="{{ img_poster($item->poster_path) }}">
    </a>
    <h3>
        <a class="title" title="{{ $item->name }}" href="{{ route('tv.single',['id' => $item->id, 'slug' => Str::slug($item->original_name)]) }}">{{ $item->name }}</a>
    </h3>
    <div class="meta">
        {{ to_year($item->first_air_date ?? '') }}
        <i class="type">Tv</i>
    </div>
</div>