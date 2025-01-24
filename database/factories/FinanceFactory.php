<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FinanceFactory extends Factory
{
    protected $model = \App\Models\Finance::class;

    public function definition()
    {
        return [
            'service_id' => 1, // Create a new service
            'worship_offering' => 500000,
            'tithe_offering' => 5000000,
            'thanksgiving_offering' => 40000,
            'project_offering' => 6000000,
            'special_offering' => 1000000,
            'firstfruits_offering' => 8000000,
            'children_offering' => 2000000,
            'cds_dvd_tapes' => 2500000,
            'books_and_stickers' => 2500000,
            'user_id' => 2, // Create a new user
            'date' => now(),
        ];
    }
}
