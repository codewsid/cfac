<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ClientAccount extends Component
{
    use WithPagination;

    public $search;

    public function render()
    {
        return view('livewire.admin.client-account', [
            // 'admins' => User::with('types')->where('role', 3)->paginate(3),
            'admins' => User::search($this->search)->where('role', 3)->paginate(3),
        ]);
    }
}
