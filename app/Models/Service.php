<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    // protected $fillable = ["*"];
    public function client()
    {
        return $this->belongsTo(Client::class, 'assigned_member_id');
    }
    public function members()
    {
        return $this->hasMany(ServiceMember::class);
    }
}