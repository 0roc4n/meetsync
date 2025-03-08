<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingsApproval extends Model
{
    use HasFactory;

    protected $table = 'meetings_approval';

    public $timestamps = false;

    protected $fillable = [
        'id', 
        'meeting_id',
        'meeting_name',
        'member_id', 
        'member_name', 
        'manager_id', 
    ];
}
