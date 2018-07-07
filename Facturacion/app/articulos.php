<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class articulos extends Model
{

    CONST ACTIVO = 1;
    CONST NO_ACTIVO = 0;

    protected $fillable=[
        'id',
        'clave',
        'descripcion',
        'clave_sat',
        'descripcion_sat',
        'u_medida_sat',
        'estado',
    ];

    public  $timestamps = false;
}
