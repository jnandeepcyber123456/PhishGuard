<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'name',
        'subject',
        'body',
        'sender_name',
        'sender_email',
        'status',
    ];

    public function recipients()
    {
        return $this->hasMany(Recipient::class);
    }
}