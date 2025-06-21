<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Register extends Component
{

    #[Validate('required|min:1|max:255')]
    public $name;

    #[Validate('required|email|max:255|unique:users,email')]
    public $email;

    #[Validate('required|min:8')]
    public $password;

    #[Validate('same:password')]
    public $password_confirmation;

    #[Validate('accepted')]
    public $terms;

    public function handle()
    {
        $fields = $this->validate();
        $this->addError('email', 'Email is not registered. Please create an account first.');
        return $fields;
    }

    #[Title("Register")]
    public function render()
    {
        return view('register');
    }
}
