@extends('layouts')

@section('content')
    <div style="height: 6em"></div>
    <div class="container mt-5">
        <section class="bl">
            <div class="heading">
                <h1>{{ $title }}</h1>
            </div>
            <div class="clearfix"></div>
            <div class="content">
                <div class="filmlist">
                    @foreach ($data as $item)
                        @if ($type == 'tv')
                            @include('components.item-tv')
                        @elseif($type == 'people')
                            @include('components.item-person')
                        @else
                            @include('components.item-movie')
                        @endif
                    @endforeach
                    <div class="clearfix"></div>
                </div>
                <div class="pagenav"> {!! $data->links() !!} </div>
            </div>
        </section>
        <div class="clearfix"></div>
    </div>
@endsection