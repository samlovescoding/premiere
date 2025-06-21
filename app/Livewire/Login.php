<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{

    #[Validate('required|email')]
    public $email;

    #[Validate('required|min:8')]
    public $password;

    public function handle()
    {
        $fields = $this->validate();
        $this->addError('email', 'Email is not registered. Please create an account first.');
        return $fields;
    }

    #[Title("Create an account")]
    public function render()
    {
        return view('login');
    }
}
