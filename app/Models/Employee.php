<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'profile_photo'];

      public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
     public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }


}
