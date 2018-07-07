<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class facturacion extends Model
{
    protected $fillable = [
        'id',
        'id_cliente',
        'id_empresa',
        'UUID',
        'cadena',
        'fecha_c',
        'fecha_t',
    ];

    public  $timestamps = false;
}
