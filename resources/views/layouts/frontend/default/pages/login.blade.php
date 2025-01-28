@extends('layouts.frontend.default.base')

@section('main')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Login</h2>
            <form action="/profile" method="POST">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="email">E-mail cím:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Jelszó:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="mt-3 btn btn-fluid btn-primary">Login</button>
                    <a href="{{ route('register') }}" class="mt-2 btn btn-fluid btn-secondary">Register</a>
                </div>
            </form>
        </div>
    </div>
@endsection
