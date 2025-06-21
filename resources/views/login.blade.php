<x-form class="w-80 max-w-80 space-y-6" wire:submit="handle">
    <flux:heading class="text-center" size="xl">Login</flux:heading>


    @session('error')
    <flux:callout icon="exclamation-triangle" variant="secondary" inline>
        <flux:callout.heading>
            Not able to log in
        </flux:callout.heading>
        <flux:callout.text>{{ $value }}</flux:callout.text>
    </flux:callout>
    @endsession

    <div class="flex flex-col gap-6">
        <flux:input wire:model="email" label="Email" type="email" placeholder="email@example.com"/>

        <flux:field>
            <div class="mb-3 flex justify-between">
                <flux:label>Password</flux:label>
                <flux:link href="/recovery" variant="subtle" class="text-sm">
                    Forgot password?
                </flux:link>
            </div>
            <flux:input wire:model="password" type="password" placeholder="Your password" viewable/>
            <flux:error name="password"/>
        </flux:field>

        <flux:button type="submit" variant="primary" class="w-full">Log in</flux:button>
    </div>

    <flux:subheading class="text-center">
        First time around here?
        <flux:link href="{{ route('register') }}">
            Create an account
        </flux:link>
    </flux:subheading>
</x-form>
