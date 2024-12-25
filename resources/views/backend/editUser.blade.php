<!-- create a form for editing user -->
@extends('layouts.backend.base')

@section('main')
    <h2>Felhasználó szerkesztése</h2>
    <form action="{{ route('editUser', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="name">Név:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>
        <!-- add phone input field -->
        <div class="form-group mb-3">
            <label for="phone">Telefonszám:</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" required>
        </div>
        <!-- add email input field -->
        <div class="form-group mb-3">
            <label for="email">E-mail:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>
        <!-- add zip input field -->
        <div class="form-group mb-3">
            <label for="zip">Irányítószám:</label>
            <input type="text" class="form-control" id="zip" name="zip" value="{{ $user->zip }}" required>
        </div>
        <!-- add city input field -->
        <div class="form-group mb-3">
            <label for="city">Település:</label>
            <input type="text" class="form-control" id="city" name="city" value="{{ $user->city }}" required>
        </div>
        <!-- add address input field -->
        <div class="form-group mb-3">
            <label for="address">Utca, házszám:</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}" required>
        </div>
        <!-- add billing_zip input field -->
        <div class="form-group mb-3">
            <label for="billing_name">Számlázási név:</label>
            <input type="text" class="form-control" id="billing_name" name="billing_name" value="{{ $user->billing_name }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="billing_zip">Számlázási irányítószám:</label>
            <input type="text" class="form-control" id="billing_zip" name="billing_zip" value="{{ $user->billing_zip }}" required>
        </div>
        <!-- add billing_city input field -->
        <div class="form-group mb-3">
            <label for="billing_city">Számlázási település:</label>
            <input type="text" class="form-control" id="billing_city" name="billing_city" value="{{ $user->billing_city }}" required>
        </div>
        <!-- add billing_address input field -->
        <div class="form-group mb-3">
            <label for="billing_address">Számlázási utca, házszám:</label>
            <input type="text" class="form-control" id="billing_address" name="billing_address" value="{{ $user->billing_address }}" required>
        </div>

        <!-- add is_admin select option -->
        <div class="form-group mb-3">
            <label for="is_admin">Adminisztrátor:</label>
            <select class="form-control" id="is_admin" name="is_admin" required>
                <option value="0" @if ($user->is_admin == 0) selected @endif>Nem</option>
                <option value="1" @if ($user->is_admin == 1) selected @endif>Igen</option>
            </select>
        </div>


        <div class="d-grid gap mb-3">
            <button type="submit" class="btn btn-primary">Felhasználó szerkesztése</button>
            <a href="/admin/v1/users" class="mt-5 btn btn-fluid btn-secondary">Vissza a felhasználókhoz</a>
        </div>
    </form>
@endsection
