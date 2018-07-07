<?php

use Illuminate\Database\Seeder;
use App\articulos;
use App\clientes;
use App\impuestos;
use App\imp_art;
use App\empresa;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //Desactivamos la revision de las llaves foraneas.
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        //trunco las tablas para poder meter datos nuevos
        articulos::truncate();
        clientes::truncate();
        impuestos::truncate();
        imp_art::truncate();
        empresa::truncate();

        $cantidadArticulos = 20;
        $cantidadClientes = 20;
        $cantidadImpuestos = 4;
        $cantidadImp_Arts = 10;
        $cantidadEmpresas = 10;

        factory(articulos::class, $cantidadArticulos)->create();
        factory(clientes::class, $cantidadClientes)->create();
        factory(impuestos::class, $cantidadImpuestos)->create();
        factory(imp_art::class, $cantidadImp_Arts)->create();
        factory(empresa::class, $cantidadEmpresas)->create();

    }
}
