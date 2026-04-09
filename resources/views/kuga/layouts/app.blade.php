<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="KUGA Barbershop - Barbershop modern dengan layanan premium untuk pria. Potong rambut, styling, grooming terbaik.">
    <meta name="keywords" content="barbershop, potong rambut, grooming, KUGA, barbershop modern">
    <title>KUGA Barbershop - Life Begins After Haircut</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('styles')
</head>
<script>
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark')
    } else {
        document.documentElement.classList.remove('dark')
    }
</script>

<body class="bg-white text-emerald-950 dark:bg-emerald-950 dark:text-emerald-50 antialiased transition-colors duration-300 ease-in-out">
    <!-- HEADER & NAVIGATION -->
    @include('kuga.partials.header')

    <div class="content">
        @yield('content')
        {{ $slot ?? '' }}
    </div>

    <!-- FOOTER -->
    @include('kuga.partials.footer')


    {{-- <script src="{{ asset('js/script.js') }}"></script> --}}
    @livewireScripts
</body>

</html>