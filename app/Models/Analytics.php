<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analytics extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'path',
        'user_agent',
        'ip',
        'referer',
        'country',
        'city',
        'slug'
    ];
}
