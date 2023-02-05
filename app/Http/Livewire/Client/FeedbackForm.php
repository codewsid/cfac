<?php

namespace App\Http\Livewire\Client;

use App\Models\ClientFeedback;
use App\Models\Criteria;
use App\Models\Employee;
use App\Models\Feedback;
use App\Models\FeedbackTimeline;
use App\Models\FeedbackType;
use App\Models\Office;
use App\Models\Scale;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class FeedbackForm extends Component
{
    public $feedbacks = [];
    public $errorMessage;
    public $comment;

    public $offices = [];
    public $employees = [];
    public $empOffice = [];

    public $selectedReceiver;
    public $feedbackType;
    public $feedbackReceiver;

    public $empInOffice;

    public $selectedEmpOffice;

    public $feedbackId;



    protected $rules = [
        'feedbackType' => 'required',
        'selectedReceiver' => 'required',
        'feedbackReceiver' => 'required',
        'comment' => 'required',
    ];

    public function render()
    {
        return view('livewire.client.feedback-form', [
            'feedbackTypes' => FeedbackType::all(),
            'criterias' => Criteria::all(),
            'scales' => Scale::orderBy('value', 'DESC')->get(),
        ]);
    }

    public function push($criterionId, $value)
    {
        if (array_key_exists($criterionId, $this->feedbacks)) {
            unset($this->feedbacks[$criterionId]);
        }
        $this->feedbacks[$criterionId] = $value;
    }

    public function updatedSelectedReceiver()
    {
        if ($this->selectedReceiver == 1) {
            $this->offices = Office::where('manage_by', '!=', null)->get();
        } else if ($this->selectedReceiver == 2) {
            $this->employees = User::where('role', 4)->get();
        } else {
            $this->offices = Office::where('manage_by', '!=', null)->get();
        }
    }

    public function updatedSelectedEmpOffice()
    {
        $this->empOffice = User::with('offices')
            ->whereHas('offices', function ($query) {
                $query->where('id', $this->selectedEmpOffice);
            })->get();
    }

    public function sendFeedback()
    {
        $this->validate();
        $notifyAdmin = User::where('role', 1)->first();
        if ($this->selectedReceiver == 1) {
            $this->feedbackId = Feedback::create([
                'user_id' => auth()->user()->id,
                'client_type_id' => session()->get('type'),
                'feedback_type_id' => $this->feedbackType,
                'comment' => $this->comment,
                'office_id' => $this->feedbackReceiver,
            ]);

            FeedbackTimeline::create([
                'feedback_id' => $this->feedbackId->id,
                'pending' => now(),
            ]);

            // Notification
            $officeManager = Office::find($this->feedbackReceiver);

            $feedbackData = [
                'feedbackId' => $this->feedbackId->id,
                'feedbackType' => $this->feedbackId->feedbackType->name,
                'senderId' => auth()->user()->id,
                'message' => $this->feedbackId->user->email . ' sent ' . $this->feedbackId->feedbackType->name . ' to ' . $officeManager->name . ' office.',
            ];
            $notifyAdmin->notify(new \App\Notifications\FeedbackNotification($feedbackData));
        } else if ($this->selectedReceiver == 2) {
            $this->feedbackId = Feedback::create([
                'user_id' => auth()->user()->id,
                'client_type_id' => session()->get('type'),
                'feedback_type_id' => $this->feedbackType,
                'comment' => $this->comment,
                'office_id' => $this->selectedEmpOffice,
                'receiver_id' => $this->feedbackReceiver,
            ]);

            FeedbackTimeline::create([
                'feedback_id' => $this->feedbackId->id,
                'pending' => now(),
            ]);

            // Notification
            $employee = User::find($this->feedbackReceiver);

            $feedbackData = [
                'feedbackId' => $this->feedbackId->id,
                'feedbackType' => $this->feedbackId->feedbackType->name,
                'senderId' => auth()->user()->id,
                'message' => $this->feedbackId->user->email . ' sent ' . $this->feedbackId->feedbackType->name . ' to ' . $employee->first_name . ' ' . $employee->last_name . '.',
            ];
            $notifyAdmin->notify(new \App\Notifications\FeedbackNotification($feedbackData));
        } else {
            $this->feedbackId = Feedback::create([
                'user_id' => auth()->user()->id,
                'client_type_id' => session()->get('type'),
                'feedback_type_id' => $this->feedbackType,
                'comment' => $this->comment,
                'office_id' => $this->selectedEmpOffice,
                'receiver_id' => $this->feedbackReceiver,
            ]);

            if ($this->feedbackId) {
                Feedback::where('id', $this->feedbackId->id)->update(['is_office' => 1]);
            }

            FeedbackTimeline::create([
                'feedback_id' => $this->feedbackId->id,
                'pending' => now(),
            ]);

            // Notification
            $officeManager = Office::find($this->selectedEmpOffice);
            $employee = User::find($this->feedbackReceiver);

            $feedbackData = [
                'feedbackId' => $this->feedbackId->id,
                'feedbackType' => $this->feedbackId->feedbackType->name,
                'senderId' => auth()->user()->id,
                'message' => $this->feedbackId->user->email . ' sent ' . $this->feedbackId->feedbackType->name . ' to ' . $employee->first_name . ' ' . $employee->last_name . ' and it will receive by ' . $officeManager->name . ' office.',
            ];
            $notifyAdmin->notify(new \App\Notifications\FeedbackNotification($feedbackData));
        }

        foreach ($this->feedbacks as $feedback) {
            ClientFeedback::create([
                'feedback_id' => $this->feedbackId->id,
                'key' => $feedback['key'],
                'value' => $feedback['value'],
            ]);
        }

        $this->dispatchBrowserEvent('success', ['message' => 'Feedback Sent Successully!']);
        return redirect('/client');
    }
}
