<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingUser extends Model
{
    use HasFactory;

    protected $table = 'pending_users';

    protected $fillable = [
        'first_name', 
        'middle_name',
        'last_name', 
        'organizations_name', 
        'email', 
        'password', 
        'role',
    ];
}

