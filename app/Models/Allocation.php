<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allocation extends Model
{
    use HasFactory;

    public function slot()
    {
        return $this->hasOne(Slot::class, 'id' , 'slot_id');
    }
    public function room()
    {
        return $this->hasOne(Room::class, 'id' , 'room_id');
    }
    public function register()
    {
        return $this->hasOne(Register::class, 'id' , 'register_id');
    }
}
