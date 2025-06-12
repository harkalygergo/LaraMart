@extends('layouts.backend.base')

@section('main')
    <h2><i class="bi bi-menu-button-wide-fill mx-3"></i>Információs oldal szerkesztése</h2>
    <form action="{{ route('editInfo', ['id' => $info->id]) }}" method="post">
        @csrf
        @method('POST')
        <div class="mb-3">
            <label for="title" class="form-label">Megnevezés</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $info->title }}" required>
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Link</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{ $info->slug }}" required>
        </div>
        <div class="mb-3">
            <label for="position" class="form-label">Tartalom</label>
            <!-- textarea for content -->
            <textarea class="form-control" id="content" name="content" rows="5" required>{{ $info->content }}</textarea>
        </div>
        <div class="mb-3">
            <label for="is_active" class="form-label">Aktív?</label>
            <select class="form-select" id="is_active" name="is_active">
                <option value="1" @if($info->status) selected @endif>Igen</option>
                <option value="0" @if(!$info->status) selected @endif>Nem</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Mentés</button>
    </form>
@endsection
