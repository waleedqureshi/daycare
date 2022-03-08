<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    use HasFactory;

    public function allocations()
    {
        return $this->hasMany(Allocation::class, 'register_id', 'id');
    }
}
