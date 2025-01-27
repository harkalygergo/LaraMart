@extends('layouts.backend.base')

@section('main')
    <h2><i class="bi bi-menu-button-wide-fill mx-3"></i>Főmenü szerkesztése</h2>
    <form action="{{ route('admin.menu.edit', $data->id) }}" method="post">
        @csrf
        @method('POST')
        <div class="mb-3">
            <label for="title" class="form-label">Megnevezés</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $data->title }}">
        </div>
        <div class="mb-3">
            <label for="link" class="form-label">Link</label>
            <input type="text" class="form-control" id="link" name="link" value="{{ $data->link }}">
        </div>
        <div class="mb-3">
            <label for="image_url" class="form-label">Kép</label>
            <input type="text" class="form-control" id="image_url" name="image_url" value="{{ $data->image_url }}">
        </div>
        <div class="mb-3">
            <label for="position" class="form-label">Pozíció</label>
            <input type="number" class="form-control" id="position" name="position" value="{{ $data->position }}">
        </div>
        <div class="mb-3">
            <label for="is_active" class="form-label">Aktív?</label>
            <select class="form-select" id="is_active" name="is_active">
                <option value="1" @if ($data->is_active == 1) selected @endif>Igen</option>
                <option value="0" @if ($data->is_active == 0) selected @endif>Nem</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Mentés</button>
    </form>
@endsection
