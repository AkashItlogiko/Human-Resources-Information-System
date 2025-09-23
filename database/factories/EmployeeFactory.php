<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmployeeFactory extends Factory
{
    protected $model = \App\Models\Employee::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'designation' => $this->faker->jobTitle(),

            // Force unique email
           'email' => Str::uuid() . '@example.com',
            'phone' => $this->faker->phoneNumber(),
            'emergency_phone' => $this->faker->phoneNumber(),

            // Make NID unique as well
            'nid_number' => (string) $this->faker->unique()->numerify(str_repeat('#', 14)),

            'salary' => $this->faker->randomFloat(2, 20000, 150000),
            'profile_photo' => null,
            'document_file' => null,
            'present_address' => $this->faker->address(),
            'permanent_address' => $this->faker->address(),
        ];
    }
}
