@props([
    'title' => 'Delete',
    'id' => 'delete'
])
<flux:modal.trigger name="{{ $id }}">
    <flux:button variant="subtle">
        @if($slot->hasActualContent())
            {{ $slot }}
        @else
            {{ $title }}
        @endif
    </flux:button>
</flux:modal.trigger>
