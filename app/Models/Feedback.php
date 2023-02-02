<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Feedback extends Model
{
    use HasFactory;
    use Searchable;

    public function toSearchableArray()
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
        ];
    }

    protected $fillable = [
        'user_id',
        'client_type_id',
        'feedback_type_id',
        'comment',
        'office_id',
        'receiver_id',
        'status_id',
        'key',
        'value',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rate()
    {
        return $this->hasMany(ClientFeedback::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function feedbackType()
    {
        return $this->belongsTo(FeedbackType::class);
    }

    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id', 'id');
    }

    public function timeline()
    {
        return $this->hasMany(FeedbackTimeline::class);
    }

    public function clientFeedback()
    {
        return $this->hasMany(ClientFeedback::class);
    }

    public function clientType()
    {
        return $this->belongsTo(ClientType::class);
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function edited()
    {
        return $this->hasOne(EditFeedback::class);
    }
}
