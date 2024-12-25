@extends('layouts.backend.base')

@section('main')
    <h2>Új kereskedő hozzáadása</h2>
    <!-- create a form to add new merchant -->
    <form action="/admin/v1/merchant/create" method="POST">
        @csrf
        <div class="form-group mb-1">
            <label for="name">Név:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group mb-1">
            <label for="slug">Slug:</label>
            <input type="text" class="form-control" id="slug" name="slug" required>
        </div>
        <div class="form-group mb-1">
            <label for="image">Kép URL:</label>
            <input type="text" class="form-control" id="image" name="image">
        </div>
        <div class="form-group mb-1">
            <label for="website">Honlap:</label>
            <input type="text" class="form-control" id="website" name="website">
        </div>
        <div class="form-group mb-1">
            <label for="vat">Adószám:</label>
            <input type="text" class="form-control" id="vat" name="vat">
        </div>
        <div class="form-group mb-1">
            <label for="phone">Telefonszám:</label>
            <input type="text" class="form-control" id="phone" name="phone">
        </div>
        <div class="form-group mb-1">
            <label for="email">E-mail:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group mb-1">
            <label for="zip">Irányítószám:</label>
            <input type="text" class="form-control" id="zip" name="zip" required>
        </div>
        <div class="form-group mb-1">
            <label for="city">Település:</label>
            <input type="text" class="form-control" id="city" name="city">
        </div>
        <div class="form-group mb-1">
            <label for="address">Utca, házszám:</label>
            <input type="text" class="form-control" id="address" name="address">
        </div>
        <div class="form-group mb-1">
            <label for="password">Jelszó:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group mb-1">
            <label for="product_feed_url">Termék feed URL:</label>
            <input type="text" class="form-control" id="product_feed_url" name="product_feed_url">
        </div>
        <!-- create status select field with 0 inactive and 1 active options -->
        <div class="form-group mb-1">
            <label for="status">Státusz:</label>
            <select class="form-select" id="status" name="status" required>
                <option value="1">Aktív</option>
                <option value="0">Inaktív</option>
            </select>
        </div>
        <div class="d-grid gap mb-3">
            <button type="submit" class="btn btn-primary">Kereskedő hozzáadása</button>
            <a href="/admin/v1/merchants" class="mt-5 btn btn-fluid btn-secondary">Vissza a kereskedőkhöz</a>
        </div>
    </form>
@endsection
