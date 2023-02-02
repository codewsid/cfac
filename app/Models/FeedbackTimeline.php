<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackTimeline extends Model
{
    use HasFactory;

    protected $fillable = [
        'feedback_id',
        'pending',
        'admin_receive',
        'forwarded_receiver',
        'receiver_received',
        'status',
    ];

    public function feedback()
    {
        return $this->belongsTo(Feedback::class);
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }
}
