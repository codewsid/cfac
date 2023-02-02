<?php

namespace App\Http\Livewire\Office;

use App\Models\Office;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class StaffManagement extends Component
{
    use WithPagination;

    public $officeId;

    public function mount()
    {
        $this->officeId = Office::where('manage_by', auth()->user()->id)->first();
    }
    public function render()
    {
        return view('livewire.office.staff-management', [
            'staffs' => User::whereHas('offices', function ($query) {
                $query->where('office_id', $this->officeId->id);
            })->paginate(10)
        ]);
    }
}
