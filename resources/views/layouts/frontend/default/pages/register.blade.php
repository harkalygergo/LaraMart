<!-- create a register form -->
@extends(env('LAYOUT').'.base')

<!-- create a form only with email and password -->
@section('main')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Regisztráció</h2>
            <form action="/regisztracio" method="POST">
                @csrf
                <!-- create name, phone input fields -->
                <div class="form-group mb-3">
                    <label for="name">Név:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group mb-3">
                    <label for="phone">Telefonszám:</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="+36..." required>
                </div>
                <div class="form-group mb-3">
                    <label for="email">E-mail cím:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group mb-3">
                    <label for="zip">Irányítószám:</label>
                    <input type="number" class="form-control" id="zip" name="zip" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password">Jelszó:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="d-grid gap mb-3">
                    <button type="submit" class="btn btn-primary">Regisztráció</button>
                    <a href="/profil" class="mt-5 btn btn-fluid btn-secondary">Már van fiókom, belépek</a>
                </div>
            </form>
        </div>
    </div>
@endsection
