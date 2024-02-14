<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div style="padding: 10px 0px;">

        <img src="https://nileprojects.in/clearchoice-janitorial/public/assets/admin-images/logo.webp" alt="image"
            style="margin:0 auto; display: block;width: 200px;margin-bottom: 15px;">
        <h1 style="text-align: center;font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size: 25px;">TEAM
            MEMBER TIMESHEET</h1>
        <table border="1" align="center" cellpadding="0" cellspacing="0"
            style="background: #ffffff; margin: 0 auto; background-size: 100%;">
            <tr>
                <td
                    style="font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: right; padding:10px; background: #ffffff;font-weight: 600;">
                    Pay Period:
                </td>
                <td colspan="8">
                    {{-- <input type="text" id="surname" name="surname" value=""
                        style="border: 0;width: 80%;height: 100%;padding: 9px;font-weight: 600;"> --}}
                    <span style="border: 0;width: 80%;height: 100%;padding: 9px;font-weight: 600;">
                        {{ $start_period }} - {{ $end_period }}
                    </span>
                </td>
            </tr>
            <tr>
                <td
                    style="font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: right; padding:10px; background: #ffffff;font-weight: 600;">
                    Team Member Name:
                </td>
                <td colspan="8"> <span style="border: 0;width: 80%;height: 100%;padding: 9px;font-weight: 600;">
                        {{ $name }}
                    </span></td>

            </tr>
            @if ($service != '')
                <tr>
                    <td
                        style="font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: right; padding:10px; background: #ffffff;font-weight: 600;">
                        Service:
                    </td>
                    <td colspan="8"> <span style="border: 0;width: 80%;height: 100%;padding: 9px;font-weight: 600;">
                            {{ $job_title }}
                        </span></td>
                </tr>
                <tr>
                    <td
                        style="font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: right; padding:10px; background: #ffffff;font-weight: 600;">
                        Service Location:
                    </td>
                    <td colspan="8"> <span style="border: 0;width: 80%;height: 100%;padding: 9px;font-weight: 600;">
                            {{ $job_location }}
                        </span></td>
                </tr>
                <tr>
                    <td
                        style="font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: right; padding:10px; background: #ffffff;font-weight: 600;">
                        Property Name:
                    </td>
                    <td colspan="8"><span style="border: 0;width: 80%;height: 100%;padding: 9px;font-weight: 600;">
                            {{ $store_name }}
                        </span></td>
                </tr>
                <tr>
                    <td
                        style="font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: right; padding:10px; background: #ffffff;font-weight: 600;">
                        Property Number:
                    </td>
                    <td colspan="8"><span style="border: 0;width: 80%;height: 100%;padding: 9px;font-weight: 600;">
                            {{ $store_number }}
                        </span></td>
                </tr>
            @endif

            <tr>
                <td style="padding: 15px;" colspan="8"></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="1"
                    style="font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: right; padding:10px; background: #ffffff;font-weight: 600;">
                    Regular
                </td>
                <td
                    colspan="1"style="font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: right; padding:10px; background: #ffffff;font-weight: 600;">
                    Overtime
                </td>
                <td
                    colspan="1"style="font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: right; padding:10px; background: #ffffff;font-weight: 600;">
                    Other
                </td>
                <td colspan="4"></td>
            </tr>
            @foreach ($timesheet as $item)
                <tr>
                    <td
                        style="width: 15%;font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: right; padding:10px; background: #ffffff;font-weight: 600;">
                        Week {{ $item['week_number'] }}:
                    </td>
                    <td colspan="1"
                        style="width: 10%;font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: right; padding:10px; background: #ffffff;font-weight: 600;">
                        {{ $item['total_hours_in_week_format'] }}
                    </td>
                    <td
                        colspan="1"style="width: 10%;font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: right; padding:10px; background: #ffffff;font-weight: 600;">

                    </td>
                    <td
                        colspan="1"style="width: 10%;font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: right; padding:10px; background: #ffffff;font-weight: 600;">

                    </td>
                    <td colspan="4"></td>
                </tr>
            @endforeach


            <tr>
                <td
                    style="width: 10%;font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: right; padding:10px; background: #ffffff;font-weight: 600;">
                    TOTAL:
                </td>
                <td colspan="1"
                    style="width: 10%;font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: right; padding:10px; background: #ffffff;font-weight: 600;">
                    {{ $total_hours }}
                </td>
                <td
                    colspan="1"style="width: 10%;font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: right; padding:10px; background: #ffffff;font-weight: 600;">

                </td>
                <td
                    colspan="1"style="width: 10%;font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: right; padding:10px; background: #ffffff;font-weight: 600;">

                </td>
                <td colspan="4"></td>
            </tr>
            <tr>
                <td style="padding: 15px;text-align: center;font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px; padding:10px; background: #ffffff;font-weight: 600;"
                    colspan="8">
                    1st through the 15 paid on the 22nd. 16th through the 30th/31st paid on the 7th
                </td>
            </tr>
            @foreach ($timesheet as $item)
                <tr>
                    <td colspan="4"
                        style="width: 1%;font-family: Arial, Helvetica, sans-serif;color:#ffffff;font-size:14px;text-align: center; padding:10px; background: black;font-weight: 600;">
                        DAILY HOURS WORKED: WEEK {{ $item['week_number'] }}
                    </td>

                    <td
                        colspan="1"style="width: 10%;font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: center; padding:10px; background: #ffffff;font-weight: 600;">
                        Scrubber
                    </td>
                    <td
                        colspan="1"style="width: 10%;font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: center; padding:10px; background: #ffffff;font-weight: 600;">
                        Burnisher
                    </td>
                    @if ($service != '' && json_decode($service->service_items))
                        @foreach (json_decode($service->service_items) as $si)
                            <td colspan=""
                                style="width: 10%;font-family: Arial, Helvetica, sans-serif;color:#ffffff;font-size:14px;text-align: center; padding:10px; background: black;font-weight: 600;">
                                {{ $si->name }}
                            </td>
                        @endforeach
                    @endif


                </tr>
                <tr>
                    <td colspan="1"
                        style="width: 10%;font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: center; padding:10px; background: #ffffff;font-weight: 600;">
                        DATE
                    </td>
                    <td colspan="1"
                        style="width: 10%;font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: center; padding:10px; background: #ffffff;font-weight: 600;">
                        IN
                    </td>
                    <td
                        colspan="1"style="width: 10%;font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: center; padding:10px; background: #ffffff;font-weight: 600;">
                        OUT
                    </td>
                    <td
                        colspan="1"style="width: 10%;font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: center; padding:10px; background: #ffffff;font-weight: 600;">
                        TOTAL
                    </td>
                    <td
                        style="width: 10%;font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: center; padding:10px; background: rgb(217, 217, 217);font-weight: 600;">
                        Clock<br> Hours
                    </td>
                    <td
                        style="width: 10%;font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: center; padding:10px; background: rgb(217, 217, 217);font-weight: 600;">
                        Clock<br> Hours
                    </td>
                    @if ($service != '' && json_decode($service->service_items))
                        @foreach (json_decode($service->service_items) as $si)
                            <td
                                style="width: 10%;font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: center; padding:10px; background: rgb(217, 217, 217);font-weight: 600;">
                                Clock<br> Hours
                            </td>
                        @endforeach
                    @endif


                </tr>
                @foreach ($item['days'] as $day)
                    <tr>
                        <td colspan="1"
                            style="width: 10%;font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: center; background: #ffffff;">
                            <span
                                style="border: 0;width: 80%;height: 100%; padding:10px;background-color: transparent;">{{ $day['date'] }}
                            </span>
                        </td>
                        <td colspan="1"
                            style="width: 10%;font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: center;  background: #ffffff;">
                            <span
                                style="border: 0;width: 80%;height: 100%; padding:10px;background-color: transparent;">{{ $day['start_time'] }}
                            </span>
                        </td>
                        <td
                            colspan="1"style="width: 10%;font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: center; background: #ffffff;">
                            <span
                                style="border: 0;width: 80%;height: 100%; padding:10px;background-color: transparent;">{{ $day['end_time'] }}
                            </span>
                        </td>
                        <td
                            colspan="1"style="width: 10%;font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: center; background: #ffffff;">
                            <span
                                style="border: 0;width: 80%;height: 100%; padding:10px;background-color: transparent;">{{ $day['total_hours_worked_on_day_format'] }}
                            </span>
                        </td>
                        <td
                            colspan="1"style="width: 10%;font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: center; background: #ffffff;">
                            <span
                                style="border: 0;width: 80%;height: 100%; padding:10px;background-color: transparent;">{{ $day['scrubber']['total_hours'] }}
                            </span>
                        </td>
                        <td
                            colspan="1"style="width: 10%;font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: center; background: #ffffff;">
                            <span
                                style="border: 0;width: 80%;height: 100%; padding:10px;background-color: transparent;">{{ $day['burnisher']['total_hours'] }}
                            </span>
                        </td>
                        @if ($service != '' && json_decode($service->service_items))
                            @foreach (json_decode($service->service_items) as $si)
                                <td
                                    colspan="1"style="width: 10%;font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: center; background: #ffffff;">
                                    <span
                                        style="border: 0;width: 80%;height: 100%; padding:10px;background-color: transparent;">
                                        @if (is_array($day['service_items']))
                                            @foreach ($day['service_items'] as $si_)
                                                @if ($si->id == $si_['id'])
                                                    {{ $si_['total_hours'] }}
                                                @endif
                                            @endforeach
                                        @endif
                                    </span>
                                </td>
                            @endforeach
                        @endif
                    </tr>
                @endforeach
            @endforeach

            <tr>
                <td colspan="3"
                    style="width: 10%;font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: center;padding: 10px; background: rgb(217, 217, 217);font-weight: 600;">
                    TOTAL
                </td>
                <td colspan="1"
                    style="width: 10%;font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: center; padding: 10px; background: rgb(217, 217, 217);font-weight: 600;">
                    {{ $total_hours }}
                </td>
                <td colspan="@if ($service != '' && json_decode($service->service_items)) {{ count(json_decode($service->service_items)) + 2 }} @else 3 @endif"
                    style="width: 10%;font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;text-align: center; background: black;">

                </td>
            </tr>


            <table align="center" cellpadding="0" cellspacing="0" width="900"
                style="background: #ffffff; margin: 0 auto; background-size: 100%;margin-top: 25px;">
                <tr>
                    <td style="font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;">
                        I certify the information on this timesheet is accurate.
                    </td>
                </tr>
                <tr>
                    <td style="font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;">
                        <span
                            style="font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;border-top: 0;border-left: 0;border-right: 0; border-bottom: 1px solid black; width: 98%;height: 100%; padding:10px;background-color: transparent;margin-top: 20px;">
                            Member/Approval</span>
                    </td>
                </tr>
                <tr>
                    <td style="font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;">
                        <span
                            style="font-family: Arial, Helvetica, sans-serif;color:#1d1d1e;font-size:14px;border-top: 0;border-left: 0;border-right: 0; border-bottom: 1px solid black; width: 98%;height: 100%; padding:10px;background-color: transparent;margin-top: 20px;">
                            Area Lead Signature/Approval </span>
                    </td>
                </tr>
            </table>
        </table>
    </div>
</body>

</html>
