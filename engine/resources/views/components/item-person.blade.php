<div class="item">
    <div class="icons">
    </div>
    <a href="{{ route('people.single', ['id' => $item->id]) }}" title="{{ $item->name }}" class="poster">
        <img src="{{ img_poster($item->profile_path) }}">
    </a>
    <h3>
        <a class="title" title="{{ $item->name }}" href="{{ route('people.single', ['id' => $item->id]) }}">{{ $item->name }}</a>
    </h3>
</div>