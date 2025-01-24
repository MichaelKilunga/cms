<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceCategory>
 */
class ServiceCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Default Service Category',
            'description' => 'Default Service Category Description',
            // 'church_id' => 1, // Comes from ChurchFactory
            // 'branch_id' => 1, // Comes from BranchFactory
            // 'user_id' => 2, // Comes from UserFactory
        ];
    }
}
