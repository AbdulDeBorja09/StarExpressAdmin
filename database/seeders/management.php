<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Management;

class managements extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Management::factory()->create([
            'country' => 'china',

        ]);
    }
}
