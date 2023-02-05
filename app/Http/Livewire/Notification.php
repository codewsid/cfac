<?php

namespace App\Http\Livewire;

use App\Models\Feedback;
use App\Models\FeedbackTimeline;
use App\Models\User;
use Livewire\Component;

class Notification extends Component
{
    public function render()
    {
        return view('livewire.notification');
    }

    public function markAsRead($id, $feedbackId, $senderId)
    {
        $notification = auth()->user()->notifications->where('id', $id)->first();
        $feedback = Feedback::find($feedbackId);
        $senderUser = User::where('id', $senderId)->first();
        $adminUser = User::where('role', 1)->first();

        if ($feedback->office_id) {
            $toFeedback = $feedback->office->name . ' office';
        } elseif ($feedback->receiver_id) {
            $toFeedback = $feedback->receiver->first_name . ' ' . $feedback->receiver->last_name;
        }

        // Admin
        if (auth()->user()->role == 1) {
            $notification->markAsRead();

            if ($feedback->status_id == 1) {
                $feedback->update(['status_id' => 2]);

                $feedbackTimeline = FeedbackTimeline::find($feedbackId);
                $feedbackTimeline->update(['admin_receive' => now()]);

                $feedbackData = [
                    'feedbackId' => $id,
                    'feedbackType' => $feedback->feedbackType->name,
                    'senderId' => $feedback->user_id,
                    'message' => 'Your ' . $feedback->feedbackType->name . ' to ' . $toFeedback . ' has been received by the admin.',
                ];

                $senderUser->notify(new \App\Notifications\FeedbackNotification($feedbackData));
            }

            return redirect()->route('admin.feedback-info', ['id' => $feedbackId]);
        }

        //Office
        elseif (auth()->user()->role == 2 || auth()->user()->role == 4) {
            $notification->markAsRead();

            if ($feedback->status_id == 3) {
                $feedback->update(['status_id' => 4]);

                $feedbackTimeline = FeedbackTimeline::find($feedbackId);
                $feedbackTimeline->update(['receiver_received' => now()]);

                $senderData = [
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

                $senderUser->notify(new \App\Notifications\FeedbackNotification($senderData));
                $adminUser->notify(new \App\Notifications\FeedbackNotification($adminData));
            }

            if (auth()->user()->role == 2) {
                return redirect()->route('office.details', ['id' => $feedbackId]);
            } else {
                return redirect()->route('employee.details', ['id' => $feedbackId]);
            }
        }
    }
}
