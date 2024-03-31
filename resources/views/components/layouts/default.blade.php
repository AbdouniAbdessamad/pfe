<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ isset($title) ? "{$title} |" : null}} {{config('app.name')}}</title>

        {{ $head ?? null }}
        @vite(['resources/css/app.scss', 'resources/js/app.js'])

    </head>
    <body class="font-sans antialiased dark:bg-gray-900 text-gray-900 dark:text-gray-200 scroll-smooth">
        {{-- <x-layouts.header/> --}}

        {{ $slot }}

        {{-- <x-layouts.footer/> --}}
    </body>
</html>
