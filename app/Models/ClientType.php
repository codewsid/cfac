<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientType extends Model
{
    use HasFactory;

    // Constant client type
    const ADMIN = 1;
    const OFFICE = 2;

    const ALUMNI = 3;
    const EMPLOYEE = 4;
    const PARENT = 5;
    const STUDENT = 6;
    const VISITOR = 7;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
