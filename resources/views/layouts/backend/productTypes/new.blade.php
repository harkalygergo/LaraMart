@extends('layouts.backend.base')

@section('main')

    <div class="row">
        <div class="col-12">
            <h2 class="py-3 text-center">Új terméktípus</h2>
        </div>
        <div class="col-md-12">
            <form action="/admin/v1/product-type/add" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="form-group mb-3">
                    <label for="name">Megnevezés:</label>
                    <input type="text" class="form-control" id="name" name="name" required placeholder="például: Mobiltelefon">
                </div>
                <div class="form-group mb-3">
                    <label for="slug">Slug:</label>
                    <input type="text" class="form-control" id="slug" name="slug" required placeholder="például: mobiltelefon">
                </div>
                <div class="form-group mb-3">
                    <label for="description">Leírás:</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required placeholder="például: Mobiltelefonok, okostelefonok, stb."></textarea>
                </div>

                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Mentés</button>
                </div>

            </form>
        </div>
    </div>
@endsection
