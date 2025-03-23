<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Voter extends Authenticatable
{
    use HasFactory;

    protected $table = 'voters';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_id',
        'uuid',
        'name',
        'class',
        'vocation',
        'access_code',
        'validation',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    public function getRouteKeyName()
    {
        return 'uuid'; // Laravel otomatis pakai UUID untuk route model binding
    }
}
