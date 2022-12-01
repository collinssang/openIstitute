<?php

namespace Database\Seeders;

use App\Models\LeaveDays;
use App\Models\LeaveType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $compasion = LeaveType::create([
            'name' => 'Compassionate Leave'
        ]);

        $annual = LeaveType::create([
            'name' => 'Annual Leave'
        ]);

        $maternity = LeaveType::create([
            'name' => 'Maternity Leave'
        ]);

        $paternity = LeaveType::create([
            'name' => 'Paternity Leave'
        ]);

        $study = LeaveType::create([
            'name' => 'Study Leave'
        ]);

        $sick = LeaveType::create([
            'name' => 'Sick Leave'
        ]);
        if ($compasion) {
            LeaveDays::where('leave_type', $compasion->id)->update(['entitled_days' => 14]);
        }
        if ($annual) {
            LeaveDays::where('leave_type', $annual->id)->update(['entitled_days' => 21]);
        }
        if ($maternity) {
            LeaveDays::where('leave_type', $maternity->id)->update(['entitled_days' => 90]);
        }
        if ($paternity) {
            LeaveDays::where('leave_type', $paternity->id)->update(['entitled_days' => 14]);
        }
        if ($study) {
            LeaveDays::where('leave_type', $study->id)->update(['entitled_days' => 10]);
        }
        if ($sick) {
            LeaveDays::where('leave_type', $sick->id)->update(['entitled_days' => 14]);
        }
    }
}
