<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Notification;
use App\Models\Service;
use App\Models\ServiceItemTimesheet;
use App\Models\ServicesValue;
use App\Models\ServiceTimesheet;
use App\Models\TimesheetRequest;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Ui\Presets\React;

class TimesheetRequestController extends Controller
{
    function requests()
    {
        $emp_ids = [];


        if (request()->has('search')) {
            $keyword = trim(request('search'));
            $emp_ids = User::where("fullname", "LIKE", "%$keyword%")->pluck("userid")->toArray();
        }
        $requests = TimesheetRequest::when(request()->has('search'), function ($query) use ($emp_ids) {
            return $query->whereIn("member_id", $emp_ids);
        })->when(request()->has('start_date') && request()->has('end_date'), function ($query) {
            return $query->whereDate("start_date", ">=", Carbon::parse(request("start_date")))->whereDate("end_date", "<=", Carbon::parse(request("end_date")));
        });
        if (request()->has('filter')) {
            $requests = $requests->where("status", "Pending");
        } else {
            $requests = $requests->where("status", "!=", "Pending");
        }
        $requests = $requests->paginate(10);

        $count = TimesheetRequest::where("status", "Pending")->count();

        return view("admin.timesheet.requests", compact('requests',  'count'));
    }
    function detail($id)
    {
        $request = TimesheetRequest::find($id);
        if ($request) {
            $timesheet = $this->timecard($request);
            return view("admin.timesheet.detail", compact('request', 'timesheet'));
        } else {
            return redirect()->back()->with('error', 'Timesheet does not exists.');
        }
    }

    function update()
    {
        request()->validate(
            [
                'id' => 'required',
                'status' => 'required',
            ]
        );
        $request = TimesheetRequest::find(request('id'));
        $request->status = request("status");
        $request->save();
        // create notification
        $notification = new Notification();
        $notification->title = "Timesheet " . request("status") . " by admin";
        $notification->details = "From $request->start_date to $request->end_date";

        $notification->redirect_url = null;
        $notification->user_id = $request->member_id;
        $notification->save();

        sendWebNotification($notification, []);
        return response()->json(['message' => "Timesheet $request->status Successfully."]);
    }
    public function timecard($item)
    {

        $member_id = $item->member_id;

        $member = User::find($member_id);
        $startPeriod =  $item->start_date;
        $endPeriod = $item->end_date;




        $timesheet = ServiceTimesheet::select([
            'id',
            'service_id',
            'assign_member_id',
            'date',
            'on_the_way_time',
            'start_time',
            'end_time',
            'status',
            'created_at',
            'updated_at',
            DB::raw('WEEK(date) as week_number'),
            DB::raw('MONTH(date) as month'),
            DB::raw('MIN(date - INTERVAL WEEKDAY(date) DAY) AS start_of_week'),
            DB::raw('MAX(date + INTERVAL (6 - WEEKDAY(date)) DAY) AS end_of_week'),
            DB::raw('DATE_FORMAT(date, "%Y-%m-%d") as formatted_date'),
            DB::raw('SUM(TIME_TO_SEC(TIMEDIFF(end_time, start_time)) / 3600) as total_hours_worked_on_day'),
            DB::raw('SUM(TIME_TO_SEC(TIMEDIFF(end_time, start_time))) as total_hours_worked_on_day_format'),
        ])
            ->where('assign_member_id', $member_id)

            ->whereBetween('date', [$startPeriod, $endPeriod])
            ->groupBy('id', 'service_id', 'assign_member_id', 'date', 'on_the_way_time', 'start_time', 'end_time', 'status', 'created_at', 'updated_at', DB::raw('WEEK(date)'))
            ->orderBy('date', 'asc')
            ->get();



        $result = [];

        $currentWeek = null;
        $totalHoursInWeek = 0;
        $totalHoursInWeekFormat = 0;
        $totalHours = 0;


        $daysInWeek = [];
        foreach ($timesheet as $record) {
            if ($currentWeek !== $record->week_number) {
                // Start a new week
                if ($currentWeek !== null) {
                    // Add total hours for the previous week
                    $result[] = [
                        'week_number' => $currentWeek,
                        'start_of_week' => (new DateTime())->setISODate(date("Y"), $currentWeek, 1)->format('d-m-Y'),
                        'end_of_week' => (new DateTime())->setISODate(date("Y"), $currentWeek, 7)->format('d-m-Y'),

                        'total_hours_in_week' => $totalHoursInWeek,
                        'total_hours_in_week_format' => formatTime($totalHoursInWeekFormat),
                        'avg_hours_in_week' => formatTime(intval($totalHoursInWeekFormat / count($daysInWeek))),
                        'days' => $daysInWeek,
                        'total_days_worked' => count($daysInWeek),

                    ];
                    $totalHours += $totalHoursInWeekFormat;
                }

                // Initialize for the new week
                $currentWeek = $record->week_number;
                $totalHoursInWeek = 0;
                $daysInWeek = [];
            }

            //    calculate hours in this records service items
            $items = [];


            // Record the details for the current day
            $daysInWeek[] = [
                'date' => $record->formatted_date,
                'start_time' => $record->start_time,
                'end_time' => $record->end_time,
                'total_hours_worked_on_day' => $record->total_hours_worked_on_day,
                'total_hours_worked_on_day_format' => formatTime($record->total_hours_worked_on_day_format),
                'service_items' => $items,
                'service_name' => Service::find($record->service_id) ? Service::find($record->service_id)->name : ""
            ];

            // Update the total hours for the week
            $totalHoursInWeek += $record->total_hours_worked_on_day;
            $totalHoursInWeekFormat += $record->total_hours_worked_on_day_format;
        }

        // Add the last week
        if ($currentWeek !== null) {
            $result[] = [
                'week_number' => $currentWeek,
                'start_of_week' => (new DateTime())->setISODate(date("Y"), $currentWeek, 1)->format('d-m-Y'),
                'end_of_week' => (new DateTime())->setISODate(date("Y"), $currentWeek, 7)->format('d-m-Y'),

                'total_hours_in_week' => $totalHoursInWeek,
                'total_hours_in_week_format' => formatTime($totalHoursInWeekFormat),
                'avg_hours_in_week' => formatTime(intval($totalHoursInWeekFormat / count($daysInWeek))),
                'days' => $daysInWeek,
                'total_days_worked' => count($daysInWeek)

            ];
            $totalHours += $totalHoursInWeekFormat;
        }


        $total_days = 0;

        foreach ($result as $data) {
            $total_days += $data['total_days_worked'];
        }


        $data = [
            'data' => $member,
            'start_period' => $startPeriod,
            'end_period' => $endPeriod,

            'timesheet' => $result, 'total_hours' => formatTime($totalHoursInWeekFormat), 'total_days' => $total_days


        ];
        // dd($data['timesheet']);


        return $data;
    }


