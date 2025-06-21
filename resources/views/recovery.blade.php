<x-form class="w-80 max-w-80 space-y-6" wire:submit="handle">
    <flux:heading class="text-center" size="xl">
        Account Recovery
    </flux:heading>

    <flux:text>
        @if($isCodeSent)
            Code has been sent to {{ $email }}
        @else
            We will send you an email with 6 digit code to recover your account.
            You must enter the code within 10 minutes. Please check your spam folder.
        @endif
    </flux:text>

    <div class="flex flex-col gap-6">

        <flux:field>
            <div class="mb-3 flex justify-between">
                <flux:label>Email</flux:label>

                @if($isCodeSent)
                    <flux:button type="button" size="xs" variant="subtle" class="text-sm cursor-pointer"
                                 wire:click.prevent="sendCode">
                        Resend Code
                    </flux:button>
                @endif
            </div>
            <flux:input wire:model="email" type="email" placeholder="Your email" :disabled="$isCodeSent"/>
            <flux:error name="email"/>
        </flux:field>

        @if($isCodeSent)
            <flux:input wire:model="code" label="Code" type="number" placeholder="Your 6 digit code"
                        :disabled="$isCodeValid"/>
        @endif

        @if($isCodeValid)
            <flux:input wire:model="password" label="Password" type="password" placeholder="Your password"/>
            <flux:input wire:model="password_confirmation" label="Re-enter Password" type="password"
                        placeholder="Re-enter password"/>


            <flux:button type="submit" variant="primary" class="w-full">
                Change Password
            </flux:button>
        @else
        @endif

        @if(!$isCodeSent)
            <flux:button type="button" variant="primary" class="w-full" wire:click.prevent="sendCode">
                Send Code
            </flux:button>
        @endif
        @if($isCodeSent && !$isCodeValid)
            <flux:button type="button" variant="primary" class="w-full" wire:click.prevent="validateCode">
                Validate Code
            </flux:button>
        @endif
    </div>

    <flux:subheading class="flex w-full items-center justify-center gap-3 mt-20">
        <flux:link variant="ghost" href="{{ route('login') }}">
            Login
        </flux:link>
        or
        <flux:link variant="ghost" href="{{ route('register') }}">
            Create an Account
        </flux:link>
    </flux:subheading>
</x-form>
