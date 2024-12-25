@extends('layouts.backend.base')

@section('main')
    <h2>Kereskedői hirdetések</h2>
    @if (isset($data))
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Kereskedő</th>
                    <th>Cím</th>
                    <th>Leírás</th>
                    <th>Ár</th>
                    <th>Kép</th>
                    <th>Eszközök</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($data as $ad)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $ad->merchant->name }}</td>
                        <td>{{ $ad->title }}</td>
                        <td>{{ $ad->description }}</td>
                        <td>{{ $ad->price }}</td>
                        <td><img src="{{ asset('storage/' . $ad->image) }}" alt="{{ $ad->title }}" style="width: 100px;"></td>
                        <td>
                            <a href="/admin/v1/user/ads/edit/{{ $ad->id }}" class="btn btn-primary">Szerkesztés</a>
                            <form action="/admin/v1/user/ads/{{ $ad->id }}" method="POST">
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
