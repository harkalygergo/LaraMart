@extends('layouts.backend.base')

@section('main')
    <h2>Oldalak</h2>
    <button class="btn btn-primary mb-3" onclick="window.location.href='/admin/v1/page/add'">Új oldal</button>
    @if (isset($data))
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-sm table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th class="col">Cím</th>
                    <th class="col">URL</th>
                    <th class="col">Pozíció</th>
                    <th class="col">Rövid leírás</th>
                    <th class="col">Eszközök</th>
                </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($data as $page)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}.</th>
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
