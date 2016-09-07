<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Redirect;
use Session;
use App\Trabajador;
use App\Http\Requests;
use App\Http\Requests\TrabajadorRequest;

class TrabajadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $trabajador = Trabajador::orderBy('id', 'DESC')->get();
        
        return view('index', [
            'trabajador' => $trabajador
        ]); 
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
    public function store(TrabajadorRequest $request)
    {
        $trabajador = new Trabajador;
        $trabajador->nombre = $request['nombre'];
        $trabajador->apellido = $request['apellido'];
        $trabajador->cedula = $request['cedula'];
        $trabajador->correo = $request['correo'];
        $trabajador->cargo = $request['cargo'];
        $trabajador->isActive = 1;
        $trabajador->save();
        
        Session::flash('message', 'Trabajador Creado Correctamente');       
        return Redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        
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
        if($request->ajax())
        {            
            $product = Trabajador::find($request->trab['id']);

            $product->nombre = $request->trab['nombre'];
            $product->apellido = $request->trab['apellido'];
            $product->cargo = $request->trab['cargo'];
            $product->isActive = $request->trab['isActive'];
            $product->save();
            return response()->json([
                'mensaje' => 'Editado', 
                'id' => $request->trab['id'],
                'nombre' => $request->trab['nombre'],
                'apellido' => $request->trab['apellido'],
                'cedula' => $request->trab['cedula'],
                'correo' => $request->trab['correo'],
                'cargo' => $request->trab['cargo'],
                'isActive' => $request->trab['isActive']
                ]);
        }
        
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
