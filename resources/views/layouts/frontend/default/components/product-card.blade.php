<!-- set image variable -->
@if (!empty($ad['merchant_id']))
    @php
        $image = asset(json_decode($ad['images'], true)["0"]);
        $images = json_decode($ad['images'], true);
    @endphp
@endif
@if (!empty($ad['user_id']))
    @php
        $image = $ad->getMedia($ad['id'])->first()->getUrl();
        $images = $ad->getMedia($ad['id'])->map(fn($media) => $media->getUrl(''));
    @endphp
@endif

<div class="col p-0">
    <div class="card p-0 m-0 p-sm-3 shadow mx-2">
        <div id="carouselIndicator{{ $ad['id'] }}" class="carousel slide">
            <div class="carousel-inner">
                @foreach ($images as $image)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <a href="/ad/{{ $ad['url'] }}">
                            <img src="{{ $image }}" class="card-img-top" alt="{{ $ad['title'] }}" loading="lazy">
                        </a>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselIndicator{{ $ad['id'] }}" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselIndicator{{ $ad['id'] }}" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="card-body">
            <h5 class="card-title linear-gradient source-sans-pro-black">
                {{ number_format($ad['price'], 0, '', ' ') }} Ft
            </h5>
            <p class="card-text">
                <span class="source-sans-pro-black">
                    <a class="text-black text-decoration-none" href="/hirdetes/{{ $ad['url'] }}">
                        {{ Str::limit($ad['title'], 50) }}
                    </a>
                </span>
                <span class="d-none d-sm-block">
                    Feltöltő:
                    @if ($ad['user_id'])
                        {{ $ad['user']['name'] }}
                    @endif
                    @if ($ad['merchant_id'])
                        <a href="/kereskedo/{{ $ad['merchant']['slug'] }}" class="text-decoration-none text-black">
                            {{ $ad['merchant']['name'] }}
                        </a>
                    @endif
                </span>
            </p>
        </div>
        <div class="card-footer text-center bg-white d-grid">
            <a href="/hirdetes/{{ $ad['url'] }}" class="btn btn-primary btn-fluid text-capitalize px-sm-5 py-sm-2">
                Megnézem
            </a>
            @if (isset($edit))
                <a href="/hirdetes/edit/{{ $ad['id'] }}" class="btn btn-warning btn-fluid text-capitalize px-5 py-2 my-2">
                    <i class="bi bi-pen"></i>
                    Szerkesztés
                </a>
            @endif
            @if (isset($delete))
                <form action="/hirdetes/delete/{{ $ad['id'] }}" method="POST" class="d-grid">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-fluid text-capitalize px-5 py-2 my-1">
                        <i class="bi bi-trash"></i>
                        Törlés
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>