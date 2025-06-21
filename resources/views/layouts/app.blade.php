@props([
    'title' => config('app.name'),
])
<x-html :title="$title">
    {{ $slot }}
</x-html>
