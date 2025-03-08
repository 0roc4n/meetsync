<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagerNotifications extends Model
{
    use HasFactory;

    protected $table = 'manager_notifications';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'time',
        'meeting_name',
        'member_name', 
        'manager_id', 
    ];
}
