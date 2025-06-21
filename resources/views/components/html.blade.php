@props(['title' => null, 'titleSeparator' => '|'])
@php
    $shouldRunVite = file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot'));
@endphp
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @class(["dark"])>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @isset($title)
        <title>
            @if (is_array($title))
                {{ implode($titleSeparator, $title) }}
            @else
                {{ $title }}
            @endif
        </title>
    @endisset

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

    @if ($shouldRunVite)
        @vite(['resources/css/app.css'])
    @endif
    @livewireStyles
    @fluxAppearance
</head>

<body>
{{ $slot }}
@if ($shouldRunVite)
    @vite(['resources/js/app.js'])
@endif
@livewireScripts
@fluxScripts
</body>

</html>
