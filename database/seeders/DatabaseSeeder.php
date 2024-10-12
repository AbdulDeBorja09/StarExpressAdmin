<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Branches;
use App\Models\CargoLocations;
use App\Models\CargoPrices;
use App\Models\CargoService;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        $branch1 = Branches::create([
            'country' => 'china',
            'branch' => 'macau',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $branch2 = Branches::create([
            'country' => 'philippines',
            'branch' => 'tarlac',
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        User::factory()->createMany([
            [
                'branch_id' => $branch1->id,
                'type' => 'admin',
                'employee_id' => '1231231231',
                'fname' => 'First',
                'mname' => 'Middle',
                'lname' => 'Last',
                'gender' => 'male',
                'address' => 'Admin Address',
                'contact' => '1234567890',
                'status' => 'active',
                'email' => 'admin@com',
                'hired' => '2004-08-09',
                'password' => bcrypt('Password'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'branch_id' => $branch1->id,
                'type' => 'servicemanager',
                'employee_id' => '9876543210',
                'fname' => 'First',
                'mname' => 'Middle',
                'lname' => 'Last',
                'gender' => 'female',
                'address' => 'Accountant Address',
                'contact' => '0987654321',
                'status' => 'active',
                'email' => 'sm@com',
                'hired' => '2005-10-11',
                'password' => bcrypt('Password'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);


        CargoService::create([
            'origin' => $branch1->id,
            'destination' => $branch2->id,
            'status' => 'active',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        CargoLocations::create([
            'branch_id' => $branch1->id,
            'region' => 'MNL',
            'areas' => 'manila',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
