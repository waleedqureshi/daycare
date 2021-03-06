<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon;

class Session extends Model
{
    use HasFactory;

    public function slots()
    {
        return $this->hasMany(Slot::class, 'session_id', 'id')->orderBy('day', 'ASC');
    }
}
