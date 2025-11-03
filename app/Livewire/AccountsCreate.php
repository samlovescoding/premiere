<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\User;

class AccountsCreate extends Component
{
    #[Validate('required|string|min:3')]
    public string $name;

    #[Validate('required|email')]
    public string $email;

    #[Validate('required|min:8')]
    public string $password;

    #[Validate('required|same:password')]
    public string $passwordConfirmation;

    public function generatePassword()
    {
        $this->password = Str::random(16);
    }


    public function submit()
    {
        $fields = $this->validate();

        User::create($fields);
        return $this->redirect(route('accounts'), navigate: true);
    }

    public function render()
    {
        return view('accounts-create');
    }
}
