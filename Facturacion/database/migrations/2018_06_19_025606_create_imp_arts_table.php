<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImpArtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imp_arts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_impuesto') ->unsigned();
            $table->integer('id_articulo') ->unsigned();
            $table->timestamps();

            //DEFINIMOS LLAVES FORANEAS
            $table->foreign('id_impuesto')->references('id')->on('impuestos');
            $table->foreign('id_articulo')->references('id')->on('articulos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imp_arts');
    }
}
