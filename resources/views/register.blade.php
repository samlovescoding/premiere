<x-form class="w-80 max-w-80 space-y-6" wire:submit="handle">
    <flux:heading class="text-center" size="xl">
        Create an account
    </flux:heading>

    <div class="flex flex-col gap-6">
        <flux:input wire:model="name" label="Name" placeholder="Your name"/>
        <flux:input wire:model="email" label="Email" type="email" placeholder="email@example.com"/>
        <flux:input wire:model="password" label="Password" type="password" placeholder="Your password"/>
        <flux:input wire:model="password_confirmation" label="Re-enter Password" type="password"
                    placeholder="Re-enter password"/>

        <flux:field variant="inline">
            <flux:checkbox wire:model="terms"/>
            <flux:label>
                I agree to the terms and conditions.
            </flux:label>
            <flux:error name="terms"/>
        </flux:field>

        <flux:button type="submit" variant="primary" class="w-full">
            Submit
        </flux:button>
    </div>

    <flux:subheading class="text-center">
        Already have an account?
        <flux:link href="{{ route('login') }}">
            Login instead
        </flux:link>
    </flux:subheading>
</x-form>
