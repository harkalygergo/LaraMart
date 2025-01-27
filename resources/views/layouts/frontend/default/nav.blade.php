<nav class="pt-4">
    <div class="row flex-nowrap overflow-auto text-center pb-3">

        @foreach($menus as $menu)
            <div class="col m-2" style="min-width:100px;">
                <div class="circle-background">
                    <a class="text-decoration-none text-black" href="{{ $menu->link }}">
                        <img alt="{{ $menu->title }}" src="{{ asset($menu->image_url) }}">
                        <strong>{{ $menu->title }}</strong>
                    </a>
                </div>
            </div>
        @endforeach

    </div>
</nav>
