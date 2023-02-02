<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Feedback;
use App\Models\FeedbackTimeline;
use App\Models\User;
use Livewire\WithPagination;

class Feedbacks extends Component
{
    use WithPagination;
    public $typeId;
    public $feedbackStatus;

    public function mount()
    {
        // $feedback = Feedback::with('clientFeedback')
        //     ->when($this->feedbackStatus, function ($query) {
        //         $query->where('status_id', $this->feedbackStatus);
        //     })->get();
        // dd($feedback);
    }

    public function render()
    {
        return view('livewire.admin.feedbacks', [
            'feedbacks' => Feedback::with('clientFeedback')
                ->when($this->feedbackStatus, function ($query) {
                    $query->where('status_id', $this->feedbackStatus);
                })
                ->orderBy('created_at', 'DESC')->paginate(9),
        ]);
    }

    public function viewDetails($id)
    {
        $feedback = Feedback::find($id);
        $senderUser = User::where('id', $feedback->user_id)->first();

        if ($feedback->office_id) {
            $toFeedback = $feedback->office->name . ' office';
        } elseif ($feedback->receiver_id) {
            $toFeedback = $feedback->receiver->first_name . ' ' . $feedback->receiver->last_name;
        }

        if ($feedback->status_id == 1) {
            $feedback->update(['status_id' => 2]);

            $feedbackTimeline = FeedbackTimeline::where('feedback_id', $id);
            $feedbackTimeline->update(['admin_receive' => now()]);

            // Notify feedback sender
            $feedbackData = [
                'feedbackId' => $id,
                'feedbackType' => $feedback->feedbackType->name,
                'senderId' => $feedback->user_id,
                'message' => 'Your ' . $feedback->feedbackType->name . ' to ' . $toFeedback . ' has been received by the admin.',
            ];

            $senderUser->notify(new \App\Notifications\FeedbackNotification($feedbackData));
        }

        return redirect()->route('admin.feedback-info', ['id' => $id]);
    }
}
