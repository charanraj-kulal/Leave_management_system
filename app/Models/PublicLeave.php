<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicLeave extends Model // this is for public holiday model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'date',
    ];
}
