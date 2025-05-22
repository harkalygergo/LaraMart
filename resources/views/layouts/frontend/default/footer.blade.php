<footer class="container-fluid">
    <div class="container py-5">
        <div class="row">
            <div class="col pt-5">
                <h4 class="sue-ellen-francisco-regular text-uppercase display-6">Menü</h4>
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
                <h4 class="sue-ellen-francisco-regular text-uppercase display-6">Hasznos</h4>
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
                            Info
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container p-5">
        <div class="row">
            <div class="col text-center">
                <a target="_blank" href="https://www.buymeacoffee.com/harkalygergo">
                    <img alt="BuyMeACoffee/harkalygergo" src="https://img.buymeacoffee.com/button-api/?text=Köszönöm, ha meghívsz!&emoji=☕&slug=harkalygergo&button_colour=ffffff&font_colour=000000&font_family=Bree&outline_colour=000000&coffee_colour=FFDD00" />
                </a>
            </div>
    </div>
    <div class="container pt-5">
        <div class="row">
            <div class="col text-center text-white-50">
                .: Copyright 2024 &copy; {{ env('APP_NAME') }} :: Minden jog fenntartva! :.
            </div>
        </div>
    </div>
</footer>
