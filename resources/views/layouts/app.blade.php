<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ config('portfolio.role') }} — {{ config('portfolio.site_name') }}">
    <meta name="theme-color" content="#0a0a09">
    <title>@yield('title', config('portfolio.site_name'))</title>

    <script>
        (function () {
            try {
                var stored = localStorage.getItem('hb-theme');
                if (stored === 'light') {
                    document.documentElement.classList.remove('dark');
                } else {
                    document.documentElement.classList.add('dark');
                }
            } catch (error) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    @include('partials.fonts')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body id="top" class="site-body">

    <div class="grain" aria-hidden="true"></div>

    <div class="scroll-progress" aria-hidden="true">
        <span data-progress></span>
    </div>

    <div class="cursor" aria-hidden="true">
        <span class="cursor__dot" data-cursor-dot></span>
        <span class="cursor__ring" data-cursor-ring></span>
    </div>

    <a class="skip-link" href="#main">Skip to content</a>

    @include('partials.header')

    <main id="main">
        @yield('content')
    </main>

    @include('partials.footer')

</body>
</html>
