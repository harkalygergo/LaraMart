<nav class="pt-4">
    <div class="row flex-nowrap overflow-auto text-center pb-3">

        @foreach($menus as $menu)
            <div class="col" style="min-width:120px;">
                <a class="text-decoration-none text-black" href="{{ $menu->link }}">
                    <img class="img-fluid" alt="{{ $menu->title }}" src="{{ asset($menu->image_url) }}">
                    <strong>{{ $menu->title }}</strong>
                </a>
            </div>
        @endforeach

    </div>
</nav>
