<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    // public function departments()
    // {
    //     return $this->hasMany(Department::class);
    // }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

}
