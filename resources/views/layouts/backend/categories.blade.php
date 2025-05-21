@extends('layouts.backend.base')

@section('main')
    <h2>Kategóriák</h2>
    <a href="/admin/v1/category/create" class="btn btn-primary mb-3">Új kategória</a>
    @if (isset($data))
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Cím</th>
                    <th>Név</th>
                    <th>Slug</th>
                    <th>Terméktípus</th>
                    <th>Szülő</th>
                    <th>Eszközök</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($data as $category)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>@if(!is_null($category->productType)){{ $category->productType->name }}@endif</td>
                        <td>{{ $category->parent_id }}</td>
                        <td>
                            <a href="/admin/v1/category/edit/{{ $category->id }}" class="btn btn-primary">Szerkesztés</a>
                            <form action="/admin/v1/category/{{ $category->id }}" method="POST">
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
