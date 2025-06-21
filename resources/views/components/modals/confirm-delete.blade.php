@props([
    'id' => 'delete',
    'item' => 'item',
])
<flux:modal name="{{ $id }}">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Delete this {{ $item }}?</flux:heading>
            <flux:text class="mt-2">
                <p>You're about to delete this {{ $item }}.</p>
                <p>This action cannot be reversed.</p>
            </flux:text>
        </div>
        <div class="flex gap-2">
            <flux:spacer/>
            <flux:modal.close>
                <flux:button variant="ghost">Cancel</flux:button>
            </flux:modal.close>
            <flux:button wire:click="delete" variant="danger">Delete {{ $item }}</flux:button>
        </div>
    </div>
</flux:modal>
