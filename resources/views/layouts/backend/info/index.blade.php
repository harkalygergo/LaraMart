@extends('layouts.backend.base')

@section('main')
    <h2><i class="bi bi-layout-text-sidebar-reverse mx-3"></i> Információ</h2>
    <a href="{{ route('addInfo') }}" class="btn btn-primary mb-3">Új információs oldal</a>
    @if (isset($data))
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Cím</th>
                    <th>Slug</th>
                    <th>Státusz</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($data as $d)
                    <tr>
                        <td>{{ $loop->index + 1 }}.</td>
                        <td>{{ $d->title }}</td>
                        <td>{{ $d->slug }}</td>
                        <td>{{ $d->status }}</td>
                        <td>
                            <a target="_blank" href="{{ route('info.show', $d->slug) }}" class="btn btn-secondary">𓁹 megtekint</a>
                            <a href="{{ route('editInfo', $d->id) }}" class="btn btn-primary">🖉 Szerkesztés</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
