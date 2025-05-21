@extends(env('LAYOUT').'.base')

@section('main')
    @include(env('LAYOUT').'.components.header-forms')

    <!-- check if $category is set -->
    @if (isset($category))
        @php
            $imagePath = public_path('assets/img/kategoria-banner/kategoria-' . $category['slug'] . '.png');
        @endphp
        @if (file_exists($imagePath))
            <div class="row pb-2">
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
                            <button type="button" class="btn" style="border:8px solid #9e6740;height: 120px;width: 120px;color: #9e6740;">
                                <span class="p-1 d-block fw-bold">
                                    {{ $subnavitem['name'] }}
                                </span>
                            </button>
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    <div class="row">
        <div class="col-md-2">
            @if (isset($category))
                <!-- show $attributes length -->
                @if($attributes)
                <form method="get">
                    <h5 class="px-4 py-2 mt-4">Termékszűrés</h5>
                    @foreach ($attributes as $attributeKey => $attributeValues)
                        <strong>{{ $availableAttributes[$attributeKey] }}</strong>
                        @foreach ($attributeValues as $attributeValue)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="{{$attributeKey}}[]" value="{{ $attributeValue }}" id="{{$attributeKey}}___{{$attributeValue}}">
                                <label class="form-check-label" for="{{$attributeKey}}___{{$attributeValue}}">{{ $attributeValue }}</label>
                            </div>
                        @endforeach
                    @endforeach
                    <button type="submit" class="btn btn-lg btn-primary btn-fluid text-capitalize mx-auto d-flex">
                        <i class="bi bi-funnel"></i>
                        Szűrés
                    </button>
                </form>
            @endif
            @endif
        </div>
        <div class="col-md-10">
            <div class="row row-cols-2 row-cols-sm-2 row-cols-lg-4 g-4 py-4">
                @foreach ($ads as $ad)
                    @include(env('LAYOUT').'.components.product-card', [
                        'ad' => $ad
                    ])
                @endforeach
            </div>
        </div>
    </div>

@endsection
