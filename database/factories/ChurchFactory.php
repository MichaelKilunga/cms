<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChurchFactory extends Factory
{
    protected $model = \App\Models\Church::class;

    public function definition()
    {
        return [
            'name' => 'Default Church',
            'logo' => 'default-logo.jpg', // Replace with a default logo if needed
            'motto' => 'Default Church Motto',
            // 'administrator_id' => 2, // Comes from the UserFactory 
        ];
    }
}
