<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class empresa extends Model
{
    protected $fillable = [
        'id',
        'rfc',
    ];

    public  $timestamps = false;
}
