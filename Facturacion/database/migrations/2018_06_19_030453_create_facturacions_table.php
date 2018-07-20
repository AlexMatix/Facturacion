<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturacions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rfc_r',200);
            $table->string('nombre_r',200);
            $table->string('rfc_e',200);
            $table->string('nombre_e',200);
            $table->decimal('tipo_cambio',15,2);
            $table->string('moneda',200);
            $table->string('uso_cfdi',500);
            $table->decimal('sub_t',15,4);
            $table->decimal('total',15,4);
            $table->decimal('descuento',15,4);
            $table->string('uuid',500);
            $table->string('cert',1000);
            $table->string('cert_sat',1000);
            $table->dateTime('fecha_cert');
            $table->string('cfdi',500);
            $table->string('sello_sat',1000);
            $table->string('cadena',1000);
            $table->string('condicion',1000);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facturacions');
    }
}
