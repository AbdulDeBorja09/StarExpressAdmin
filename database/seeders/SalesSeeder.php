<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class SalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $salesData = [];

        for ($i = 0; $i < 100; $i++) {
            $salesData[] = [
                'order_id' => 95,
                'branch_id' => 2,
                'total_ammount' => round(mt_rand(100000, 1000000) / 100, 2),
                'created_at' => Carbon::createFromTimestamp(
                    mt_rand(
                        strtotime('2023-12-01'),
                        strtotime('2024-12-31')
                    )
                ),
                'updated_at' => now(),
            ];
        }

        DB::table('sales')->insert($salesData);
    }
}
