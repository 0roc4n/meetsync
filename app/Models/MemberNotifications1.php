<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberNotifications1 extends Model
{
    use HasFactory;

    protected $table = 'member_notifications1';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'time',
        'member_id',
        'manager_id',
        'manager_name', 
        'organizations_name',
    ];
}
