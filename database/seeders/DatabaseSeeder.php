<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'type' => 'admin',
            'employee_id' => '1231231231',
            'name' => 'Test User',
            'gender' => 'male',
            'address' => 'address',
            'contact' => 'contact',
            'status' => 'active',
            'country' => 'country',
            'branch' => 'branch',
            'email' => 'admin@com',
            'hired' => '08/09/04',
            'password' => bcrypt('Password'),
        ]);
    }
}
