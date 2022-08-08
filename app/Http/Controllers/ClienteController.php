<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Validator;
use Validator;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::all();

        return response()->json($clientes);
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
            'nombre_cliente' => 'required',
            'email' => 'required|email|unique:clientes',
        ]);

        if($validador->fails()){
            return response()->json($validador->errors(), 400);
        }

        $cliente = Cliente::create($request->all());

        /* $cliente = new Cliente();

        $cliente->nombre_cliente = $request->nombre_cliente;
        $cliente->email = $request->email;
        $cliente->save(); */

        return response()->json([
            'message' => 'Cliente creado con éxito',
            'cliente' => $cliente
        ], 201);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Cliente::find($id);
        if(!$cliente){
            return response()->json([
                'error' => 'Cliente no existe'
            ], 404);
        }
        return response()->json($cliente);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $validador = Validator::make($request->all(), [
            'nombre_cliente' => 'required',
            'email' => 'required|email|unique:clientes',
        ]);

        if($validador->fails()){
            return response()->json($validador->errors(), 400);
        }

        $cliente = Cliente::find($id);

        if(!$cliente){
            return response()->json([
                'error' => 'Cliente no existe'
            ], 404);
        }

        $cliente->update($request->all());

        return response()->json(['message' => 'Cliente actualizado', 'cliente' => $cliente], '200');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json([
                'error' => 'Cliente no existe'
            ], 404);
        }

        $cliente->delete();

        return response()->json(['message' => 'Cliente eliminado','cliente' => $cliente ], '200');
    }
}
