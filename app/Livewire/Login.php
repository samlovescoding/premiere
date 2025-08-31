<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
        $user = User::where('email', $fields['email'])->first();
        if(!$user) {
            return $this->addError('email', 'Email is not registered. Please create an account first.');
        }

        if(
            !password_verify($fields['password'], $user->password)
        ){
            return $this->addError('password', 'Invalid password');
        }

        Auth::login($user);
        return $this->redirect(route('home'), navigate: true);
    }

    #[Title("Create an account")]
    public function render()
    {
        return view('login');
    }
}
