<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFactory extends Factory
{
    protected $model = \App\Models\Attendance::class;

    public function definition(): array
    {
        return [
            // employee_id will be assigned in the seeder to avoid creating too many employees
            'employee_id' => 1,
            'date' => $this->faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
            'status' => $this->faker->randomElement(['Present', 'Absent', 'Leave']),
        ];
    }
}
