<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Members extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'members_info';

    const CREATED_AT = null;
    const UPDATED_AT = null;

    protected $fillable = [
        'id',
        'first_name',
        'middle_name',
        'last_name',
        'organizations_name',
        'email',
        'password',
        'role',
        'profile_picture',
        'manager',
    ];

}