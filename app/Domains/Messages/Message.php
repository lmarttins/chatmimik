<?php

namespace Chatmimik\Domains\Messages;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['username', 'message'];
}
