@if ($type == 'movie')
    @include('components.item-movie')
@elseif ($type == 'tv')
    @include('components.item-tv')
@else
    @include('components.item-person')
@endif