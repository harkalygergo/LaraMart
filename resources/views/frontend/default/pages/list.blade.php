@extends('layouts.frontend.default.base')

@section('main')
    @include('layouts.frontend.default.components.header-forms')

    <!-- check if $category is set -->
    @if (isset($category))
        @php
            $imagePath = public_path('assets/img/kategoria-banner/kategoria-' . $category['slug'] . '.png');
        @endphp
        @if (file_exists($imagePath))
            <div class="row pt-5 pb-2">
                <img src="{{ asset('assets/img/kategoria-banner/kategoria-' . $category['slug'] . '.png') }}" class="img-fluid" alt="{{ $title }}">
            </div>
        @endif
    @else
        <h1 class="py-3 text-center">{{ $title }}</h1>
    @endif

    <!-- if isset subnav, loop through -->
    @if (isset($subnav))
        <div class="row flex-nowrap overflow-auto text-center pt-3 pb-5 @if(count($subnav)<5) justify-content-lg-center @endif">
            @foreach ($subnav as $subnavitem)
                <div class="col" style="max-width:150px;max-height: 150px;">
                    @php
                        $imagePath = public_path('assets/img/nav/' . strtolower(str_replace(' ', '', str_replace(['Használt', 'Apple'], '', $subnavitem['title']))) . '.png');
                    @endphp
                    @if (file_exists($imagePath))
                        <div class="circle-background">
                            <a class="text-black text-decoration-none" href="{{ $subnavitem['slug'] }}">
                                <img src="{{ asset('assets/img/nav/' . strtolower(str_replace(' ', '', str_replace(['Használt', 'Apple'], '', $subnavitem['title']))) . '.png') }}" alt="{{ $subnavitem['title'] }}" style="height:100px;width:auto;">
                            </a>
                            <p>{{ $subnavitem['name'] }}</p>
                        </div>
                    @else
                        <a class="text-black text-decoration-none" href="{{ $subnavitem['slug'] }}">
                            <button type="button" class="btn btn-info" style="background-color: #e8cbdf;">
                                <span class="p-1 d-block">
                                    {{ $subnavitem['name'] }}
                                </span>
                            </button>
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    <div class="row row-cols-2 row-cols-sm-2 row-cols-md-4 g-4 py-4">
        @foreach ($ads as $ad)
            @include('layouts.frontend.default.components.product-card', [
                'ad' => $ad
            ])
        @endforeach
    </div>

@endsection
