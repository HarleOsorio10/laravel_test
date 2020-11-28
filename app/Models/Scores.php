<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scores extends Model
{
    protected $fillable = [
        '_id',
        'timestamp',
        'score',
    ];
}