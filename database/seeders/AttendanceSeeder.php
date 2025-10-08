<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attendance;
use App\Models\Employee;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $total = 100000;
        $batch = 2000; // insert in batches to avoid memory issues

        $employeeIds = Employee::pluck('id')->toArray();
        if (empty($employeeIds)) {
            // If there are no employees, create 10 first
            Employee::factory()->count(10)->create();
            $employeeIds = Employee::pluck('id')->toArray();
        }

        $faker = \Faker\Factory::create();

        $records = [];
        for ($i = 0; $i < $total; $i++) {
            $records[] = [
                'employee_id' => $faker->randomElement($employeeIds),
                'date' => $faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
                'status' => $faker->randomElement(['Present', 'Absent', 'Leave']),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (count($records) >= $batch) {
                Attendance::insert($records);
                $records = [];
            }
        }

        if (!empty($records)) {
            Attendance::insert($records);
        }
    }
}
