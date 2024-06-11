<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-white antialiased">
    <div class="flex flex-col items-center justify-center min-h-screen pt-6 sm:pt-0 bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 dark:text-gray-600 selection:bg-neutral-300 selection:text-neutral-900">
        <div class="text-4xl text-white text-center hover:text-gray-600">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </div>

        <div class="w-11/12 sm:max-w-md mt-6 px-6 py-4 bg-transparent shadow-2xl overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>