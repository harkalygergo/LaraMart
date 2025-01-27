@extends('layouts.backend.base')

@section('main')
    <h2><i class="bi bi-menu-button-wide-fill mx-3"></i>Főmenü </h2>
    <a href="{{ route('admin.menu.add') }}" class="btn btn-primary mb-3">Új menü</a>
    @if (isset($data))
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Kép</th>
                    <th>Megnevezés</th>
                    <th>Link</th>
                    <th>Pozíció</th>
                    <th>Aktív?</th>
                    <th>Eszközök</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($data as $d)
                    <tr>
                        <td>{{ $loop->index + 1 }}.</td>
                        <td><img class="img-thumbnail" src="{{ $d->image_url }}" alt="{{ $d->title }}"></td>
                        <td>{{ $d->title }}</td>
                        <td>{{ $d->link }}</td>
                        <td>{{ $d->position }}</td>
                        <td>@if($d->is_active) igen @else nem @endif </td>
                        <td>
                            <a href="{{ route('admin.menu.edit', $d->id) }}" class="btn btn-primary">🖉 Szerkesztés</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
