<?php

namespace Chatmimik\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['username', 'message'];
}
