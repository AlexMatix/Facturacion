<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\apicontroller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\empresa;

class empresa_controller extends apicontroller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresa = Empresa::where("estado", "<>", 0)->get();

        if (empty($empresa)){
            return $this->errorResponse('Empresas no encontrados', 409);
        }
        return $this->showAll($empresa, 200);
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
            $newEmpresa = new Empresa;
            $newEmpresa->Nombre = $campos['Nombre'];
            $newEmpresa->RFC = $campos['RFC'];
            $newEmpresa->regimen = $campos['regimen'];
            $newEmpresa->estado = 1;

            if($newEmpresa->save())
                return $this->succesMessaje("Empresa creada correctamente", 201);

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
        $empresa = Empresa::findOrFail($id);

        if ($empresa->estado == 1)
            return $this->showOne($empresa, 200);
        return $this->errorResponse('Empresa no encontrada', 404);
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
            $empresa = Empresa::findOrFail($id);
            $campos = $request->all();

            $empresa->Nombre        = empty($campos['Nombre'])
                                    ? $empresa->Nombre
                                    : $campos['Nombre'];

            $empresa->RFC           = empty($campos['RFC'])
                                    ? $empresa->RFC
                                    : $campos['RFC'];

            $empresa->regimen       = empty($campos['regimen'])
                                    ? $empresa->regimen
                                    : $campos['regimen'];


            if ($empresa->save()){
                return $this->showOne($empresa, 201);
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
        $empresa = Empresa::findOrFail($id);
        $empresa -> estado = 0;
        if ($empresa->save()){
            return $this -> succesMessaje('Empresa eliminada con éxito', 200);
        }
    }
}
