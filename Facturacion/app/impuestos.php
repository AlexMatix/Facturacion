<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class impuestos extends Model
{

    protected $fillable = [
        'id',
        'clave',
        'impuesto',
    ];

    public  $timestamps = false;
}
