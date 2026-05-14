<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Portfolio')</title>
    {{-- Google Fonts: Anton (Display), Space Grotesk (Sans), Space Mono (Mono) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Space+Grotesk:wght@300;500;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    {{-- Inline theme init to prevent FOUC --}}
    <script>
        (function() {
            var stored = null;
            try { stored = localStorage.getItem('theme-preference'); } catch(e) {}
            var theme = stored || (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            if (theme === 'dark') { document.documentElement.classList.add('dark'); }
        })();
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="min-h-screen flex flex-col bg-[var(--color-canvas)] text-[var(--color-white)]">
    <header>
        @include('components.navbar')
    </header>

    <main class="flex-1 pt-20">
        @yield('content')
    </main>

    <footer>
        @include('components.footer')
    </footer>
</body>
</html>
