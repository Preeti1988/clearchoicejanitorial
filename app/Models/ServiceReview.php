<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceReview extends Model
{
    use HasFactory;
    protected $table = 'service_review';
    protected $key = 'id';
    public $timestamps = false;
}