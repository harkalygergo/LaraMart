@extends('layouts.backend.base')

@section('main')
    <h2>Felhasználók</h2>
    @if (isset($data))
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Név</th>
                    <th>Telefonszám</th>
                    <th>E-mail</th>
                    <th>Irányítószám</th>
                    <th>Település</th>
                    <th>Utca, házszám</th>
                    <th>Számlázási irányítószám</th>
                    <th>Számlázási település</th>
                    <th>Számlázási utca, házszám</th>
                    <th>Eszközök</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($data as $user)
                        <tr>
                            <td>{{ $loop->index + 1 }}.</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->zip }}</td>
                            <td>{{ $user->city }}</td>
                            <td>{{ $user->address }}</td>
                            <td>{{ $user->billing_zip }}</td>
                            <td>{{ $user->billing_city }}</td>
                            <td>{{ $user->billing_address }}</td>
                            <td>
                                <a href="/admin/v1/user/edit/{{ $user->id }}" class="btn btn-primary">Szerkesztés</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
