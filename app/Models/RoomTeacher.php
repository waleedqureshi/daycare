<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomTeacher extends Model
{
    use HasFactory;

    public function room()
    {
        return $this->hasOne(Room::class);
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }
}
