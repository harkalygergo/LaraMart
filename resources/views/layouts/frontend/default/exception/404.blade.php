@extends(env('LAYOUT').'.base')

@section('main')
    @include(env('LAYOUT').'.components.header-forms')

    <div class="row text-center">
        <div class="col">
            <h1 class="p-5">404 - oldal nem található</h1>
        </div>
    </div>
@endsection
