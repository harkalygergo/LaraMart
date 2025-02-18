@extends('layouts.backend.base')

@section('main')
    <h2>Kereskedők</h2>
    <a href="/admin/v1/merchant/create" class="btn btn-primary mb-3">Új kereskedő</a>
    @if (isset($data))
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Név</th>
                    <th>Adószám</th>
                    <th>Telefonszám</th>
                    <th>E-mail</th>
                    <th>Irányítószám</th>
                    <th>Település</th>
                    <th>Utca, házszám</th>
                    <th>Eszközök</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($data as $merchant)
                    <tr>
                        <td>{{ $loop->index + 1 }}.</td>
                        <td>{{ $merchant->name }}</td>
                        <td>{{ $merchant->vat }}</td>
                        <td>{{ $merchant->phone }}</td>
                        <td>{{ $merchant->email }}</td>
                        <td>{{ $merchant->zip }}</td>
                        <td>{{ $merchant->city }}</td>
                        <td>{{ $merchant->address }}</td>
                        <td>
                            <a href="/admin/v1/merchant/edit/{{ $merchant->id }}" class="btn btn-primary">Szerkesztés</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
