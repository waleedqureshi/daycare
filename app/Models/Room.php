<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'room_teachers', 'room_id', 'teacher_id');
    }
}
