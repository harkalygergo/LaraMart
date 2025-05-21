@extends('layouts.backend.base')

@section('main')

    <div class="row">
        <div class="col-12">
            <h2 class="py-3 text-center">Kategória szerkesztés</h2>
        </div>
        <div class="col-md-12">
            <form action="/admin/v1/category/edit/{{ $category->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="name">Megnevezés:</label>
                    <input value="{{ $category->name }}" type="text" class="form-control" id="name" name="name" required placeholder="például: Mobiltelefon">
                </div>
                <div class="form-group mb-3">
                    <label for="slug">Slug:</label>
                    <input value="{{ $category->slug }}" type="text" class="form-control" id="slug" name="slug" required placeholder="például: mobiltelefon">
                </div>
                <div class="form-group mb-3">
                    <label for="description">Leírás:</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required placeholder="például: Mobiltelefonok, okostelefonok, stb.">{{ $category->description }}</textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="parent">Szülő kategória:</label>
                    <select class="form-control" id="parent" name="parent">
                        <option value="">Nincs</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" @if ($category->parent_id == $cat->id) selected @endif>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="productTypes">Terméktípus:</label>
                    <select class="form-control" id="product_type_id" name="product_type_id">
                        <option value="">- válassz terméktípust -</option>
                        @foreach ($availableProductTypes as $availableProductType)
                            <option value="{{ $availableProductType['id'] }}"
                                @if ($category->product_type_id == $availableProductType['id']) selected @endif>
                                {{ $availableProductType['name'] }} ({{ $availableProductType['slug'] }})
                            </option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group mb-3">
                    <label for="image">Kép:</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <div class="form-group mb-3">
                    <label for="image">Jelenlegi kép:</label>
                    @if ($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="img-fluid">
                    @else
                        <p>Nincs kép</p>
                    @endif
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Mentés</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form action="/admin/v1/category/delete/{{ $category->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Törlés</button>
            </form>
        </div>
    </div>
@endsection
