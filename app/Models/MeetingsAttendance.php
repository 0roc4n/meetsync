<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingsAttendance extends Model
{
    use HasFactory;

    protected $table = 'meetings_attendance';

    public $timestamps = false;

    protected $fillable = [
        'id', 
        'meeting_id', 
        'member_id', 
        'member_name',  
    ];
}
