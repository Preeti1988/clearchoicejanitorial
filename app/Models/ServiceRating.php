<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRating extends Model
{
    use HasFactory;
    public function member()
    {
        return $this->belongsTo(User::class, 'member_id');
    }
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
