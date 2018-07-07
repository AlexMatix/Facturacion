<?php

namespace App\Http\Controllers\Articulos;

use App\Http\Controllers\apicontroller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\articulos;

class articulos_controller extends apicontroller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articulos = Articulos::where("estado", "<>", 0)->get();

        if (empty($articulos)){
            return $this->errorResponse('Datos no encontrados', 404);
        }
        return $this->showAll($articulos, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try{
            $campos = $request->all();
            $newArticulo = new Articulos;
            $newArticulo->clave = $campos['clave'];
            $newArticulo->descripcion = $campos['descripcion'];
            $newArticulo->clave_sat = $campos['clave_sat'];
            $newArticulo->descripcion_sat = $campos['descripcion_sat'];
            $newArticulo->u_medida_sat = $campos['u_medida_sat'];

            if($newArticulo->save())
                return $this->succesMessaje("Correcto", 200);

        }catch (QueryException $e){
            return $this->errorResponse("Clave ya registrada.", 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $articulos = Articulos::findOrFail($id);

        if ($articulos->estado == 1)
            return $this->showOne($articulos, 200);
        return $this->errorResponse('Datos no encontrados', 404);
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
        try{
            $articulos = Articulos::findOrFail($id);
            $campos = $request->all();

            $articulos->clave           = empty($campos['clave'])
                ? $articulos ->clave
                : $campos['clave'];

            $articulos->descripcion     = empty($campos['descripcion'])
                ? $articulos ->descripcion
                : $campos['descripcion'];

            $articulos->clave_sat        = empty($campos['clave_sat'])
                ? $articulos ->clave_sat
                : $campos['clave_sat'];

            $articulos->descripcion_sat  = empty($campos['descripcion_sat'])
                ? $articulos ->descripcion_sat
                : $campos['descripcion_sat'];

            $articulos->u_medida_sat  = empty($campos['u_medida_sat'])
                ? $articulos ->u_medida_sat
                : $campos['u_medida_sat'];

            if ($articulos->save()){
                return $this->showOne($articulos, 201);
            }
        }catch (QueryException $e){
            return $this->errorResponse("Clave ya registrada.", 403);
        }

        return $this->errorResponse("Ocurrio algún error intentelo mas tarde", 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $articulos = Articulos::findOrFail($id);
        $articulos -> estado = 0;
        if ($articulos->save()){
            return $this -> succesMessaje('Artículo eliminado con éxito', 200);
        }
    }
}
