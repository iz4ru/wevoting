<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Voter extends Authenticatable
{
    use HasFactory;

    protected $table = 'voters';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_id',
        'class',
        'access_code',
        'validation',
    ];
}
