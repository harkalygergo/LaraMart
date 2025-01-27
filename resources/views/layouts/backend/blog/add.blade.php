@extends('layouts.backend.base')

@section('main')
    <div class="container">
        <h1>Blogbejegyzés létrehozása</h1>
        <form action="{{ route('admin.blog.add') }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Cím</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" required>
            </div>
            <div class="form-group">
                <label for="excerpt">Rövid leírás</label>
                <input type="text" class="form-control" id="excerpt" name="excerpt">
            </div>
            <div class="form-group">
                <label for="content">Tartalom</label>
                <textarea class="form-control" id="content" name="content" rows="20"></textarea>
            </div>
            <button type="submit" class="btn btn-lg btn-primary my-3 btn-fluid">Mentés</button>
        </form>

        <hr>

    </div>
    <script>
        $(document).ready(function() {
            $('#content').summernote();
        });
    </script>
@endsection
