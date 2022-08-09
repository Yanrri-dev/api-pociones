<?php

namespace App\Http\Controllers;

use App\Models\Pocion;
use App\Models\Ingrediente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Validator;

class PocionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Response::json(Pocion::with('ingredientes')->get());
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
        $validator = Validator::make($request->all(), [
            'nombre_pocion' => 'required',
            'ingredientes' => 'required|array',
            'ingredientes.*.id_ingrediente' => 'required|exists:ingredientes,id_ingrediente',
            'ingredientes.*.cantidad' => 'required|numeric'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $pocion = Pocion::create($request->all());

        foreach ($request->ingredientes as $ingrediente) {
            $pocion->ingredientes()->attach($ingrediente['id_ingrediente'], ['cantidad' => $ingrediente['cantidad']]);
        } 

        return response()->json([
            'message' => 'Pocion creada con éxito',
            'pocion' => $pocion
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pocion  $pocion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pocion = Pocion::find($id);
        if(!$pocion){
            return response()->json([
                'error' => 'Pocion no existe'
            ], 400);
        }

        $pocion['ingredientes'] = $pocion->ingredientes;

        return response()->json($pocion);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pocion  $pocion
     * @return \Illuminate\Http\Response
     */
    public function edit(Pocion $pocion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pocion  $pocion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $pocion = Pocion::find($id);
        
        if(!$pocion){
            return response()->json([
                'error' => 'Pocion no existe'
            ], 404);
        }


        $validator = Validator::make($request->all(), [
            'nombre_pocion' => 'required',
            'ingredientes' => 'required|array',
            'ingredientes.*.id_ingrediente' => 'required|exists:ingredientes,id_ingrediente',
            'ingredientes.*.cantidad' => 'required|numeric'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $pocion->update($request->all());

        $pocion->ingredientes()->detach();

        foreach ($request->ingredientes as $ingrediente) {
            $pocion->ingredientes()->attach($ingrediente['id_ingrediente'], ['cantidad' => $ingrediente['cantidad']]);
        }

        return response()->json([
            'message' => 'Pocion actualizada con éxito',
            'pocion' => $pocion
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pocion  $pocion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $pocion = Pocion::find($id);

        if(!$pocion){
            return response()->json([
                'error' => 'Pocion no existe'
            ], 404);
        }
        $pocion->delete();
        return response()->json([
            'message' => 'Pocion eliminada con éxito'
        ], 200);
    }
}
