<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Election extends Model
{
    use HasFactory;
    protected $table = 'elections';
    protected $fillable = [
        'id',
        'is_active',
    ];
}
