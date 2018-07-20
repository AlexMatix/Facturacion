<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class facturacion extends Model
{
    protected $fillable = [
        'id',
        'rfc_r',
        'nombre_r',
        'rfc_e',
        'nombre_e',
        'tipo_cambio',
        'moneda',
        'uso_cdfi',
        'sub_t',
        'total',
        'descuento',
        'uuid',
        'cert',
        'cert_sat',
        'fecha_cert',
        'cfdi',
        'sello_sat',
        'cadena',
        'condicion',
    ];

    public  $timestamps = false;
}
