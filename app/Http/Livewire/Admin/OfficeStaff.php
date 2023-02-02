<?php

namespace App\Http\Livewire\Admin;

use App\Models\Office;
use App\Models\User;
use App\Models\Role;
use App\Models\ClientType;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class OfficeStaff extends Component
{
    use WithPagination;

    public $officeId;
    public $showOffice;

    public $first_name;
    public $last_name;
    public $email;

    public $assignModal = false;
    public $deleteModal = false;

    public $staffId;
    public $usersIds;

    public $users;

    public $search;

    public function mount()
    {
        $this->showOffice = Office::where('manage_by', null)->get();
        $this->users = User::all();
        $this->usersIds = $this->users->pluck('id')->toArray();
    }

    public function render()
    {
        return view('livewire.admin.office-staff', [
            'offices' => Office::search($this->search)->whereIn('manage_by', $this->usersIds)->paginate(10)
        ]);
    }

    public function assignUser()
    {
        $user = User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => bcrypt('password'),
            'role' => Role::OFFICE,
            'email_verified_at' => Carbon::now(),
        ]);


        $user->types()->attach(ClientType::OFFICE);

        Office::where('id', $this->officeId)->update(['manage_by' => $user->id]);
        $this->assignModal = false;
        $this->dispatchBrowserEvent('success', ['message' => 'New user assigned to office.']);
        $this->reset();
        $this->mount();
    }

    // public function removeAssignedUser($id)
    // {
    //     Office::where('id', $id)->update(['manage_by' => null]);
    //     $this->dispatchBrowserEvent('error', ['message' => 'User remove as office staff.']);
    //     $this->mount();
    // }

    public function deleteModal($id)
    {
        $this->staffId = $id;
        $this->deleteModal = true;
    }

    public function confirmDelete()
    {
        Office::where('id', $this->staffId)->update(['manage_by' => null]);
        $this->dispatchBrowserEvent('success', ['message' => 'User remove as office staff.']);
        $this->deleteModal = false;
        $this->mount();
    }
}
