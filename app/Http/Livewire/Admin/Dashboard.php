<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Office;
use App\Models\Feedback;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard', [
            'offices' => Office::with('feedbacks')
                ->where('manage_by', '!=', null)->get(),
        ]);
    }
}
