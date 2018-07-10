<?php

namespace App\Http\Controllers\Clientes;

use App\Http\Controllers\apicontroller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\clientes;

class clientes_controller extends apicontroller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Clientes::where("estado", "<>", 0)->get();

        if (empty($clientes)){
            return $this->errorResponse('Clientes no encontrados', 409);
        }
        return $this->showAll($clientes, 200);
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
            $newCliente = new Clientes;
            $newCliente->Nombre = $campos['Nombre'];
            $newCliente->RFC = $campos['RFC'];
            $newCliente->estado = 1;

            if($newCliente->save())
                return $this->succesMessaje("Cliente agregado correctamente", 201);

        }catch (QueryException $e){
            return $this->errorResponse("RFC ya registrado", 409);
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
        $clientes = Clientes::findOrFail($id);

        if ($clientes->estado == 1)
            return $this->showOne($clientes, 200);
        return $this->errorResponse('Cliente no encontrado', 404);
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
            $clientes = Clientes::findOrFail($id);
            $campos = $request->all();

            $clientes->Nombre       = empty($campos['Nombre'])
                                    ? $clientes->Nombre
                                    : $campos['Nombre'];

            $clientes->RFC          = empty($campos['RFC'])
                                    ? $clientes->RFC
                                    : $campos['RFC'];


            if ($clientes->save()){
                return $this->showOne($clientes, 201);
            }
        }catch (QueryException $e){
            return $this->errorResponse("RFC ya registrado", 403);
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
        $impuesto = Impuestos::findOrFail($id);
        $impuesto -> estado = 0;
        if ($impuesto->save()){
            return $this -> succesMessaje('Impuesto eliminado con éxito', 200);
        }
    }
}
