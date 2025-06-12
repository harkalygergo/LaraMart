@extends('layouts.backend.base')

@section('main')
    <h2><i class="bi bi-menu-button-wide-fill mx-3"></i>Információs oldal létrehozása</h2>
    <form action="{{ route('addInfo') }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Megnevezés</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Link</label>
            <input type="text" class="form-control" id="slug" name="slug" required>
        </div>
        <div class="mb-3">
            <label for="position" class="form-label">Tartalom</label>
            <!-- textarea for content -->
            <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
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
