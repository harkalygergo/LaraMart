@php
    use App\Http\Controllers\Backend\SettingsController;
    $settings = (new SettingsController())->getSettings();
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if (config('app.env') === 'production')
        <meta name="robots" content="index, follow">
    @else
        <meta name="robots" content="noindex, nofollow">
    @endif

    <link rel="shortcut icon" href="/favicon.ico">

    <!-- check if user is not logged in -->
    @if (!auth()->check())
        {!! $settings['HEAD_CODE_NOT_LOGGED_IN'] !!}
    @else
        <!-- if user is logged in, but not an admin -->
        @if (!auth()->user()->is_admin)
            @if (isset($settings['HEAD_CODE_LOGGED_IN_NOT_ADMIN']))
                {!! $settings['HEAD_CODE_LOGGED_IN_NOT_ADMIN'] !!}
            @endif
        @endif
    @endif

    <title>@yield('title'){{ $settings['site_title'] }}</title>
    <meta name="description" content="{{ $settings['site_description'] }}">

    @if (isset($settings['GOOGLE_SITE_VERIFICATION']) && $settings['GOOGLE_SITE_VERIFICATION'])
        <meta name="google-site-verification" content="{{ $settings['GOOGLE_SITE_VERIFICATION'] }}" />
    @endif

    <!--
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    -->

    <link rel="stylesheet" type="text/css" href="https://cdn.brandcomstudio.com/vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.brandcomstudio.com/vendor/twbs/bootstrap-icons/font/bootstrap-icons.min.css">
    <script src="https://cdn.brandcomstudio.com/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.brandcomstudio.com/node_modules/viewerjs/dist/viewer.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Corben:wght@400;700&display=swap" rel="stylesheet">

    <meta property="og:image" content="https://harkalygergo.github.io/oraplacchu.png" />

    <style>
        :root {
            --primary-color: #9e6740;
            --secondary-color: #f5efeb;
        }

        .primary-color {
            color: var(--primary-color);
        }

        body {
            background-color: var(--secondary-color);
        }

        input.form-control {
            border-color: var(--primary-color);
            border-radius: 50px;
        }

        .btn {
            border-radius: 50px;
        }

        .btn-primary {
            background-color: white;
            border-color: var(--primary-color);
            color: var(--primary-color);
            border-radius:50px;
        }

        .btn-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        footer {
            background-color: var(--primary-color);
        }

        .corben-regular {
            font-family: "Corben", serif;
            font-weight: 400;
            font-style: normal;
        }

        .corben-bold {
            font-family: "Corben", serif;
            font-weight: 700;
            font-style: normal;
        }

        .card img.card-img-top {
            width: 100%;
            height: 15vw;
            object-fit: cover;
        }
    </style>


</head>
<body id="frontend">

<div class="container py-3">

    @include(env('LAYOUT') . '.header')

    @include(env('LAYOUT').'.nav', [
        'menus' => $menus
    ])

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

    <main>

        @yield('main')

    </main>
</div>

@include(env('LAYOUT').'.footer')

<script src="https://cdn.brandcomstudio.com/vendor/components/jquery/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.14.0/jquery-ui.min.js" integrity="sha256-Fb0zP4jE3JHqu+IBB9YktLcSjI1Zc6J2b6gTjB0LpoM=" crossorigin="anonymous"></script>
<script src="https://cdn.brandcomstudio.com/node_modules/viewerjs/dist/viewer.min.js"></script>

</body>
</html>
