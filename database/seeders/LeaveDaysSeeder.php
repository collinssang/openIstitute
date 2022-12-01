<?php

namespace Database\Seeders;

use App\Models\LeaveDays;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveDaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LeaveDays::create([
            'leave_type' => 1,
            'entitled_days'=> 14
        ]);
        LeaveDays::create([
            'leave_type' => 2,
            'entitled_days'=> 21
        ]);
        LeaveDays::create([
            'leave_type' => 3,
            'entitled_days'=> 90
        ]);
        LeaveDays::create([
            'leave_type' => 4,
            'entitled_days'=> 14
        ]);
        LeaveDays::create([
            'leave_type' => 5,
            'entitled_days'=> 10
        ]);
        LeaveDays::create([
            'leave_type' => 6,
            'entitled_days'=> 7
        ]);
    }
}
