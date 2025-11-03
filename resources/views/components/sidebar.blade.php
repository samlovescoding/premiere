<div class="contents">
  <flux:sidebar
    @class([
        'border-r border-zinc-200 bg-zinc-50 rtl:border-l rtl:border-r-0',
        'dark:border-zinc-700 dark:bg-zinc-900',
    ])
    stashable
    sticky
  >

    <flux:sidebar.toggle
      class="lg:hidden"
      icon="x-mark"
    />

    <flux:navlist variant="outline">
      <x-sidebar-link
        href="{{ route('home') }}"
        icon="home"
      >
        Home
      </x-sidebar-link>
      <x-sidebar-link
        href="#"
        icon="film"
      >
        Movies
      </x-sidebar-link>
      <x-sidebar-link
        href="#"
        icon="tv"
      >
        TV Shows
      </x-sidebar-link>
    </flux:navlist>
    <flux:spacer />
    <flux:navlist variant="outline">
      <x-sidebar-link
        href="{{ route('accounts') }}"
        icon="user-group"
      >
        Accounts
      </x-sidebar-link>
      <x-sidebar-link
        href="{{ route('settings') }}"
        icon="cog-6-tooth"
      >
        Settings
      </x-sidebar-link>
      <flux:navlist.item
        icon="arrow-right-start-on-rectangle"
        wire:click.prevent="logout"
      >
        Logout
      </flux:navlist.item>
    </flux:navlist>
  </flux:sidebar>

  @hasSection('header')
    {{--  Dont render toggle if header exists  --}}
  @else
    <flux:header class="lg:hidden">
      <flux:sidebar.toggle
        class="lg:hidden"
        icon="bars-2"
        inset="left"
      />
    </flux:header>
  @endif
</div>
