<?php

namespace Database\Factories;

use App\Models\Branches;
use Illuminate\Database\Eloquent\Factories\Factory;

class BranchesFactory extends Factory
{
    protected $model = Branches::class;

    public function definition()
    {
        return [
            'country' => $this->faker->country(),
            'branch' => $this->faker->city(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
