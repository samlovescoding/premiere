@props([
    'title' => config('app.name'),
])
<x-html :title="$title">
    <main @class(["min-h-screen bg-background w-full"])>
        <livewire:sidebar/>
        <flux:main>
            @yield('header')
            {{ $slot }}
        </flux:main>
    </main>
</x-html>
