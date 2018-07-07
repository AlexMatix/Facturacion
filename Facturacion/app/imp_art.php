<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class imp_art extends Model
{

    protected  $fillable = [
        'id',
        'id_impuesto',
        'id_articulo',
    ];

    public  $timestamps = false;
}
