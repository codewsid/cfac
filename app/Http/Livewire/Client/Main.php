<?php

namespace App\Http\Livewire\Client;

use App\Models\Feedback;
use App\Models\FeedbackType;
use Livewire\Component;
use Livewire\WithPagination;

class Main extends Component
{
    use WithPagination;

    public $search;
    public $typeId;

    public function render()
    {
        return view('livewire.client.main', [
            'feedbackTypes' => FeedbackType::select('id', 'name')->get(),
            'feedbacks' => Feedback::with('feedbackType', 'office', 'receiver', 'timeline')
                ->when($this->typeId, function($query){
                    $query->where('feedback_type_id', $this->typeId);
                })
                ->where('user_id', auth()->user()->id)
                ->orderBy('created_at', 'DESC')
                ->paginate(10)
        ]);
    }
}
