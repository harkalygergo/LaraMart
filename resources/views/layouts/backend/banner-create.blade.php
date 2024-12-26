@extends('layouts.backend.base')

@section('main')
    <h2><i class="bi bi-images mx-3"></i> Új banner</h2>
    <form action="{{ route('newBanner') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="mediaURL" class="form-label">Kép URL (kötelező)</label>
            <input type="text" class="form-control" id="mediaURL" name="mediaURL" placeholder="https://..." required>
        </div>
        <div class="mb-3">
            <label for="href" class="form-label">Cél URL (opcionális)</label>
            <input type="text" class="form-control" id="href" placeholder="https://..."  name="href">
        </div>
        <div class="mb-3">
            <label for="hrefTarget" class="form-label">Cél típus</label>
            <select class="form-select" id="hrefTarget" name="hrefTarget">
                <option value="_self">Ugyanazon az oldalon</option>
                <option value="_blank">Új ablakban</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="position" class="form-label">Pozíció (kötelező)</label>
            <input type="number" class="form-control" id="position" name="position" min="0" value="0" required>
        </div>
        <button type="submit" class="btn btn-primary btn-lg">Mentés</button>
    </form>
@endsection
