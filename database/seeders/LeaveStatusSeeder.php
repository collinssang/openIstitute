<?php

namespace Database\Seeders;

use App\Models\LeaveStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LeaveStatus::create([
            'name' => 'Planned Leave',
            'deleted_at' => now()
        ]);

        LeaveStatus::create([
            'name' => 'Request Leave'
        ]);

        LeaveStatus::create([
            'name' => 'Accepted'
        ]);

        LeaveStatus::create([
            'name' => 'Cancelled'
        ]);

        LeaveStatus::create([
            'name' => 'Modified'
        ]);
    }
}
