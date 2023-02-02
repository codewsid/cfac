<?php

namespace App\Http\Livewire\Admin;

use App\Models\Office;
use Livewire\Component;

class Offices extends Component
{
    public $office;
    public $officeName;

    public $addOfficeModal = false;
    public $updateOfficeModal = false;

    public function render()
    {
        return view('livewire.admin.offices', [
            'offices' => Office::with('manageBy')->get()
        ]);
    }

    public function saveOffice()
    {
        Office::create([
            'name' => $this->officeName
        ]);

        $this->dispatchBrowserEvent('success', ['message' => 'Office saved Successully!']);
        $this->addOfficeModal = false;
    }

    public function editOffice($id)
    {
        $this->office = Office::find($id);
        $this->officeName = $this->office->name;
        $this->updateOfficeModal = true;
    }

    public function updateOffice()
    {
        $this->office->update(['name' => $this->officeName]);
        $this->dispatchBrowserEvent('success', ['message' => 'Office updated Successully!']);
        $this->updateOfficeModal = false;
    }

    public function deleteOffice($id)
    {
        Office::whereId($id)->delete();
        $this->dispatchBrowserEvent('success', ['message' => 'Office Deleted Successully!']);
    }
}
