<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @if (config('app.env') === 'production')
        <meta name="robots" content="index, follow">
    @else
        <meta name="robots" content="noindex, nofollow">
    @endif

    <link rel="shortcut icon" href="/favicon.png">

    <title>{{ env('APP_NAME') }}</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body id="frontend">

<div class="container py-3">

    @include('layouts.frontend.default.header')

    @include('layouts.frontend.default.nav')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <main class="p-3">

        @yield('main')

    </main>
</div>

@include('layouts.frontend.default.footer')

</body>
</html>
