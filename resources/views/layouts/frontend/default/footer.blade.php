<footer class="container-fluid mt-5">
    <div class="container">
        <div class="row">
            <div class="col pt-5">
                <h4 class="fs-4 text-white fw-bold">Kategóriák</h4>
                <ul class="list-group list-group-flush">
                    @foreach(\App\Models\Category::whereNull('parent_id')->get() as $category)
                        <li class="list-group item">
                            <a class="text-decoration-none text-white" href="/kategoria/{{ $category->slug }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col pt-5">
                <h4 class="fs-4 text-white fw-bold">Hasznos</h4>
                <ul class="list-group list-group-flush">
                    @foreach(\App\Models\Page::all() as $page)
                        <li class="list-group item">
                            <a class="text-decoration-none text-white" href="/{{ $page->slug }}">
                                {{ $page->title }}
                            </a>
                        </li>
                    @endforeach
                    <li class="list-group item">
                        <a class="text-decoration-none text-white" href="{{ route('info.index') }}">
                            Információk
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row py-4">
            <div class="col text-center">
                <a target="_blank" href="https://www.buymeacoffee.com/harkalygergo">
                    <img alt="BuyMeACoffee/harkalygergo" src="https://img.buymeacoffee.com/button-api/?text=Köszönöm, ha meghívsz!&emoji=☕&slug=harkalygergo&button_colour=ffffff&font_colour=000000&font_family=Bree&outline_colour=000000&coffee_colour=FFDD00" />
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col text-center text-white-50">
                <p>
                    <small>
                        .: Copyright 2025 &copy; {{ env('APP_NAME') }} :: Minden jog fenntartva! :.
                    </small>
                </p>
            </div>
        </div>
    </div>
</footer>
