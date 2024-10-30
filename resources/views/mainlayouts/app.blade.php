<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ETaxwala Business Solutions Pvt Ltd')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta name="theme-color" content="#dd2c00">
    <link rel="icon" href="{{ url(env('LINK') . 'img/favicon.png') }}" type="image/x-icon">
    @include('components.styles')
</head>
<body>
    <header class="sticky-top">
        @include('components.navbar')
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        @include('components.footer')
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    @include('components.scripts')
</body>
</html>
