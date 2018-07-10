<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class empresa extends Model
{
    protected $fillable = [
        'id',
        'Nombre',
        'RFC',
        'regimen',
        'estado',
    ];

    public  $timestamps = false;
}
