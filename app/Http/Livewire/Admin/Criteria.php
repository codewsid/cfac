<?php

namespace App\Http\Livewire\Admin;

use App\Models\Criteria as ModelsCriteria;
use App\Models\Scale;
use Livewire\Component;

class Criteria extends Component
{
    public $criterion;
    public $scaleValue;
    public $value;

    public $scale;
    public $updateCriterion;

    public $criteriaModal = false;
    public $updateCritModal = false;
    public $scaleModal = false;
    public $updateModal = false;

    protected $rules = [
        'scaleValue' => ['required', 'unique:scales'],
        'value' => ['required', 'numeric', 'unique:scales']
    ];

    public function mount()
    {
        $this->value = Scale::latest()->pluck('value')->first() + 1;
    }

    public function saveCriterion()
    {
        $this->validate();

        ModelsCriteria::create([
            'name' => $this->criterion,
        ]);

        $this->dispatchBrowserEvent('success', ['message' => 'Criterion added successfully']);
        $this->reset();
        $this->criteriaModal = false;
    }

    public function editCriterion($id)
    {
        $this->updateCriterion = ModelsCriteria::find($id);
        $this->updateCritModal = true;
        $this->criterion = $this->updateCriterion->name;
    }

    public function updateCriterion()
    {
        $this->updateCriterion->update(['name' => $this->criterion]);
        $this->updateCritModal = false;
    }

    public function removeCriterion($id)
    {
        ModelsCriteria::find($id)->delete();
        $this->reset();
        $this->criteriaModal = false;
    }

    public function saveScale()
    {
        Scale::create([
            'scale_title' => $this->scaleValue,
            'value' => $this->value,
        ]);
        $this->reset();
        $this->mount();
        $this->scaleModal = false;
    }
    public function editScale($id)
    {
        $this->scale = Scale::find($id);
        $this->updateModal = true;
        $this->scaleValue = $this->scale->scale_title;
        $this->value = $this->scale->value;
    }

    public function updateScale()
    {
        $this->scale->update(['scale_title' => $this->scaleValue]);
        $this->updateModal = false;
    }

    public function removeScale($id)
    {
        Scale::find($id)->delete();
        $this->reset();
        $this->mount();
        $this->scaleModal = false;
    }

    public function render()
    {
        return view('livewire.admin.criteria', [
            'criteria' => ModelsCriteria::get(),
            'scales' => Scale::get(),
        ]);
    }
}
