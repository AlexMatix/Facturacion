<?php

namespace App\Http\Controllers\Impuestos;

use App\Http\Controllers\apicontroller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\imp_art;

class imp_art_controller extends apicontroller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consulta = imp_art::join('articulos','imp_arts.id_articulo','=','articulos.id')
                        -> join('impuestos','imp_arts.id_impuesto','=','impuestos.id')
                        -> where("articulos.estado", "<>", 0)
                        -> where( "impuestos.estado", "<>", 0)
                        -> select('articulos.clave','impuestos.nombre', 'impuestos.tipo','impuestos.calculo','impuestos.tasa','impuestos.unidades','impuestos.tipo_iva')
                        ->get();

        if (empty($consulta)){
            return $this->errorResponse('Impuestos no encontrados', 409);
        }
        return $this->showAll($consulta, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $campos = $request->all();

        $articulo = $campos['articulo'];

        $impuestos = $campos['impuestos'];

        print_r($campos);

        foreach ($impuestos as $impuesto){
            $newImp_Art = new imp_art();
            $newImp_Art ->Id_Articulo = $articulo['id_articulo'];
            $newImp_Art ->Id_Impuesto = $impuesto['imp'];
            $newImp_Art ->save();
        }

        return $this->succesMessaje("Artículo e Impuestos asociados correctamente", 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $consulta = imp_art::join('articulos','imp_arts.id_articulo','=','articulos.id')
            -> join('impuestos','imp_arts.id_impuesto','=','impuestos.id')
            -> where("articulos.estado", "<>", 0)
            -> where( "impuestos.estado", "<>", 0)
            -> where("articulos.id", "=", $id)
            -> select('articulos.clave','impuestos.nombre', 'impuestos.tipo','impuestos.calculo','impuestos.tasa','impuestos.unidades','impuestos.tipo_iva')
            ->get();

        if (empty($consulta)){
            return $this->errorResponse('Impuestos no encontrados', 409);
        }
        return $this->showAll($consulta, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        imp_art:: where('id_articulo','=',$id) -> delete();

        $campos = $request->all();

        $articulo = $campos['articulo'];

        $impuestos = $campos['impuestos'];

        foreach ($impuestos as $impuesto){
            $newImp_Art = new imp_art();
            $newImp_Art ->Id_Articulo = $articulo['id_articulo'];
            $newImp_Art ->Id_Impuesto = $impuesto['imp'];
            $newImp_Art ->save();
        }

        return $this->succesMessaje("Artículo e Impuestos asociados correctamente", 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
