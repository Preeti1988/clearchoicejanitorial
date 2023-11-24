<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceMember extends Model
{
    use HasFactory;
    public function member()
    {
        return $this->belongsTo(User::class, 'member_id');
    }
}
