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

    <link rel="shortcut icon" href="/favicon.ico">

    <!-- check if user is not logged in -->
    @if (!auth()->check())
        <meta name="google-site-verification" content="VzCSCU3Byyp98MmggyXqsOrv6u2xrzfA2gqySN0c2Vg" />
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-M8MDVS2G71"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'G-M8MDVS2G71');
        </script>
    @else
        <!-- if user is logged in, but not an admin -->
        @if (!auth()->user()->is_admin)
            <meta name="google-site-verification" content="VzCSCU3Byyp98MmggyXqsOrv6u2xrzfA2gqySN0c2Vg" />
            <!-- Google tag (gtag.js) -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=G-M8MDVS2G71"></script>
            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());
                gtag('config', 'G-M8MDVS2G71');
            </script>
        @endif
    @endif

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
