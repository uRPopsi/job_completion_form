<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCompletion extends Model
{
    use HasFactory;

    protected $fillable = [
        'client', 'project', 'po', 'status', 'completion_date', 'invoice',
    ];
}

