@extends('layouts.frontend.default.base')

@section('main')
    @include('layouts.frontend.default.components.header-forms')

    <div class="row pt-5 pb-3">
        <div class="col">
            <h1 class="px-4 py-2" style="background:linear-gradient(to bottom, #bb5499, #fd841b);border-radius:50px;color:white;">
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
