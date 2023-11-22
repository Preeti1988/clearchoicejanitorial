<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesValue extends Model
{
    use HasFactory;
    protected $fillable = [
        'name' ,
        'price'.
        'status',
    ];
    protected $table = 'services_value';
    protected $key = 'id';
    public $timestamps = false;
}
