<header class="py-3">
    <div class="row">
        <div class="col-2 col-sm-2 col-lg-4 my-auto">
            <a class="btn" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample" style="font-size:2rem;color:#ba539a;">
                <i class="bi bi-list"></i>
            </a>
        </div>
        <div class="col-7 col-sm-6 col-lg-4 text-start text-md-center">
            <a class="corben-bold text-dark text-decoration-none" href="/">
                <span class="display-4 d-none d-lg-inline-block">⌚</span>
                <span class="fs-1" style="color:#9e6740;">óraplacc.hu</span>
            </a>
            <p>új és használt órák piactere</p>
        </div>
        <div class="col-3 col-sm-4 col-lg-4 my-auto text-end">
            <a class="btn btn-primary" title="profil" href="{{ route('login') }}">
                <i class="bi bi-person"></i>
                <span class="d-none d-sm-inline-block">Fiók</span>
            </a>
            <a class="btn btn-primary d-none d-sm-none d-md-none d-lg-inline-block fw-bold" href="{{ route('login') }}">
                <i class="bi bi-watch"></i>
                <span class="d-none d-lg-inline-block">ingyenes</span> hirdetésfeladás
            </a>
        </div>
    </div>
</header>

<div class="row pt-3 d-flex d-lg-none">
    <div class="col py-2">
        <form method="get" action="/kereses">
            <div class="input-group">
                <button class="btn btn-primary" type="submit" id="button-search" style="background:white;color:#ba539a;border:1px solid #ba539a;border-right:none;">
                    <i class="bi bi-search"></i>
                </button>
                <input type="text" name="s" class="form-control" placeholder="Keresés a termékek között" aria-label="Keresés a termékek között" aria-describedby="button-search" value="@isset($searchQuery){{ $searchQuery }}@endisset" required>
                <select name="q" id="q" style="background:white;color:#ba539a;border:1px solid #ba539a;border-radius:0 50px 50px 0;">
                    <option value="products">Termékek</option>
                </select>
            </div>
        </form>
    </div>
</div>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel" style="background-color: #f9f9f9;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-uppercase" id="offcanvasExampleLabel">Menü</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body fw-bold py-0">
        <hr>
        <h5 class="px-4 py-2">Kategóriák</h5>
        <ul class="list-group list-group-flush">
            @foreach(\App\Models\Category::whereNull('parent_id')->get() as $category)
                <li class="list-group item">
                    <a class="text-decoration-none text-black p-2" href="/kategoria/{{ $category->slug }}">
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
        </ul>
        <hr>
        <h5 class="px-4 py-2">Hasznos</h5>
        <ul class="list-group list-group-flush">
            @foreach(\App\Models\Page::all() as $page)
                <li class="list-group item">
                    <a class="text-decoration-none text-black p-2" href="/{{ $page->slug }}">
                        {{ $page->title }}
                    </a>
                </li>
            @endforeach
            <li class="list-group item">
                <a class="text-decoration-none text-black p-2" href="/blog">
                    Blog
                </a>
            </li>
        </ul>

    </div>
</div>
