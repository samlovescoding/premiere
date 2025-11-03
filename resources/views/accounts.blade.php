<div>
  <div class="flex justify-between items-center">
    <flux:heading size="xl">Accounts</flux:heading>
    <flux:button
      size="sm"
      icon="user-plus"
      href="{{ route('accounts.create') }}"
    >
      Add Person
    </flux:button>
  </div>
  <flux:separator
    variant="subtle"
    class="my-8"
  />

  <div class="grid grid-cols-3 gap-4">
    @foreach ($this->users as $user)
      <flux:card>
        <div>
          <strong>
            {{ $user->name }}
          </strong>
        </div>
        <div>
          {{ $user->email }}
        </div>
      </flux:card>
    @endforeach
  </div>
</div>
