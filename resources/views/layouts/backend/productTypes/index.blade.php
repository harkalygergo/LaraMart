@extends('layouts.backend.base')

@section('main')
    <h2>Terméktípusok</h2>
    <button class="btn btn-primary mb-3" onclick="window.location.href='/admin/v1/product-type/add'">Új terméktípus</button>
    @if (isset($data))
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-sm table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th class="col">Megnevezés</th>
                    <th class="col">Slug</th>
                    <th class="col">Leírás</th>
                    <th class="col">Eszközök</th>
                </tr>
                </thead>
                <tbody class="table-group-divider">
                @foreach ($data as $page)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}.</th>
                        <td>{{ $page->name }}</td>
                        <td>{{ $page->slug }}</td>
                        <td>{{ $page->description }}</td>
                        <td>
                            <a href="/admin/v1/product-type/edit/{{ $page->id }}" class="btn btn-sm btn-primary">Szerkesztés</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
