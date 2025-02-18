@extends('layouts.backend.base')

@section('main')
    <h2>Beállítások</h2>

    <form method="post" action="{{ route('admin_v1_settings') }}">
        @csrf
        @foreach ($settings as $setting)
            <div class="mb-3">
                <label for="site_title" class="form-label fw-bold">{{ $setting->key }}</label>
                @if (strlen($setting->value) > 200)
                    <textarea class="form-control" id="{{ $setting->key }}" name="{{ $setting->key }}" rows="5">
                        {{ $setting->value }}
                    </textarea>
                @else
                    <input type="text" class="form-control" id="{{ $setting->key }}" name="{{ $setting->key }}" value="{{ $setting->value }}">
                @endif
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Mentés</button>
    </form>

@endsection
