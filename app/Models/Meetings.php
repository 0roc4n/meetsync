<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meetings extends Model
{
    use HasFactory;
    protected $table = 'meetings';

    const CREATED_AT = null;
    const UPDATED_AT = null;

    protected $fillable = [
        'id',
        'title',
        'location',
        'agenda',
        'date',
        'time',
        'notes',
        'manager_id',
        'status',
        'approved_members',
        'invited_members',
    ];

}
