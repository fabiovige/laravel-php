<?php

namespace FavioVige\Http\Controllers;

use FavioVige\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuario.index',['usuarios' => $usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuario.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = new Usuario();
        $usuario->nome = $request->nome;
        $usuario->email = $request->email;
        $usuario->data_nascimento = date('Y-m-d', strtotime($request->data_nascimento)) ;
        $usuario->senha = Hash::make($request->senha);
        $save = $usuario->save();

        return json_encode(array(
            "statusCode" => $save
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \FavioVige\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \FavioVige\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        return view('usuario.edit', ['usuario'=>$usuario]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \FavioVige\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        $usuario->nome = $request->nome;
        $usuario->email = $request->email;
        $usuario->data_nascimento = date('Y-m-d', strtotime($request->data_nascimento)) ;
        if(!empty($request->senha)) {
            $usuario->senha = Hash::make($request->senha);
        }
        $save = $usuario->save();

        return json_encode(array(
            "statusCode" => $save
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \FavioVige\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        //
    }
}
