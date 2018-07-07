<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class facturacion_det extends Model
{

    protected  $fillable = [
        'id',
        'id_factura',
        'id_articulo',
        'cantidad',
        'precio',
    ];

    public  $timestamps = false;
}
