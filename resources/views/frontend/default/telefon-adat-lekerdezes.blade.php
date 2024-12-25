@extends('layouts.frontend.default.base')

@section('main')
    <div class="row bg-white px-3 py-5" style="border-radius: 25px;">
        <div class="col-12 col-md-4">
            <img src="{{ asset('assets/img/imei.png') }}" alt="IMEI lekérdezés" class="img-fluid">
        </div>
        <div class="col-12 col-md-8 px-5">
            <h1 class="px-4 py-2" style="background:linear-gradient(to bottom, #bb5499, #fd841b);border-radius:50px;color:white;">
                IMEI-szám ellenőrzése
            </h1>
            <p>IMEI ellenőrző felületünk lehetővé teszi, hogy gyorsan és egyszerűen ellenőrizd a készülék garanciáját, az első eladót, az iCloud állapotát és a fekete listás státuszt. Szolgáltatásunk segítségével könnyedén megállapíthatod az eszköz hitelességét és állapotát vásárlás előtt, így biztos lehetsz benne, hogy az eszköz megfelelően működik és nem szerepel a tiltott eszközök listáján.</p>

            <!-- if user is not logged in, show login form -->
            @if (!auth()->check())
                <p>Az IMEI lekérdezéshez kérjük, jelentkezz be, vagy ha még nincs fiókod, regisztálj.</p>
            @else
                <form method="get" action="/telefon-adat-lekerdezes" onsubmit="return validateIMEI()">
                    <div class="row">
                        @php
                            $brands = [
                                30 => 'Apple',
                                80 => 'Samsung',
                                206 => 'Xiaomi',
                                17 => 'Alcatel',
                                42 => 'Pixel',
                                84 => 'Realme',
                                36 => 'OnePlus',
                                73 => 'Honor',
                                //22 => 'Lenovo',
                                //39 => 'Oppo',
                                //19 => 'LG',
                                /*
                                23 => 'Acer',
                                15 => 'Huawei',
                                5 => 'Sony',
                                13 => 'Motorola',
                                34 => 'Asus',
                                55 => 'ZTE',
                                */
                            ];
                        @endphp

                        @foreach ($brands as $brandKey => $brandName)
                            <div class="col-12 col-sm-6 col-lg-3 text-center">
                                <input type="radio" class="btn-check" name="service" id="service{{$brandKey}}" autocomplete="off" value="{{$brandKey}}" @if($brandName=='Apple') checked @endif>
                                <label class="btn btn-light" for="service{{$brandKey}}">
                                    <img alt="{{$brandName}}" src="{{ asset('assets/img/brand/brand-logo-'.strtolower($brandName).'.png') }}" style="width:100%;">
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="input-group py-3">
                        <input type="text" class="form-control" placeholder="Lekérdezés IMEI kód alapján (14-16 karakter)" aria-label="Lekérdezés IMEI kód alapján (14-16 karakter)" aria-describedby="button-imei" name="imei" id="imei-input" pattern="\d{14,16}" value="@isset($imei){{ $imei }}@endisset" required>
                        <button class="btn btn-primary" type="submit" id="button-imei">
                            Lekérdezés
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Alapinformációk</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="icloud-tab" data-bs-toggle="tab" data-bs-target="#icloud" type="button" role="tab" aria-controls="icloud" aria-selected="false">iCloud On/Off</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="blacklist-tab" data-bs-toggle="tab" data-bs-target="#blacklist" type="button" role="tab" aria-controls="blacklist" aria-selected="false">Feketelista ellenőrzés</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="garancia-tab" data-bs-toggle="tab" data-bs-target="#garancia" type="button" role="tab" aria-controls="garancia" aria-selected="false">Garancia és első eladó ellenőrzése</button>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        <h4>Alapinformációk</h4>
                        <p>A lekérdezés díja: 100 pont, saját pontok száma: {{ Auth::user()['points'] }}</p>
                        @isset($error)
                            {!! $error !!}
                        @endisset

                        @isset($result)
                            <script>console.log(JSON.stringify({!!$result!!}));</script>
                            @php
                                $result = json_decode($result, true);
                            @endphp
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                    @foreach ($result['result'] as $key => $value)
                                        <tr>
                                            <td>{{ $key }}:</td>
                                            <td><strong>{{ $value }}</strong></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endisset
                    </div>
                    <div class="tab-pane" id="icloud" role="tabpanel" aria-labelledby="icloud-tab" tabindex="0">
                        <h4>iCloud on/off</h4>
                        <p>A lekérdezés díja: 100 pont, saját pontok száma: {{ Auth::user()['points'] }}</p>
                        <form method="get" action="/telefon-adat-lekerdezes" onsubmit="return validateIMEI()">
                            <div class="input-group">
                                <input type="hidden" name="service" value="3">
                                <input type="text" class="form-control" placeholder="Lekérdezés IMEI kód alapján (14-16 karakter)" aria-label="Lekérdezés IMEI kód alapján (14-16 karakter)" aria-describedby="button-imei" name="imei" id="imei-input" pattern="\d{14,16}" value="@isset($imei){{ $imei }}@endisset" required>
                                <button class="btn btn-primary" type="submit" id="button-imei">
                                    Lekérdezés
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="blacklist" role="tabpanel" aria-labelledby="blacklist-tab" tabindex="0">
                        <h4>Feketelista</h4>
                        <p>A lekérdezés díja: 100 pont, saját pontok száma: {{ Auth::user()['points'] }}</p>
                        <form method="get" action="/telefon-adat-lekerdezes" onsubmit="return validateIMEI()">
                            <div class="input-group">
                                <input type="hidden" name="service" value="54">
                                <input type="text" class="form-control" placeholder="Lekérdezés IMEI kód alapján (14-16 karakter)" aria-label="Lekérdezés IMEI kód alapján (14-16 karakter)" aria-describedby="button-imei" name="imei" id="imei-input" pattern="\d{14,16}" value="@isset($imei){{ $imei }}@endisset" required>
                                <button class="btn btn-primary" type="submit" id="button-imei">
                                    Lekérdezés
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="garancia" role="tabpanel" aria-labelledby="garancia-tab" tabindex="0">
                        <h4>Garancia</h4>
                        <p>A lekérdezés díja: 100 pont, saját pontok száma: {{ Auth::user()['points'] }}</p>
                    </div>
                </div>
                <script>
                    function validateIMEI() {
                        const imeiInput = document.getElementById('imei-input');
                        const imeiValue = imeiInput.value;
                        const imeiPattern = /^\d{14,16}$/;

                        if (!imeiPattern.test(imeiValue)) {
                            alert('Az IMEI 14-16 karakter hosszú.');
                            return false;
                        }
                        return true;
                    }
                </script>
            @endif
        </div>
    </div>
@endsection
