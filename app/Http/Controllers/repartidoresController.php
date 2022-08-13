<?php

namespace App\Http\Controllers;

use App\Models\Repartidores;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class repartidoresController extends Controller
{
    public function vista(){
        return view('pages.repartidores');
    }

    public function obtenerRepartidor($idUsuario){
        $cliente = DB::table('repartidores')
            ->select('repartidores.*')
            ->where('repartidores.idUsuario','=',$idUsuario)
            ->get();
        
        return $cliente;
    }

    /**
     * Función para obtener los datos para mostrar los detalles de un repartidor
     */
    public function infoRepartidor($idRepartidor){
    
        $detalles = DB::table('users')
        
            ->join('repartidores','repartidores.idUsuario','=','users.id')
            ->select('repartidores.nombre', 'repartidores.correo',
                'repartidores.telefono', 'clientes.*')
            ->where('repartidores.id','=',$idRepartidor)
            ->get();
    
        return $detalles;
    }

    public function listarRepartidores(){
        $repartidores = DB::table('users')
            
            ->join('repartidores', 'repartidores.idUsuario', '=', 'users.id')
            ->select('users.*', 'direcciones.*', 'repartidores.*')
            ->where('tipoUsuario', '=', 1)
            ->get();

        return $repartidores;
    }

    public function guardarRepartidor(Request $request){
        
        $reglas = new reglasController();
        $reglas->reglasUsuarios($request);
        $reglas->reglasDirecciones($request);
        $reglas->reglasRepartidores($request);

        //$guardarDireccion = new direccionesController();
        //$guardarDireccion->guardarDireccion($request);

        $guardarUsuario = new UserController();
        $tipoUsuario=1;
        $guardarUsuario->guardarUsuarios($request,$tipoUsuario);

        $nuevoRepartidor = new Repartidores();
        $nuevoRepartidor->idUsuario = User::max('id');
        $nuevoRepartidor->fechaRegistro = now();
        $nuevoRepartidor->fechaNacimiento = $request->fechaNacimiento;
        $nuevoRepartidor->sexo = $request->sexo;
        $nuevoRepartidor->save();
    }

    public function editarRepartidor(Request $request){
        
        $reglas = new reglasController();
        $reglas->reglasEditarUsuarios($request);
        //$reglas->reglasDirecciones($request);
        $reglas->reglasRepartidores($request);
        

       // $direcciones = new direccionesController();
       // $direcciones->editarDireccionesRepartidor($request);

        $usuarios = new UserController();
        $usuarios->editarUsuariosRepartidor($request);

        $repartidor = Repartidores::find($request->id);
        $repartidor->fechaNacimiento = $request->fechaNacimiento;
        $repartidor->sexo = $request->sexo;
        $repartidor->save();
    }

    public function eliminarRepartidor($idRepartidor){
        $repartidor = Repartidores::find($idRepartidor);
        $repartidor->delete();
    }

    public function aceptarPedido(Request $request){
        $idPedido = $request->id;
        $pedido = new pedidosController();
        $repartidor = new repartidoresController();

        $idUsuario = $request->id_Usuario;

        $idRepartidor = $repartidor->obtenerRepartidor($idUsuario)->first()->id;

        $pedido->editarRepartidor($idPedido, $idRepartidor);
        $pedido->editarEstado($idPedido, 'En espera');
    }
}
