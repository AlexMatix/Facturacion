<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class impuestos extends Model
{

    protected $fillable = [
        'id',
        'Nombre',
        'tipo',
        'calculo',
        'tasa',
        'unidades',
        'tipo_iva',
        'estado',
    ];

    public  $timestamps = false;
}
