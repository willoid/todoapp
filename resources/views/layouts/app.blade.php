<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('path/to/your-component.svg') }}" type="image/svg+xml">
    <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:wght@100..900&display=swap" rel="stylesheet">
    <title>ADHD TO DO LIST</title>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col items-center justify-center text-white">
<header class="w-full">
    @include('partials.header')
</header>
<main class="flex-1 w-full text-center">
    @yield('content')
</main>
<footer class="mt-8 mb-5 text-sm text-white">
    @include('partials.footer')
</footer>
</body>
</html>
