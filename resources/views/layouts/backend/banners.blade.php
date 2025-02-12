@extends('layouts.backend.base')

@section('main')
    <h2><i class="bi bi-images mx-3"></i> Bannerek</h2>
    <a href="/admin/v1/banners/new" class="btn btn-primary mb-3">Új banner</a>
    @if (isset($data))
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>URL</th>
                    <th>Link</th>
                    <th>Cél</th>
                    <th>Pozíció</th>
                    <th>Eszközök</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($data as $category)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td><img class="img-thumbnail" src="{{ $category->mediaURL }}" alt="{{ $category->id }}"></td>
                        <td>{{ $category->mediaURL }}</td>
                        <td>{{ $category->href }}</td>
                        <td>{{ $category->hrefTarget }}</td>
                        <td>{{ $category->position }}</td>
                        <td>
                            <a href="/admin/v1/banners/edit/{{ $category->id }}" class="btn btn-primary">Szerkesztés</a>
                            <form action="/admin/v1/banners/delete/{{ $category->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Törlés</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
