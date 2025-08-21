<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Doctor;
use App\Models\Specialty;

class DoctorFactory extends Factory
{
    protected $model = Doctor::class;

    public function definition()
    {
        return [
            'specialty_id' => Specialty::factory(),
            'user_id' => \App\Models\User::factory(),
            'name' => fake()->name(),
            'address' => fake()->address(),
            'phone' => $this->faker->numberBetween(100, 5000),
            'license' => rand(100000, 999999),
        ];
    }
}
