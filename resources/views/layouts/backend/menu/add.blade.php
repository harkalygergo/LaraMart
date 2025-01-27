@extends('layouts.backend.base')

@section('main')
    <h2><i class="bi bi-menu-button-wide-fill mx-3"></i>Főmenü létrehozása</h2>
    <form action="{{ route('admin.menu.add') }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Megnevezés</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="link" class="form-label">Link</label>
            <input type="text" class="form-control" id="link" name="link" required>
        </div>
        <div class="mb-3">
            <label for="image_url" class="form-label">Kép</label>
            <input type="text" class="form-control" id="image_url" name="image_url">
        </div>
        <div class="mb-3">
            <label for="position" class="form-label">Pozíció</label>
            <input type="number" class="form-control" id="position" name="position" required>
        </div>
        <div class="mb-3">
            <label for="is_active" class="form-label">Aktív?</label>
            <select class="form-select" id="is_active" name="is_active">
                <option value="1">Igen</option>
                <option value="0">Nem</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Mentés</button>
    </form>
@endsection
