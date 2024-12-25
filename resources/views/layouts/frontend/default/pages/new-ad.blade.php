<!-- create a form for new Ad -->
@extends('layouts.frontend.default.base')

@if (isset($ad))
    @section('title', 'Modify ad')
@else
    @section('title', 'Create new ad')
@endif

@section('main')
    <div class="row justify-content-center">
        <div class="col-12">
            <!-- h2 with section title -->
            <h2 class="py-3 text-center">
                @if (isset($ad))
                    @php
                        $formURL = '/ad/edit/' . $ad['id'];
                    @endphp
                    Modfiy ad
                @else
                    @php
                        $formURL = '/hirdetes/feladas';
                    @endphp
                    Create new ad
                @endif
            </h2>
        </div>
        <div class="col-12">
            <div class="row text-center">
                @if (isset($ad))
                    @foreach ($ad->getMedia($ad['id']) as $media)
                        <div class="col">
                            <img src="{{ $media->getUrl() }}" class="d-block w-100" alt="banner1">
                            <br>
                            <a class="text-decoration-none text-black" href="/hirdetes/{{ $ad['id'] }}/media/{{ $ad['user_id'] }}/delete/{{ $media->id }}"><small>kép eltávolítása</small></a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <form action="{{ $formURL }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="subject">Hirdetés címe:</label>
                    <input type="text" class="form-control" id="subject" name="subject" required placeholder="például: Eladó iPhone 16 PRO max kifogástalan állapotban" value="@isset($ad){{$ad['title']}}@endisset">
                </div>
                <div class="form-group mb-3">
                    <label for="description">Leírás:</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required placeholder="például: 2 éve vásároltam, tökéletes állapotban van, jó akkumulátorral, stb.">@isset($ad){{$ad['description']}}@endisset</textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="price">Ár:</label>
                    <input type="number" class="form-control" id="price" name="price" required value="@isset($ad){{$ad['price']}}@endisset">
                </div>
                <div class="form-group mb-3">
                    <label for="images">Képek:</label>
                    <input type="file" class="form-control" id="images" name="images[]" multiple @if(!isset($ad)) required @endif>
                </div>
                <!-- loop throe $categoryType1 as select options -->
                <div class="form-group mb-3">
                    <label for="categoryType1">Kategória:</label>
                    <select class="form-control" id="categoryType1" name="categoryType1" required>
                        <option value="">- válassz kategóriát -</option>
                        @foreach ($categoryType1 as $category)
                            <option value="{{ $category->name }}" @isset($ad) @if($ad['categoryType1']==$category->name) selected @endif @endisset  >{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <hr>
                <h5>Attribútumok</h5>
                @foreach(\App\Models\Attribute::all() as $attribute)
                    <div class="form-group mb-3">
                        <label for="attribute_{{ $attribute->slug }}">{{ $attribute->title }}</label>
                        <input type="text" class="form-control" id="attribute_{{ $attribute->slug }}" name="attributes[{{ $attribute->slug }}]" value="@isset($ad){{$ad->getAttributeValue($attribute->id)}}@endisset">
                    </div>
                @endforeach
                <div class="d-grid gap mb-3">
                    <button type="submit" class="btn btn-primary">Hirdetés feladása</button>
                    <a href="/profil" class="mt-5 btn btn-fluid btn-secondary">Vissza a profilomra</a>
                </div>
            </form>
        </div>
    </div>
@endsection
