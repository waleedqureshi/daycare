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
}
