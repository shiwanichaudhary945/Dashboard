<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;

    // public function users()
    // {
    //     return $this->hasMany(User::class);
    // }

    // public function department()
    // {
    //     return $this->belongsTo(Department::class);
    // }

    // public function branch()
    // {
    //     return $this->belongsTo(Branch::class);
    // }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
