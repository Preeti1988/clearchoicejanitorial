<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutScope extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status'
    ];
    protected $table = 'out_scope';
    protected $key = 'id';
    public $timestamps = false;
}
