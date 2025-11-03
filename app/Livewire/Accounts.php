<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Accounts extends Component
{

    use WithPagination;

    #[Computed]
    public function users()
    {
        return User::paginate(10);
    }

    public function render()
    {
        return view('accounts');
    }
}
