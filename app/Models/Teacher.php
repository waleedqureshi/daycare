<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_teachers', 'teacher_id', 'room_id');
    }
}
