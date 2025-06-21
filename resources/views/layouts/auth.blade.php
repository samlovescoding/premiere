@props([
    'title' => config('app.name'),
])
<x-html :title="$title">
    <div @class(["flex min-h-screen py-4 bg-background"])>
        <div class="flex-1 flex justify-center items-center">
            {{ $slot }}
        </div>
    </div>
</x-html>
