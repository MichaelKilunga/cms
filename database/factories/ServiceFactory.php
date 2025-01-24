<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Church;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    protected $model = \App\Models\Service::class;

    public function definition()
    {
        return [
            'name' => 'Default Service',
            'date' => now(),
            'message' => 'Default Service Message',
            'minister' => 'Default Minister',
            'women' => 200,
            'men' => 198,
            'children' => 250,
            'cars' => 150,
            'baptism_water' => 40,
            'baptism_spirit' => 200,
            'new_birth' => 30,
            'first_timers' => 30,
            'user_id' => 2, // Create a new user
            'branch_id' => 1, // Create a new branch
            'church_id' => 1, // Create a new church
        ];
    }
}
