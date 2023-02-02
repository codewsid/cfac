<?php

namespace App\Http\Livewire\Admin;

use App\Models\Office;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class AdminAccount extends Component
{
    use WithPagination;

    public $first_name;
    public $last_name;
    public $email;

    public $adminModal = false;

    public $search;

    public function render()
    {
        return view('livewire.admin.admin-account', [
            'admins' => User::search($this->search)->where('role', 1)->paginate(3),
        ]);
    }

    public function saveAdmin()
    {
        User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => bcrypt('password'),
            'role' => Role::ADMIN,
            'email_verified_at' => Carbon::now(),
        ]);

        $this->dispatchBrowserEvent('success', ['message', 'Admin saved successfully!']);
        $this->reset();
        $this->adminModal = false;
    }
}
