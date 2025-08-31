<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Sidebar extends Component
{
    public function logout(){
        Auth::logout();
        return $this->redirect(route('login'), navigate: true);
    }

    public function render()
    {
        return view('components.sidebar');
    }
}
