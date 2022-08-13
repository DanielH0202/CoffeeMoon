<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class clientesController extends Controller
{
    public function vista()
    {
        return view('pages.clientes');
    }

    /**
     * Función para obtener los datos de un cliente a través de su id de usuario
     */
    public function obtenerCliente($idUsuario){
        $cliente = DB::table('clientes')
            ->select('clientes.*')
            ->where('clientes.idUsuario','=',$idUsuario)
            ->get();
        
        return $cliente;
    }

    /**
     * Función para obtener los datos para mostrar los detalles de un cliente
     */
    public function infoCliente($idCliente){
    
        $detalles = DB::table('users')
            // ->join('direcciones', 'direcciones.id', '=', 'users.idDireccion')
            ->join('clientes','clientes.idUsuario','=','users.id')
            ->select('users.nombre', 'users.correo', 'users.telefono',
                'clientes.*')
            ->where('clientes.id','=',$idCliente)
            ->get();
    
        return $detalles;
    }

    public function listar()
    {
        $clientes = DB::table('users')
           // ->join('direcciones', 'direcciones.id', '=', 'users.idDireccion')
            ->join('clientes', 'clientes.idUsuario', '=', 'users.id')
            ->select('users.*', 'clientes.*')
            ->where('tipoUsuario', '=', 0)
            ->get();

        return $clientes;
    }

    public function almacenarCliente(Request $request)
    {
        $reglas = new reglasController();
        $reglas->reglasUsuarios($request);
        //$reglas->reglasDirecciones($request);
        $reglas->reglasCliente($request);


        //$guardarDireccion = new direccionesController();
        //$guardarDireccion->guardarDireccion($request);

        $guardarUsuario = new UserController();
        $tipoUsuario = 0;
        $guardarUsuario->guardarUsuarios($request, $tipoUsuario);

        $nuevoCliente = new Clientes();

        $nuevoCliente->sexo = $request->sexo;
        $nuevoCliente->fechaNacimiento = $request->fechaNacimiento;
        $nuevoCliente->idUsuario = User::max('id');

        $nuevoCliente->save();
    }


    public function editarCliente(Request $request)
    {
        $reglas = new reglasController();
        $reglas->reglasEditarUsuarios($request);
        //$reglas->reglasUsuarios($request);
        //$reglas->reglasDirecciones($request);
        $reglas->reglasCliente($request);

        //$direcciones = new direccionesController();
        //$direcciones->editarDireccionesClientes($request);

        $usuarios = new UserController();
        $usuarios->editarUsuariosClientes($request);
        $cliente = Clientes::find($request->id);

        $cliente->sexo = $request->sexo;
        $cliente->fechaNacimiento = $request->fechaNacimiento;
        $cliente->save();
    }

    public function eliminarCliente($idCliente)
    {
        $cliente = Clientes::find($idCliente);
        $cliente->delete();
    }
}
