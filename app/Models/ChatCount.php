<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatCount extends Model
{
    use HasFactory;
    protected $table = 'chat_count';
    protected $key = 'id';
}