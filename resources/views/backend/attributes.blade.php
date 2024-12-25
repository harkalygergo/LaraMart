@extends('layouts.backend.base')

@section('main')
    <h1>Attribútumok</h1>
    <a href="/admin/v1/attribute/create" class="btn btn-primary mb-3">Új attribútum</a>
    @if (isset($data))
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Név</th>
                    <th>Slug</th>
                    <th>Érték</th>
                    <th>Eszközök</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($data as $attribute)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $attribute->title }}</td>
                        <td>{{ $attribute->slug }}</td>
                        <td><i class="{{ $attribute->icon }}"></i> ({{ $attribute->icon }})</td>
                        <td>
                            <a href="/admin/v1/attribute/edit/{{ $attribute->id }}" class="btn btn-primary">Szerkesztés</a>
                            <form action="/admin/v1/attribute/{{ $attribute->id }}" method="POST">
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
