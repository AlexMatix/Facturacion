<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class clientes extends Model
{
    protected  $fillable = [
        'id',
        'Nombre',
        'RFC',
        'estado',
    ];

    public  $timestamps = false;
}
