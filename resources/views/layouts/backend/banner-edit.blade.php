@extends('layouts.backend.base')

@section('main')
    <h2><i class="bi bi-images mx-3"></i> Banner szerkesztése</h2>

    @if (isset($data))
        <form action="{{ route('editBanner', ['id' => $data->id]) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="mediaURL" class="form-label">Kép URL</label>
                <input type="text" class="form-control" id="mediaURL" name="mediaURL" value="{{ $data->mediaURL }}" required>
            </div>
            <div class="mb-3">
                <label for="href" class="form-label">Cél URL</label>
                <input type="text" class="form-control" id="href" name="href" value="{{ $data->href }}">
            </div>
            <div class="mb-3">
                <label for="hrefTarget" class="form-label">Cél típus</label>
                <select class="form-select" id="hrefTarget" name="hrefTarget">
                    <option value="_self" @if ($data->hrefTarget == '_self') selected @endif>Ugyanazon az oldalon</option>
                    <option value="_blank" @if ($data->hrefTarget == '_blank') selected @endif>Új ablakban</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="position" class="form-label">Pozíció</label>
                <input type="number" class="form-control" id="position" name="position" min="0" value="{{ $data->position }}" required>
            </div>
            <button type="submit" class="btn btn-primary btn-lg">Mentés</button>
        </form>
    @endif
@endsection
