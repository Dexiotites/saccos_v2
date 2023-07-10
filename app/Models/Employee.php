<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Benefit;
use App\Models\grants;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function benefits()
    {
        return $this->hasMany(Benefit::class);
    }

    public function absences()
    {
        return $this->hasMany(Benefit::class);
    }
}
