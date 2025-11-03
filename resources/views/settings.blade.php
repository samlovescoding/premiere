<div>
  <flux:heading size="xl">Settings</flux:heading>
  <flux:separator
    variant="subtle"
    class="my-8"
  />
  <x-form
    class="flex flex-col lg:flex-row gap-4 lg:gap-6"
    wire:submit="save"
  >
    <div class="w-80">
      <flux:heading size="lg">Profile</flux:heading>
      <flux:subheading>This is how others will see you on the site.</flux:subheading>

      <div>
        <div class="mt-6 flex items-center gap-2">
          <flux:avatar
            size="lg"
            color="auto"
            name="{{ $this->name }}"
            color:seed="{{ $this->id }}"
            :src="$this->profilePictureUrl"
          />
          <flux:text size="lg">{{ $this->name }}</flux:text>
        </div>
      </div>
    </div>
    <div class="flex-1 space-y-6">
      <flux:input
        wire:model="name"
        label="Your Name"
      />
      <flux:input
        wire:model="email"
        label="Email"
        type="email"
      />
      <flux:input
        wire:model="profilePicture"
        label="Change Profile Picture"
        type="file"
      />
      <div class="flex justify-end items-center gap-4">
        @if ($profileSuccess)
          <flux:text
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 10000)"
          >{{ $profileSuccess }}</flux:text>
        @endif
        @if ($profilePictureUrl)
          <flux:button
            type="submit"
            variant="subtle"
            wire:click.prevent="removeProfilePicture"
          >Remove Profile Picture</flux:button>
        @endif
        <flux:button
          type="submit"
          variant="primary"
        >Save profile</flux:button>
      </div>
    </div>
  </x-form>
  <flux:separator
    variant="subtle"
    class="my-8"
  />
  <x-form
    class="flex flex-col lg:flex-row gap-4 lg:gap-6"
    wire:submit="changePassword"
  >
    <div class="w-80">
      <flux:heading size="lg">Security</flux:heading>
      <flux:subheading>Manage your account security.</flux:subheading>
    </div>
    <div class="flex-1 space-y-6">
      <flux:input
        wire:model="currentPassword"
        label="Current Password"
        type="password"
        viewable
      />
      <flux:input
        wire:model="newPassword"
        label="New Password"
        type="password"
        viewable
      />
      <flux:input
        wire:model="newPasswordConfirmation"
        label="Confirm New Password"
        type="password"
        viewable
      />

      <div class="flex justify-end items-center gap-4">
        @if ($passwordSuccess)
          <flux:text>{{ $passwordSuccess }}</flux:text>
        @endif
        <flux:button
          type="submit"
          variant="primary"
        >Change Password</flux:button>
      </div>
    </div>
  </x-form>
</div>
