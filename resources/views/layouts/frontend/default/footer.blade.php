<footer class="container-fluid pt-5">
    <div class="container">
        <div class="row">
            <div class="col pt-3">
                <h4>Menü</h4>
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
            <div class="col pt-3">
                <h4>Hasznos</h4>
                <ul class="list-group list-group-flush">
                    @foreach(\App\Models\Page::all() as $page)
                        <li class="list-group item">
                            <a class="text-decoration-none text-white" href="/info/{{ $page->slug }}">
                                {{ $page->title }}
                            </a>
                        </li>
                    @endforeach
                    <li class="list-group item">
                        <a class="text-decoration-none text-white" href="/blog">
                            Blog
                        </a>
                    </li>
                </ul>
                <div class="py-5">
                    <h5>Fizetési módok</h5>
                    <img class="img-fluid" src="{{ asset('assets/img/barion-logo.png') }}" alt="Barion elfogadóhely" style="filter: grayscale(1);max-width:400px;">
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <img alt="LaraMart" src="{{ asset('assets/img/szivecske.png')  }}" class="mb-5">
                Copyright 2024 &copy; LaraMart
            </div>
        </div>
    </div>
</footer>
