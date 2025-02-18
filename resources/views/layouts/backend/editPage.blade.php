@extends('layouts.backend.base')

@section('main')
    <div class="container">
        <h1>Oldal szerkesztése</h1>
        <form action="{{ route('editPage', $page->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Cím</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $page->title }}">
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" value="{{ $page->slug }}">
            </div>
            <div class="form-group">
                <label for="excerpt">Rövid leírás</label>
                <input type="text" class="form-control" id="excerpt" name="excerpt" value="{{ $page->excerpt }}">
            </div>
            <div class="form-group">
                <label for="content">Tartalom</label>
                <textarea class="form-control" id="content" name="content" rows="20">{{ $page->content }}</textarea>
            </div>
            <div class="form-group">
                <label for="position">Pozíció</label>
                <input type="number" class="form-control" id="position" name="position" value="{{ $page->position }}">
            </div>
            <button type="submit" class="btn btn-lg btn-primary my-3 btn-fluid">Mentés</button>
        </form>

        <hr>

        <form class="py-5" action="{{ route('editPage', $page->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Végleges törlés</button>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $('#content').summernote({
                lang: "hu-HU"
            });
        });
    </script>
@endsection
