<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalaryHistory extends Model
{
    protected $fillable = ['employee_id','amount','reason','effective_date'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
