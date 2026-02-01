<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    use HasFactory;

    // This allows these fields to be filled via Carrier::create() using Tinker
    protected $fillable = [
        'name',
        'price',
        'max_weight',
    ];
}
