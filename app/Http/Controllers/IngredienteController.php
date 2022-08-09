<?php

namespace App\Http\Controllers;

use App\Models\Ingrediente;
use Illuminate\Http\Request;
use Validator;

class IngredienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredientes = Ingrediente::all();

        return response()->json($ingredientes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'nombre_ingrediente' => 'required',
            'precio_unidad' => 'required|numeric',
        ]);

        if($validador->fails()){
            return response()->json($validador->errors(), 400);
        }

        $ingrediente = Ingrediente::create($request->all());

        return response()->json([
            'message' => 'Ingrediente creado correctamente',
            'ingrediente' => $ingrediente
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ingrediente  $ingrediente
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ingrediente = Ingrediente::find($id);
        if(!$ingrediente){
            return response()->json([
                'error' => 'Ingrediente no existe'
            ], 404);
        }
        return response()->json($ingrediente);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ingrediente  $ingrediente
     * @return \Illuminate\Http\Response
     */
    public function edit(Ingrediente $ingrediente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ingrediente  $ingrediente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $ingrediente = Ingrediente::find($id);

        if(!$ingrediente){
            return response()->json([
                'error' => 'Ingrediente no existe'
            ], 404);
        }

        $validador = Validator::make($request->all(), [
            'nombre_ingrediente' => 'required',
            'precio_unidad' => 'required|numeric',
        ]);

        if($validador->fails()){
            return response()->json($validador->errors(), 400);
        }

        $ingrediente->update($request->all());

        return response()->json([
            'message' => 'Ingrediente actualizado correctamente',
            'ingrediente' => $ingrediente
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ingrediente  $ingrediente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ingrediente = Ingrediente::find($id);
        if(!$ingrediente){
            return response()->json([
                'error' => 'Ingrediente no existe'
            ], 404);
        }
        $ingrediente->delete();
        return response()->json(['message' => 'Ingrediente eliminado correctamente' , 'ingrediente' => $ingrediente], '200');
    }
}
