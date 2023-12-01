<?php

namespace Database\Seeders;

use App\Models\ServiceTimesheet;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceTimesheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();
        $memberId = 2;
        $serviceId = 11;

        // Loop through each day in the month
        while ($startDate <= $endDate) {
            // Generate random start and end times for demonstration purposes
            $startTime = Carbon::createFromTime(rand(8, 12), rand(0, 59), 0);
            $endTime = Carbon::createFromTime(rand(13, 17), rand(0, 59), 0);

            // Insert data into the service_timesheet table
            ServiceTimesheet::create([
                'service_id' => $serviceId,
                'assign_member_id' => $memberId,
                'date' => $startDate,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'status' => 1, // You can customize the status as needed
            ]);

            // Move to the next day
            $startDate->addDay();
        }
    }
}
