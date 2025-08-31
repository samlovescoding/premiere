<div class="max-w-3xl mx-auto py-4">
    <h1 class="text-4xl">Welcome!</h1>

    <div class="flex gap-2 my-4">
        @auth
            <div class="flex flex-col gap-4 w-full">
                <div>
                <flux:button size="sm" href="{{ route('home') }}" wire:navigate>
                    Go to Dashboard
                </flux:button>
                </div>
                <flux:text>
                    Already logged in as {{ auth()->user()->name }}.
                </flux:text>
            </div>
        @else
            <flux:button size="sm" href="{{ route('login') }}" wire:navigate>Login</flux:button>
            <flux:button size="sm" href="{{ route('register') }}" wire:navigate>Register</flux:button>
        @endauth
    </div>
</div>
