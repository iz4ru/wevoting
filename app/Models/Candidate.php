<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Candidate extends Model
{
    use HasFactory;
    protected $table = 'candidates';
    protected $fillable = [
        'id',
        'name',
        'work_program',
        'vision',
        'mission',
        'image',
        'video_link',
        'id_position',
    ];

    public function position() 
    {
        return $this->belongsTo(Position::class, 'id_position');
    }
}
