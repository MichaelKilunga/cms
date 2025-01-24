<?php

namespace Database\Factories;

use App\Models\Church;
use Illuminate\Database\Eloquent\Factories\Factory;

class BranchFactory extends Factory
{
    protected $model = \App\Models\Branch::class;

    public function definition()
    {
        return [
            'name' => 'Default Branch',
            'location' => 'Default Location',
            // 'church_id' => 1, // Comes from ChurchFactory
        ];
    }
}
