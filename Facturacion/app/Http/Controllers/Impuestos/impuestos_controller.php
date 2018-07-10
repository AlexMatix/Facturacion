<?php

namespace App\Http\Controllers\Impuestos;

use App\Http\Controllers\apicontroller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\impuestos;

class impuestos_controller extends apicontroller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $impuestos = Impuestos::where("estado", "<>", 0)->get();

        if (empty($impuestos)){
            return $this->errorResponse('Impuestos no encontrados', 409);
        }
        return $this->showAll($impuestos, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $campos = $request->all();
            $newImpuesto = new Impuestos;
            $newImpuesto->Nombre = $campos['Nombre'];
            $newImpuesto->tipo = $campos['tipo'];
            $newImpuesto->calculo = $campos['calculo'];
            $newImpuesto->tasa = $campos['tasa'];
            $newImpuesto->unidades = $campos['unidades'];
            $newImpuesto->tipo_iva = $campos['tipo_iva'];
            $newImpuesto->estado = 1;

            if($newImpuesto->save())
                return $this->succesMessaje("Impuesto agregado correctamente", 201);

        }catch (QueryException $e){
            return $this->errorResponse("Nombre ya registrado", 409);
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
        $Impuesto = Impuestos::findOrFail($id);

        if ($Impuesto->estado == 1)
            return $this->showOne($Impuesto, 200);
        return $this->errorResponse('Impuesto no encontrado', 404);
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
            $impuesto = Impuestos::findOrFail($id);
            $campos = $request->all();

            $impuesto->Nombre       = empty($campos['Nombre'])
                                    ? $impuesto->Nombre
                                    : $campos['Nombre'];

            $impuesto->tipo         = empty($campos['tipo'])
                                    ? $impuesto->tipo
                                    : $campos['tipo'];

            $impuesto->calculo      = empty($campos['calculo'])
                                    ? $impuesto->calculo
                                    : $campos['calculo'];

            $impuesto->tasa         = empty($campos['tasa'])
                                    ? $impuesto->tasa
                                    : $campos['tasa'];

            $impuesto->unidades     = empty($campos['unidades'])
                                    ? $impuesto->unidades
                                    : $campos['unidades'];

            $impuesto->tipo_iva     = empty($campos['tipo_iva'])
                                    ? $impuesto->tipo_iva
                                    : $campos['tipo_iva'];

            if ($impuesto->save()){
                return $this->showOne($impuesto, 201);
            }
        }catch (QueryException $e){
            return $this->errorResponse("Nombre ya registrado", 403);
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

    }
}
