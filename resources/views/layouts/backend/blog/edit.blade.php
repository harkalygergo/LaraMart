@extends('layouts.backend.base')

@section('main')
    <div class="container">
        <h1>Bejegyzés szerkesztése</h1>
        <form action="{{ route('admin.blog.edit', $blog->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Cím</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $blog->title }}">
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" value="{{ $blog->slug }}">
            </div>
            <div class="form-group">
                <label for="excerpt">Rövid leírás</label>
                <input type="text" class="form-control" id="excerpt" name="excerpt" value="{{ $blog->excerpt }}">
            </div>
            <div class="form-group">
                <label for="content">Tartalom</label>
                <textarea class="form-control" id="content" name="content" rows="20">{{ $blog->content }}</textarea>
            </div>
            <button type="submit" class="btn btn-lg btn-primary my-3 btn-fluid">Mentés</button>
        </form>

        <hr>

        <form class="py-Vezérlőpult5" action="{{ route('admin.blog.edit', $blog->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">🗑 végleges törlés</button>
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
