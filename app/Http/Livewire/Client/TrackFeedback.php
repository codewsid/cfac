<?php

namespace App\Http\Livewire\Client;

use App\Models\Feedback;
use App\Models\FeedbackTimeline;
use App\Models\ClientFeedback;
use Livewire\Component;

class TrackFeedback extends Component
{
    public $feedbackId;

    public function mount($id)
    {
        $this->feedbackId = $id;
    }

    public function render()
    {
        return view('livewire.client.track-feedback', [
            'feedbackDetails' => Feedback::with('feedbackType', 'office', 'receiver')->findOrFail($this->feedbackId),
            'timeline' => FeedbackTimeline::with('status')->where('feedback_id', $this->feedbackId)->first(),
            'ratings' => ClientFeedback::with('feedback', 'criteria')->where('feedback_id', $this->feedbackId)->get()
        ]);
    }
}
