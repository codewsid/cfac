<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientFeedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'feedback_id',
        'key',
        'value'
    ];

    public function feedback()
    {
        return $this->belongsTo(Feedback::class);
    }

    public function criteria(){
        return $this->hasMany(Criteria::class, 'id', 'key');
    }

}
