<?php

namespace App\Http\Livewire\Employee;

use App\Models\Feedback;
use Livewire\Component;

class Main extends Component
{
    public function render()
    {
        return view('livewire.employee.main', [
            'feedbacks' => Feedback::with('feedbackType', 'receiver', 'edited')
                ->where('receiver_id', auth()->user()->id)
                ->where('status_id', '>=', 3)
                ->orderBy('created_at', 'DESC')->paginate(9),
        ]);
    }
}
