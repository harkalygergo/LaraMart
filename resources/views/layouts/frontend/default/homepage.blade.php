@extends('layouts.frontend.default.base')

@section('main')

    @include('layouts.frontend.default.components.header-forms')

    <div class="row py-3">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">

                @foreach($banners as $banner)
                    <div class="carousel-item @if(!$loop->first) active @endif">
                        @if ($banner->href)
                            <a href="{{ $banner->href }}" target="{{ $banner->hrefTarget }}">
                        @endif
                                <img src="{{ $banner->mediaURL }}" class="d-block w-100" alt="banner">
                        @if ($banner->href)
                            </a>
                        @endif
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <div class="row">
        <h2>Legutóbbi hirdetések</h2>
    </div>

    <div class="row row-cols-2 row-cols-sm-2 row-cols-md-4 g-4 py-4">
        @foreach ($ads as $ad)
            @include('layouts.frontend.default.components.product-card', [
                'ad' => $ad
            ])
        @endforeach
    </div>

@endsection
