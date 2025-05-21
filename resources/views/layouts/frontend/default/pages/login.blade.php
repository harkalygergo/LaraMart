@extends(env('LAYOUT').'.base')

@section('main')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Bejelentkezés</h2>
            <form action="/profil" method="POST">
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
                    <button type="submit" class="mt-3 btn btn-fluid btn-primary">Bejelentkezés</button>
                    <a href="{{ route('register') }}" class="mt-2 btn btn-fluid btn-secondary">Regisztráció</a>
                    <a href="{{ route('passwordReset') }}" class="mt-2 btn btn-fluid btn-outline-secondary">Elfelejtett jelszó</a>
                </div>
            </form>
        </div>
    </div>
@endsection
