<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Office extends Model
{
    use HasFactory;
    use Searchable;

    protected $guarded = [];

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
        ];
    }

    public $timestamps = false;

    public function manageBy()
    {
        return $this->belongsTo(User::class, 'manage_by');
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
}
