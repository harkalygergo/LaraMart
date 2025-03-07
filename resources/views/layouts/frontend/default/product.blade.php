@extends('layouts.frontend.default.base')

@section('main')
    @include('layouts.frontend.default.components.header-forms')

    <div class="row pt-5 pb-3">
        <div class="col">
            <h1 class="px-4 py-2" style="background:linear-gradient(to bottom, #bb5499, #fd841b);border-radius:50px;color:white;">
                {{ $ad['title'] }}
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <div id="carouselIndicator" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @if (!empty($ad['merchant_id']))
                        @foreach (json_decode($ad['images'], true) as $image)
                            <button type="button" data-bs-target="#carouselIndicator" data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}" aria-current="{{ $loop->first ? 'true' : 'false' }}" aria-label="Slide {{ $loop->index }}"></button>
                        @endforeach
                    @endif
                    @if (!empty($ad['user_id']))
                        @foreach ($ad->getMedia($ad['id']) as $media)
                            <button type="button" data-bs-target="#carouselIndicator" data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}" aria-current="{{ $loop->first ? 'true' : 'false' }}" aria-label="Slide {{ $loop->index }}"></button>
                        @endforeach
                    @endif
                </div>
                <div class="carousel-inner">
                    @if (!empty($ad['merchant_id']))
                        @foreach (json_decode($ad['images'], true) as $image)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <img src="{{ $image }}" class="d-block w-100 rounded-5" alt="" loading="lazy">
                            </div>
                        @endforeach
                    @endif
                    @if (!empty($ad['user_id']))
                        @foreach ($ad->getMedia($ad['id']) as $media)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <img src="{{ $media->getUrl() }}" class="d-block w-100 rounded-5" alt="" loading="lazy">
                            </div>
                        @endforeach
                    @endif
                </div>
                <!-- Preview images below the carousel -->
                <div class="carousel-previews mt-3">
                    <div class="row justify-content-center">
                        @if (!empty($ad['merchant_id']))
                            @foreach (json_decode($ad['images'], true) as $image)
                                <div class="col-2">
                                    <img src="{{ $image }}" class="img-thumbnail" data-bs-target="#carouselIndicator" data-bs-slide-to="{{ $loop->index }}" alt="" loading="lazy">
                                </div>
                            @endforeach
                        @endif
                        @if (!empty($ad['user_id']))
                            @foreach ($ad->getMedia($ad['id']) as $media)
                                <div class="col-2">
                                    <img src="{{ $media->getUrl() }}" class="img-thumbnail" data-bs-target="#carouselIndicator" data-bs-slide-to="{{ $loop->index }}" alt="" loading="lazy">
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselIndicator" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselIndicator" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="col-md-5">
            <h2 class="text-start d-none d-sm-block">{{ $ad['categoryType1'] }} {{ $ad['categoryType2'] }} {{ $ad['categoryType3'] }}</h2>
            <div class="d-flex justify-content-between">
                <div class="linear-gradient source-sans-pro-black start-0" style="font-size:37px;font-weight: 900;">
                        {{ number_format($ad['price'], 0, '', ' ') }} Ft
                </div>
                <div class="start-0 d-block d-sm-none">
                    @if (Auth::check())
                        @php
                            $user = Auth::user();
                        @endphp
                        @if (!empty($user->favourites))
                            <!-- if user favourite contains this ad, show remove id -->
                            @if (in_array($ad['id'], json_decode($user->favourites, true)))
                                <a class="text-decoration-none text-black" href="/remove-favourite/{{ $ad['id'] }}">
                                    <i class="bi bi-heart mx-1" style="color:red;font-size:30px;"></i>
                                </a>
                            @else
                                <a class="text-decoration-none text-black" href="/add-favourite/{{ $ad['id'] }}">
                                    <i class="bi bi-heart-fill mx-1" style="color:red;font-size:30px;"></i>
                                </a>
                            @endif
                        @else
                            <a class="text-decoration-none text-black" href="/add-favourite/{{ $ad['id'] }}">
                                <i class="bi bi-heart-fill mx-1" style="color:red;font-size:30px;"></i>
                            </a>
                        @endif
                    @endif
                </div>
            </div>

            <!-- if attributes not empty -->
            @if (!empty($ad['attributes']))
                <table class="table">
                    @foreach (json_decode($ad['attributes'], true) as $attributeKey => $attributeValue)
                        @if (empty($attributeValue))
                            @continue
                        @endif
                        <tr>
                            <td><i class="{{ $allAttributes[$attributeKey]['icon'] }}"></i></td>
                            <td>{{ $allAttributes[$attributeKey]['title'] }}</td>
                            <td><strong>{{ $attributeValue }}</strong></td>
                        </tr>
                    @endforeach
                </table>
            @endif

            @if (!Auth::check())
                <div class="alert alert-primary alert-dismissible d-flex align-items-center fade show" role="alert">
                    <i class="bi bi-info-circle-fill px-1"></i>
                    <div>
                        Regisztrált és bejelentkezett felhasználóként elérhető előnyök:
                        <ul>
                            <li>"Kedvencekhez" funkció</li>
                            <li>hirdető telefonszámának megtekintése</li>
                            <li>üzenet küldése a hirdető számára</li>
                            <li>jelölt ártól eltérő ajánlat adása</li>
                            <li>készülék információ lekérdezés IMEI kód alapján</li>
                        </ul>
                        <p>Tovább a <a class="text-black" href="{{ route('register') }}">regisztrációhoz</a> vagy <a class="text-black" href="{{ route('login') }}">bejelentkezéshez</a>.</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @else
                @php
                    $user = Auth::user();
                @endphp
                <p class="d-none d-sm-block">
                    @if (!empty($user->favourites))
                        <!-- if user favourite contains this ad, show remove id -->
                        @if (in_array($ad['id'], json_decode($user->favourites, true)))
                            <i class="bi bi-heart mx-1" style="color:#BB539A;"></i>
                            <a class="text-decoration-none text-black" href="/remove-favourite/{{ $ad['id'] }}">
                                Eltávolítás a kedvencekből
                            </a>
                        @else
                            <i class="bi bi-heart-fill mx-1" style="color:#BB539A;"></i>
                            <a class="text-decoration-none text-black" href="/add-favourite/{{ $ad['id'] }}">
                                Hozzáadás a kedvencekhez
                            </a>
                        @endif
                    @else
                        <i class="bi bi-heart-fill mx-1" style="color:#BB539A;"></i>
                        <a class="text-decoration-none text-black" href="/add-favourite/{{ $ad['id'] }}">
                            Hozzáadás a kedvencekhez
                        </a>
                    @endif
                </p>

                <div class="row my-2">
                    <div class="col d-grid">
                        @if (!empty($ad['merchant_id']))
                            @php
                                $phone = $ad['merchant']['phone'] ?? 'telefonszám nincs megadva';
                                $email = $ad['merchant']['email'] ?? 'e-mail cím nincs megadva';
                                $otherUser = $ad['merchant'];
                            @endphp
                        @else
                            @php
                                $phone = $ad['user']['phone'] ?? 'telefonszám nincs megadva';
                                $email = $ad['user']['email'] ?? 'e-mail cím nincs megadva';
                                $otherUser = $ad['user'];
                            @endphp
                        @endif
                        <a class="btn btn-fluid btn-primary" href="tel:{{ $phone }}">
                            <i class="bi bi-phone"></i> {{ $phone }}
                        </a>
                    </div>
                    <div class="col d-grid">
                        <a class="btn btn-primary btn-fluid" href="tel:{{ $email }}">
                            <i class="bi bi-envelope"></i> {{ $email }}
                        </a>
                    </div>
                </div>
                <form class="my-2" method="post" action="/message/new">
                    @csrf
                    <input type="hidden" value="{{ $ad['id'] }}" name="ad">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="{{ $ad['price'] }} Ft" aria-label="{{ $ad['price'] }} Ft" aria-describedby="button-product-offer" id="message" name="message" required>
                        <button class="btn btn-primary" type="submit" id="button-product-offer">
                            Ajánlatot teszek
                        </button>
                    </div>
                </form>
            @endif

            @if (!empty($ad['merchant_id']) && !empty($ad['external_link']))
                <div class="d-grid my-2">
                    <a target="_blank" class="btn btn-primary btn-fluid" href="{{ $ad['external_link'] }}">
                        <i class="bi bi-box-arrow-up-right"></i> Irány a bolt
                    </a>
                </div>
            @endif

        </div>
    </div>
    <div class="row pt-5">
        <div class="col-md-7">
            <div class="card shadow p-3">
                <div class="card-body">
                    <h3>Leírás</h3>
                    <p>
                        {!! nl2br(e($ad['description'])) !!}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card shadow p-3">
                <div class="card-body">
                    <h3>Vedd fel a kapcsolatot</h3>
                    @if ($ad['user_id'])
                        <p>
                            <strong>{{ $ad['user']['name'] }} </strong>
                        </p>
                        <p>
                            <small>
                                <i class="bi bi-pin"></i> {{ $ad['user']['zip'] }} {{ $ad['user']['city'] }}, Magyarország
                                <span class="text-end"><strong>Házhozszállítás:</strong> vállalok</span>
                                <br><i class="bi bi-clock"></i> Utoljára elérhető: {{ $ad['user']['last_activity'] }}
                            </small>
                        </p>
                        <iframe
                            width="100%"
                            height="200"
                            style="border:0; border-radius:25px;"
                            loading="lazy"
                            allowfullscreen
                            referrerpolicy="no-referrer-when-downgrade"
                            src="https://www.google.com/maps/embed/v1/place?key={{ env('GOOGLE_EMBED_MAPS_API_KEY') }}&q={{ $ad['user']['zip'] }}">
                        </iframe>
                    @endif

                    @if ($ad['merchant_id'])
                        <p>
                            <strong>{{ $ad['merchant']['name'] }} </strong>
                        </p>
                        <p>
                            <small>
                                <i class="bi bi-pin"></i> {{ $ad['merchant']['zip'] }} {{ $ad['merchant']['city'] }}, Magyarország
                                <span class="text-end"><strong>Házhozszállítás:</strong> vállalok</span>
                                <br><i class="bi bi-clock"></i> Utoljára elérhető: {{ $ad['merchant']['last_activity'] }}
                            </small>
                        </p>
                        <iframe
                            width="100%"
                            height="200"
                            style="border:0; border-radius:25px;"
                            loading="lazy"
                            allowfullscreen
                            referrerpolicy="no-referrer-when-downgrade"
                            src="https://www.google.com/maps/embed/v1/place?key={{ env('GOOGLE_EMBED_MAPS_API_KEY') }}&q={{ $ad['merchant']['zip'] }}">
                        </iframe>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--div class="row">
        <div class="col">
            <section>
                <div class="text-start">
                    5.0
                </div>
                <div class="text-end">
                    <a class="btn btn-primary" href="#">Értékelés írása</a>
                </div>
            </section>
        </div>
    </div-->
    <div class="row pt-5">
        <div class="col text-center">
            <h2>Mások ezt nézik most</h2>
        </div>
    </div>

    <div class="row row-cols-2 row-cols-sm-2 row-cols-md-4 g-4 py-4">

        <!-- loop through related products -->
        @foreach ($relatedAds as $relatedAd)
            @include('layouts.frontend.default.components.product-card', [
                'ad' => $relatedAd
            ])
        @endforeach
    </div>

    <!--div class="row">
        <div class="col text-center">
            <h4>Termékhez ajánlott kiegészítők</h4>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4 py-4">
    </div-->
@endsection
