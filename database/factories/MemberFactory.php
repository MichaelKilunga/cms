<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Church;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    protected $model = \App\Models\Member::class;

    public function definition()
    {
        return [
            // 'user_id' => 2, // Comes from the user factory
            'branch_id' => 1, // Create a new branch
            'church_id' => 1, // Create a new church
            'status' => 'active',
            'description' => 'Default Member Description',
            'date_of_birth' => $this->faker->date,
            'phone_number' => $this->faker->phoneNumber,
            'gender' => $this->faker->randomElement(['male', 'female']),
        ];
    }
}
