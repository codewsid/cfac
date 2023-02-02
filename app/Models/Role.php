<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    const ADMIN = 1;
    const OFFICE = 2;
    const CLIENT = 3;
    const EMPLOYEE = 4;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
