<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EditFeedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'feedback_id',
        'edited_comment',
    ];

    public function feedback()
    {
        return $this->belongsTo(Feedback::class);
    }
}
