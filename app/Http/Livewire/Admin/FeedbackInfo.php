<?php

namespace App\Http\Livewire\Admin;

use App\Mail\AdminToReceiverEmail;
use Livewire\Component;
use App\Models\Feedback;
use App\Models\User;
use App\Models\ClientFeedback;
use App\Models\EditFeedback;
use App\Models\FeedbackTimeline;
use DB;
use Illuminate\Support\Facades\Mail;

class FeedbackInfo extends Component
{
    public $feedbackId;
    public $feedbackStatus;
    public $userInfo;
    public $percentage;
    public $sendEmailModal = false;

    public $emailSubject = "";
    public $emailContent = "";
    public $email;
    public $comment;

    public function mount($id)
    {
        $this->feedbackId = $id;

        $this->userInfo = Feedback::with('office', 'edited', 'receiver')->where('id', $this->feedbackId)->first();
        if ($this->userInfo->edited) {
            $this->comment = $this->userInfo->edited->edited_comment;
        }

        if ($this->userInfo->office_id) {
            $this->email = User::where('id', $this->userInfo->office->manage_by)->first();
        } elseif ($this->userInfo->receiver_id) {
            $this->email = User::where('id', $this->userInfo->receiver_id)->first();
        }
        $this->feedbackStatus = $this->userInfo->status_id;
    }

    public function render()
    {
        return view('livewire.admin.feedback-info', [
            'feedbackInfo' => Feedback::with('user', 'status', 'clientType', 'timeline', 'edited')->where('id', $this->feedbackId)->get(),
            'ratings' => ClientFeedback::with('feedback', 'criteria')->where('feedback_id', $this->feedbackId)->get()
        ]);
    }

    public function sendEmail()
    {
        Mail::send(
            [],
            [],
            function ($message) {
                $message->to($this->email->email)
                    ->subject($this->emailSubject)
                    ->from(env('MAIL_FROM_ADDRESS'), 'Arta-Head')
                    ->text($this->emailContent);
            }
        );

        $this->dispatchBrowserEvent('success', ['message' => 'Email sent successfully!']);
        $this->sendEmailModal = false;
        $this->emailSubject = "";
        $this->emailContent = "";
    }

    public function forwardFeedback()
    {
        $feedback = Feedback::find($this->feedbackId);

        $receiverUser = $this->email;
        $senderUser = User::find($feedback->user_id);

        $this->userInfo->update(['status_id' => 3]);

        $feedbackTimeline = FeedbackTimeline::where('feedback_id', $this->feedbackId);
        $feedbackTimeline->update(['forwarded_receiver' => now()]);

        $forwardToManager = [
            'feedbackId' => $feedback->id,
            'feedbackType' => $feedback->feedbackType->name,
            'senderId' => $feedback->user_id,
            'message' => 'You have a new ' . $feedback->feedbackType->name . ' feedback forwarded by admin.'
        ];

        if ($feedback->office_id) {
            $toFeedback = $feedback->office->name . ' office';
        } elseif ($feedback->receiver_id) {
            $toFeedback = $feedback->receiver->first_name . ' ' . $feedback->receiver->last_name;
        }

        $receiverUser->notify(new \App\Notifications\FeedbackNotification($forwardToManager));

        $senderData = [
            'feedbackId' => $feedback->id,
            'feedbackType' => $feedback->feedbackType->name,
            'senderId' => $feedback->user_id,
            'message' => 'Your ' . $feedback->feedbackType->name . ' to ' . $toFeedback . ' has been forwarded by admin.',
        ];

        $senderUser->notify(new \App\Notifications\FeedbackNotification($senderData));

        if ($this->comment) {
            EditFeedback::create([
                'feedback_id' => $this->feedbackId,
                'edited_comment' => $this->comment
            ]);
        }

        $this->dispatchBrowserEvent('success', ['message' => 'Feedback forwarded successfully to receiver.']);
        return redirect()->route('admin.feedback');
    }
}
