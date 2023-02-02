<?php

namespace App\Http\Livewire\Admin;

use App\Models\ClientType;
use App\Models\Office;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeManagement extends Component
{
    use WithPagination;
    // use PasswordValidationRules;

    public $officeId = 0;
    public $first_name;


    public $last_name;
    public $email;

    public $search;

    public $assignModal = false;

    public $assignOffice;

    public function mount()
    {
        // $this->assignOffice = User::whereHas('offices', function($query){
        //     $query->where('office_id', $this->assignOffice);
        // })->get();
    }

    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ];
    }


    public function render()
    {
        return view('livewire.admin.employee-management', [
            'employees' => User::search($this->search)->where('role', 4)->paginate(10),
            'offices' => Office::where('manage_by', '!=', null)->get()
        ]);
    }

    public function saveEmployee()
    {
        // $this->rules();

        $employee = User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => bcrypt('password'),
            'role' => Role::EMPLOYEE,
            'email_verified_at' => Carbon::now()
        ]);

        $employee->types()->attach(ClientType::EMPLOYEE);

        if ($this->officeId == "0") {
            $employee->offices()->detach($this->officeId);
        } else {
            $employee->offices()->attach($this->officeId);
        }

        $this->dispatchBrowserEvent('success', ['message' => 'Employee added successfully.']);
        $this->assignModal = false;
        $this->reset();
    }

    public function updatedAssignOffice()
    {
        $extract = explode(',', $this->assignOffice);

        $employee = User::find($extract[1]);

        if ($this->assignOffice != 0) {
            $employee->offices()->attach($extract[0]);
        }
    }
}
