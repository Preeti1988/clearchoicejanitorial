<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceItemTimesheet extends Model
{
    use HasFactory;
    protected $table = "service_items_timesheet";
    protected $fillable = ['start_time', 'end_time'];
}