    public function timesheet(Request $request)
    {


        $start_date = date("Y-m-01");
        $end_date =  date("Y-m-15");

        if ($request->has("year")) {
            $start_date = $request->year . "-" . $request->month . "-" . explode("-", $request->day)[0];
            $end_date = $request->year . "-" . $request->month . "-" . explode("-", $request->day)[1];
        }
        $uids = [];
        if ($request->has("search")) {
            $keyword = trim($request->search);
            $uids = User::where("fullname", "LIKE", "%$keyword%")->pluck("userid")->toArray();
        }

        $data = [];
        $isApproved = TimesheetRequest::whereDate("start_date", Carbon::parse($start_date))->whereDate("end_date", Carbon::parse($end_date))->where("status", 'Approved')->count();

        // dd($isApproved);
        if ($isApproved) {
            $timesheets = ServiceTimesheet::select(["*", DB::raw('SUM(TIME_TO_SEC(TIMEDIFF(end_time, start_time))) as total_hours_worked_on_day_format'),])->whereBetween('date', [$start_date, $end_date])
                ->with('member')
                ->when($request->has('search'), function ($query) use ($uids) {
                    return $query->whereIn("assign_member_id", $uids);
                })
                ->groupBy('id', 'service_id', 'assign_member_id', 'date', 'on_the_way_time', 'start_time', 'end_time', 'status', 'created_at', 'updated_at')
                ->get();

            // Organize the data

            foreach ($timesheets as $timesheet) {
                $member_name = $timesheet->member->fullname;
                $date = $timesheet->date;
                $hours_worked = Carbon::parse($timesheet->end_time)->diffInHours(Carbon::parse($timesheet->start_time));

                if (!isset($data[$member_name][$date])) {
                    $data[$member_name][$date] = 0;
                }
                $data[$member_name][$date] += $timesheet->total_hours_worked_on_day_format;
            }
        }

        // Pass the data to the view
        return view("admin.timesheet.list", compact('data', 'start_date', 'end_date'));
    }
}
