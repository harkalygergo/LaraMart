@extends('layouts.backend.base')

@section('main')
    <h2>Oldalak</h2>
    <button class="btn btn-primary mb-3" onclick="window.location.href='/admin/v1/page/add'">Új oldal</button>
    @if (isset($data))
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Cím</th>
                    <th>URL</th>
                    <th>Pozíció</th>
                    <th>Rövid leírás</th>
                    <th>Eszközök</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($data as $page)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $page->id }}</td>
                            <td>{{ $page->title }}</td>
                            <td>{{ $page->slug }}</td>
                            <td>{{ $page->position }}</td>
                            <td>{{ $page->excerpt }}</td>
                            <td>
                                <a href="/admin/v1/page/edit/{{ $page->id }}" class="btn btn-sm btn-primary">Szerkesztés</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
