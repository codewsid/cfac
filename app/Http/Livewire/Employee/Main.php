<?php

namespace App\Http\Livewire\Employee;

use App\Models\Feedback;
use App\Models\FeedbackTimeline;
use App\Models\User;
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

    public function viewDetails($id)
    {
        $feedback = Feedback::find($id);
        $senderUser = User::where('id', $feedback->user_id)->first();
        $adminUser = User::where('role', 1)->first();

        if ($feedback->status_id == 3) {
            $feedback->update(['status_id' => 4]);

            $feedbackTimeline = FeedbackTimeline::where('feedback_id', $id);
            $feedbackTimeline->update(['receiver_received' => now()]);

            $feedbackData = [
                'feedbackId' => $id,
                'feedbackType' => $feedback->feedbackType->name,
                'senderId' => $feedback->user_id,
                'message' => 'Your ' . $feedback->feedbackType->name . ' feedback has been received by ' . $feedback->office->name . ' office.'
            ];

            $adminData = [
                'feedbackId' => $id,
                'feedbackType' => $feedback->feedbackType->name,
                'senderId' => $feedback->user_id,
                'message' => 'The ' . $feedback->feedbackType->name . " feedback you've forwarded has been receive by " . $feedback->office->name . ' office.'
            ];

            $senderUser->notify(new \App\Notifications\FeedbackNotification($feedbackData));
            $adminUser->notify(new \App\Notifications\FeedbackNotification($adminData));
        }

        return redirect()->route('employee.details', ['id' => $id]);
    }
}
