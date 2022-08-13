<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Models\Clientes;
use App\Models\Direcciones;
use App\Models\Negocios;
use App\Models\Repartidores;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index');
    }

    public function guardarUsuarios(Request $request, $tipoUsuario){       

        $nuevoUsuario = new User();
        $nuevoUsuario->name = $request->name;          
        $nuevoUsuario->telefono = $request->telefono;
        $nuevoUsuario->email = $request->email;
        $pass=Hash::make($request->contraseña);
        $nuevoUsuario->password = $pass;
        $nuevoUsuario->tipoUsuario = $tipoUsuario;
        
        $nuevoUsuario->save();
        
    }

    public function editarUsuariosNegocios(Request $request){
        $negocio = Negocios::find($request->id);
        $usuario = User::find($negocio->idUsuario);
        
        $usuario->name = $request->name;          
        $usuario->telefono = $request->telefono;
        $usuario->email = $request->email;
        $usuario->save();
    }
    public function editarUsuariosClientes(Request $request){
        $clientes = Clientes::find($request->id);
        $usuario = User::find($clientes->idUsuario);
        
        $usuario->name = $request->name;          
        $usuario->telefono = $request->telefono;
        $usuario->email = $request->email;
        $usuario->save();
    }
    public function editarUsuariosRepartidor(Request $request){
        $repartidor = Repartidores::find($request->id);
        $usuario = User::find($repartidor->idUsuario);
        
        $usuario->name = $request->name;          
        $usuario->telefono = $request->telefono;
        $usuario->email = $request->email;
        $usuario->save();
    }
}
