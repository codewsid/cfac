<?php

namespace App\Http\Livewire\Office;

use App\Models\ClientFeedback;
use App\Models\Feedback;
use App\Models\FeedbackTimeline;
use App\Models\User;
use Livewire\Component;

class FeedbackInfo extends Component
{
    public $feedbackId;
    public $userInfo;
    public $feedbackStatus;
    public $comment;

    public function mount($id)
    {
        $this->feedbackId = $id;
        $this->userInfo = Feedback::with('office')->where('id', $this->feedbackId)->first();
        $this->feedbackStatus = $this->userInfo->status_id;
    }
    public function render()
    {
        return view('livewire.office.feedback-info', [
            'feedbackInfo' => Feedback::with('user', 'status', 'clientType', 'timeline', 'edited')->where('id', $this->feedbackId)->get(),
            'ratings' => ClientFeedback::with('feedback', 'criteria')->where('feedback_id', $this->feedbackId)->get()
        ]);
    }

    public function sendReply()
    {
        $admin = User::where('role', 1)->first();
        $senderUser = User::where('id', $this->userInfo->user_id)->first();

        if ($this->userInfo->status_id == 4) {
            $this->userInfo->update(['status_id' => 6]);

            $feedbackTimeline = FeedbackTimeline::find($this->userInfo->id);
            $feedbackTimeline->update(['status' => now()]);

            $adminData = [
                'feedbackId' => $this->userInfo->id,
                'feedbackType' => $this->userInfo->feedbackType->name,
                'senderId' => $senderUser->id,
                'message' => 'The ' .  $this->userInfo->office->name . ' replied to ' . $this->userInfo->feedbackType->name . ' feedback.',
            ];
            $senderData = [
                'feedbackId' => $this->userInfo->id,
                'feedbackType' => $this->userInfo->feedbackType->name,
                'senderId' => $senderUser->id,
                'message' => 'Your ' . $this->userInfo->feedbackType->name . ' to ' . $this->userInfo->office->name . ' completed.',
            ];

            $admin->notify(new \App\Notifications\FeedbackNotification($adminData));
            $senderUser->notify(new \App\Notifications\FeedbackNotification($senderData));

            $this->dispatchBrowserEvent('success', ['message' => 'Reply Sent Successully!']);
        }
        return redirect()->route('office.main');
    }
}
