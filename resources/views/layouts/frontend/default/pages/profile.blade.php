@extends(env('LAYOUT').'.base')

@section('main')
    <h1 class="px-4 py-2">
        Profil
    </h1>
    <div class="row bg-white px-3 py-5" style="border-radius: 25px;">
        <div class="col">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab" aria-controls="messages" aria-selected="false">
                        <i class="bi bi-chat"></i>
                        <span class="d-none d-sm-inline-block">Üzenetek</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="userdata-tab" data-bs-toggle="tab" data-bs-target="#userdata" type="button" role="tab" aria-controls="userdata" aria-selected="false">
                        <i class="bi bi-person"></i>
                        <span class="d-none d-sm-inline-block">Adataim</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="ad-tab" data-bs-toggle="tab" data-bs-target="#ad" type="button" role="tab" aria-controls="ad" aria-selected="false">
                        <i class="bi bi-badge-ad"></i>
                        <span class="d-none d-sm-inline-block">Hirdetések</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="deposit-tab" data-bs-toggle="tab" data-bs-target="#deposit" type="button" role="tab" aria-controls="deposit" aria-selected="false">
                        <i class="bi bi-credit-card"></i>
                        <span class="d-none d-sm-inline-block">Egyenleg</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#favourites" type="button" role="tab" aria-controls="settings" aria-selected="false">
                        <i class="bi bi-heart"></i>
                        <span class="d-none d-sm-inline-block">Kedvencek</span>
                    </button>
                </li>
                <li class="nav-item">
                    <a href="/kijelentkezes" class="nav-link text-danger">
                        <i class="bi bi-box-arrow-right"></i>
                        <span class="d-none d-sm-inline-block">Kijelentkezés</span>
                    </a>
                </li>
                <!-- if user is_admin is true, show admin link -->
                @if ($user['is_admin'])
                    <li class="nav-item">
                        <a href="/admin/v1" class="nav-link text-warning">
                            <i class="bi bi-gear text-warning"></i>
                            <span class="d-none d-sm-inline-block">Admin</span>
                        </a>
                    </li>
                @endif
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="messages" role="tabpanel" aria-labelledby="messages-tab" tabindex="1">
                    <h4 class="pt-3 text-center">Üzenetek</h4>


                    @if ($groupedMessages->count())

                        <div class="accordion" id="accordionExample">
                            @foreach($groupedMessages as $groupKey => $groupedMessage)

                                @php
                                    list($adId, $from, $to) = explode('-', $groupKey);
                                    $ad = \App\Models\Ad::find($adId);
                                @endphp

                                @if ($from == $user['id'])
                                    @php
                                        $user2 = \App\Models\User::find($to);
                                    @endphp
                                @else
                                    @php
                                        $user2 = \App\Models\User::find($from);
                                    @endphp
                                @endif

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button @if(!$loop->first) collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$groupKey}}" aria-expanded="true" aria-controls="collapseOne">
                                        <span class="px-2">
                                            <i class="bi bi-person"></i> {{ $user2->name }}
                                        </span>
                                            <span class="px-2">
                                            <i class="bi bi-badge-ad"></i> {{ $ad->title }}
                                        </span>
                                        </button>
                                    </h2>
                                    <div id="collapse{{$groupKey}}" class="accordion-collapse collapse @if($loop->first) show @endif" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="text-end">
                                                <small class="badge text-bg-light">
                                                    <a class="text-black text-decoration-none" target="_blank" href="/hirdetes/{{ $ad->url }}">
                                                        <i class="bi bi-badge-ad p-1"></i>
                                                        {{ $ad->title }}
                                                        <i class="bi bi-box-arrow-up-right"></i>
                                                    </a>
                                                </small>
                                            </div>
                                            <div class="p-2">

                                                @foreach($groupedMessage as $message)

                                                    @php
                                                        $from = \App\Models\User::find($message->from);
                                                    @endphp

                                                    @if($from->id == $user['id'])
                                                        @php
                                                            $fromName = 'Én';
                                                            $class = 'text-end';
                                                        @endphp
                                                    @else
                                                        @php
                                                            $fromName = $from->name;
                                                            $class = 'p-1 rounded bg-light text-start';
                                                        @endphp
                                                    @endif

                                                    <p class="{{ $class }}">
                                                        <small>
                                                            {{ $message->created_at }}
                                                            |
                                                            {{ $fromName }}
                                                            :
                                                        </small>
                                                        <br>
                                                        {{ $message->message }}
                                                    </p>

                                                @endforeach

                                            </div>
                                            <form action="/message/new" method="post">

                                                @csrf
                                                @method('post')

                                                <input type="hidden" name="to" value="{{ $user2->id }}">
                                                <input type="hidden" name="ad" value="{{ $ad->id }}">
                                                <textarea name="message" class="form-control v-100" placeholder="Válasz..." required></textarea>
                                                <br><button type="submit" class="btn btn-fluid btn-primary">Válasz elküldése</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>



                    @else
                        <p>Nincsenek üzeneteid.</p>
                    @endif
                </div>
                <div class="tab-pane" id="userdata" role="tabpanel" aria-labelledby="userdata-tab" tabindex="1">
                    @include(env('LAYOUT').'.components.profile-form')
                </div>
                <div class="tab-pane" id="deposit" role="tabpanel" aria-labelledby="deposit-tab" tabindex="2">
                    <h4 class="pt-3 text-center">Egyenleg</h4>
                    <h6>Egyenlegem: {{ $user['points'] }} pont ( 1 pont = 1 forint).</h6>
                    <p>Itt tudod feltölteni az egyenlegedet, hogy hirdetéseket tudj feladni vagy IMEI-t lekérdezni.</p>
                    <p><strong>Jelenleg a hirdetés feladása teljesen ingyenes.</strong></p>
                    <p>IMEI lekérdezés 100 pontba kerül, azonban regisztrációnál 200 pontot jóváírunk, így az első két lekérdezés díjmentes.</p>

                    <h5 class="py-3">Fizetési információk</h5>
                    <p>A kártyás tranzakciókhoz a Bariont vagy Stripe biztonságos fizetést használjuk.</p>
                    <p>Nem tárolunk semmilyen kártyainformációt!</p>
                    <p>Pontok mennyisége - 1 pont = 1 Ft (minimum feltölthető mennyiség: 2000)</p>
                    <form action="/barion" method="post">
                        <div class="row">
                            <div class="col">
                                @csrf
                                @method('post')
                                <input type="hidden" name="email" value="{{ $user['email'] }}">
                                <div class="form-group mb-3">
                                    <input type="number" name="quantity" id="quantity" class="form-control" min="2000" max="1000000" placeholder="minimum 2.000, maximum 1.000.000 forint" required>
                                </div>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary btn-fluid">Egyenleg feltöltése bankkárytával</button>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="tab-pane" id="ad" role="tabpanel" aria-labelledby="ad-tab" tabindex="2">
                    <h4 class="pt-3 text-center">Hirdetések</h4>
                    <a href="/hirdetes/feladas" class="btn btn-primary">Hirdetés feladása</a>

                    <div class="row row-cols-2 row-cols-sm-2 row-cols-lg-4 g-4 py-4">
                        @foreach ($ads as $ad)
                            @if ($ad)
                                @include(env('LAYOUT').'.components.product-card', [
                                    'ad' => $ad,
                                    'edit' => true,
                                    'delete' => true
                                ])
                            @endif
                        @endforeach
                    </div>


                </div>
                <div class="tab-pane" id="favourites" role="tabpanel" aria-labelledby="settings-tab" tabindex="4">

                    <div class="row row-cols-2 row-cols-sm-2 row-cols-lg-4 g-4 py-4">
                        @if (!empty($favoriteAds))
                            @php
                                $favoriteAds = json_decode($favoriteAds, true);
                            @endphp
                            @foreach ($favoriteAds as $favoriteAd)
                                @php
                                    $record = \App\Models\Ad::find($favoriteAd);
                                @endphp

                                @if ($record)
                                    @include(env('LAYOUT').'.components.product-card', [
                                        'ad' => $record
                                    ])
                                @endif
                            @endforeach
                        @endif
                    </div>

                </div>
                <div class="tab-pane" id="egyenleg" role="tabpanel" aria-labelledby="settings-tab" tabindex="5">......</div>
            </div>

        </div>
@endsection
