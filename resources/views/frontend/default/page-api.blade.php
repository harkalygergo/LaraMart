@extends('layouts.frontend.default.base')

@section('main')
    @include('layouts.frontend.default.components.header-forms')

    <div class="row py-4">
        <div class="col">
            <h1 class="px-4 py-2" style="background:linear-gradient(to bottom, #bb5499, #fd841b);border-radius:50px;color:white;">
                {{ $page['title'] }}
            </h1>
        </div>
    </div>
    <div class="row bg-white p-5 rounded-5">
        <div class="col-8">
            {!! $page['content'] !!}
        </div>
        <!-- get all categories -->
        @php
            $categories = \App\Models\Category::where('parent_id', null)->get();
        @endphp
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    Kategória struktúra
                </div>
                <div class="card-body">
                    <ul class="list-group2 list-group-flush2">
                        @foreach($categories as $category)
                            <li class="list-group3 list-group-item3">
                                {{ $category->name }}
                                <!-- get all subcategories, where parent_id is equal to the current category id -->
                                @php
                                    $subcategories = \App\Models\Category::where('parent_id', $category->id)->get();
                                @endphp
                                <ul class="list-group4 list-group-flush4">
                                    @foreach($subcategories as $subcategory)
                                        <li class="list-group5 list-group-item5">
                                            {{ $subcategory->name }}
                                            @php
                                                $subsubcategories = \App\Models\Category::where('parent_id', $subcategory->id)->get();
                                            @endphp
                                            <ul class="list-group4 list-group-flush4">
                                                @foreach($subsubcategories as $subsubcategory)
                                                    <li class="list-group5 list-group-item5">
                                                        {{ $subsubcategory->name }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
