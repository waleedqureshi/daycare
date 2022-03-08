<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['allocation_id', 'date', 'attendance'];

    public function allocation()
    {
        return $this->hasOne(Allocation::class, 'id' , 'allocation_id');
    }
}
