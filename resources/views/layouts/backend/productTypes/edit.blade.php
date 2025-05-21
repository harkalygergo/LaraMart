@extends('layouts.backend.base')

@section('main')

    <div class="row">
        <div class="col-12">
            <h2 class="py-3 text-center">Terméktípus szerkesztés</h2>
        </div>
        <div class="col-md-12">
            <form action="/admin/v1/product-type/edit/{{ $productType->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="name">Megnevezés:</label>
                    <input value="{{ $productType->name }}" type="text" class="form-control" id="name" name="name" required placeholder="például: Mobiltelefon">
                </div>
                <div class="form-group mb-3">
                    <label for="slug">Slug:</label>
                    <input value="{{ $productType->slug }}" type="text" class="form-control" id="slug" name="slug" required placeholder="például: mobiltelefon">
                </div>
                <div class="form-group mb-3">
                    <label for="description">Leírás:</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required placeholder="például: Mobiltelefonok, okostelefonok, stb.">{{ $productType->description }}</textarea>
                </div>
                <!-- add multi select for attributes -->
                <div class="form-group mb-3">
                    <label for="attributes">Attribútumok:</label>
                    <select class="form-control" id="attributes" name="attributes[]" multiple size="10">
                        @php
                            $productAttributes = [];
                            foreach ($productType->attributes as $attribute) {
                                $productAttributes[] = $attribute['id'];
                            }
                        @endphp
                        @foreach ($availableAttributes as $availableAttribute)
                            <option value="{{ $availableAttribute['id'] }}" @if (in_array($availableAttribute['id'], $productAttributes)) selected @endif>{{ $availableAttribute['title'] }} ({{ $availableAttribute['slug'] }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Mentés</button>
                </div>

            </form>
        </div>
    </div>
@endsection
