<?php

namespace App\Livewire;

use Livewire\Component;

class Sidebar extends Component
{
    public function logout(){
        dd("Handle user logout");
    }

    public function render()
    {
        return view('components.sidebar');
    }
}
