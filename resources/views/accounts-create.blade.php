<div>
  <flux:heading size="xl">Create an Account</flux:heading>
  <flux:separator
    variant="subtle"
    class="my-8"
  />
  <x-form
    class="flex flex-col lg:flex-row gap-4 lg:gap-6"
    wire:submit="submit"
  >
    <div class="w-80">
      <flux:heading size="lg">Profile</flux:heading>
      <flux:subheading>This is how others will see you on the website.</flux:subheading>
    </div>
    <div class="flex-1 space-y-6">
      <flux:input
        wire:model="name"
        label="Your Name"
      />
      <flux:input
        wire:model="email"
        label="Email Address"
        type="email"
      />
      <flux:input
        wire:model="password"
        label="Password"
        type="password"
        viewable
      />
      <flux:input
        wire:model="passwordConfirmation"
        label="Confirm Password"
        type="password"
        viewable
      />

      <div class="flex justify-end items-center gap-4">
        <flux:button
          type="submit"
          variant="subtle"
          wire:click.prevent="generatePassword"
        >
          Generate Password
        </flux:button>
        <flux:button
          type="submit"
          variant="primary"
        >
          Create
        </flux:button>
      </div>
    </div>
  </x-form>

</div>
