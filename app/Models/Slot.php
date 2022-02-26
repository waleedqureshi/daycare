<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;

    public function session()
    {
        return $this->hasOne(Session::class, 'id' , 'session_id');
    }
}
