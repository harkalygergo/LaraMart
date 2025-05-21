@extends(env('LAYOUT').'.base')

@section('main')
    @include(env('LAYOUT').'.components.header-forms')

    <div class="row pt-5 pb-3">
        <div class="col">
            <h1 class="px-4 py-2">
                {{ $page['title'] }}
            </h1>
        </div>
    </div>
    <div class="row bg-white p-5 rounded-5">
        <div class="col">
            {!! $page['content'] !!}
        </div>
    </div>
@endsection
