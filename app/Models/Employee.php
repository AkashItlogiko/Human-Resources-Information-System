<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'designation',
        'email',
        'phone',
        'emergency_phone',
        'nid_number',
        'salary',
        'profile_photo',
        'document_file',
        'present_address',
        'permanent_address',
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }

     public function salaryHistories()
    {
        return $this->hasMany(SalaryHistory::class);
    }
}
