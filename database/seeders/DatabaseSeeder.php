<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Management;
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

        User::factory()->createMany([
            [
                'type' => 'admin',
                'employee_id' => '1231231231',
                'name' => 'Admin User',
                'gender' => 'male',
                'address' => 'Admin Address',
                'contact' => '1234567890',
                'status' => 'active',
                'country' => 'china',
                'branch' => 'macau',
                'email' => 'admin@com',
                'hired' => '08/09/04',
                'password' => bcrypt('Password'),
            ],
            [
                'type' => 'accountant',
                'employee_id' => '9876543210',
                'name' => 'Accountant User',
                'gender' => 'female',
                'address' => 'Accountant Address',
                'contact' => '0987654321',
                'status' => 'active',
                'country' => 'china',
                'branch' => 'macau',
                'email' => 'accountant@com',
                'hired' => '10/11/05',
                'password' => bcrypt('Password'),
            ],
        ]);

        Management::factory()->create([
            'country' => 'china',

        ]);
    }
}
