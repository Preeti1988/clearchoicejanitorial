<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceTimesheet extends Model
{
    use HasFactory;
    protected $table = 'service_timesheet';
    protected $key = 'id';
    public $timestamps = false;
    protected $fillable = [
        'on_the_way_time',
        'start_time',
        'end_time',
        'status',
        'date'
    ];
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function member()
    {
        return $this->belongsTo(User::class, 'assign_member_id');
    }
}
