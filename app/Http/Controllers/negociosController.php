<?php

namespace App\Http\Controllers;

use App\Models\Direcciones;
use App\Models\Negocios;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class negociosController extends Controller
{
    public function vista()
    {
        return view('pages.negocios');
    }

    public function obtenerNegocio($idUsuario)
    {
        $negocio = DB::table('negocios')
            ->select('negocios.*')
            ->where('negocios.idUsuario', '=', $idUsuario)
            ->get();

        return $negocio;
    }

    /**
     * Función para obtener los datos para mostrar los detalles de un negocio
     */
    public function infoNegocio($idNegocio)
    {

        $detalles = DB::table('users')
            //->join('direcciones', 'direcciones.id', '=', 'users.idDireccion')
            ->join('negocios', 'negocios.idUsuario', '=', 'users.id')
            ->select(
                'users.nombre',
                'users.correo',
                'users.telefono',
                
                'negocios.*'
            )
            ->where('negocios.id', '=', $idNegocio)
            ->get();

        return $detalles;
    }

    public function listar()
    {
        //$negocios = Negocios::all();


        $negocios = DB::table('users')
            //->join('direcciones', 'direcciones.id', '=', 'users.idDireccion')
            ->join('negocios', 'negocios.idUsuario', '=', 'users.id')
            ->select('users.*', 'negocios.*')
            ->where('tipoUsuario', '=', 2)
            ->get();


        return $negocios;
    }

    public function guardarNegocio(Request $request)
    {

        $reglas = new reglasController();
        $reglas->reglasUsuarios($request);
        
        $reglas->reglasNegocios($request);
       
        $guardarUsuario = new UserController();
        $tipoUsuario = 2;
        $guardarUsuario->guardarUsuarios($request, $tipoUsuario);

        $nuevoNegocio = new Negocios();
        $nuevoNegocio->horaApertura = $request->horaApertura;
        $nuevoNegocio->horaCierre = $request->horaCierre;
        $nuevoNegocio->descripcion = $request->descripcion;
        $nuevoNegocio->idUsuario = User::max('id');
        $nuevoNegocio->save();
    }

    public function editarNegocio(Request $request)
    {

        $reglas = new reglasController();
        //$reglas->reglasUsuarios($request);
        $reglas->reglasEditarUsuarios($request);
        //$reglas->reglasDirecciones($request);
        $reglas->reglasNegocios($request);


        //$direcciones = new direccionesController();
        //$direcciones->editarDireccionesNegocios($request);

        $usuarios = new UserController();
        $usuarios->editarUsuariosNegocios($request);

        $negocio = Negocios::find($request->id);
        /*$usuario = User::find($negocio->idUsuario);        
       $direccion = Direcciones::find($usuario->idDireccion);*/

        $negocio->horaApertura = $request->horaApertura;
        $negocio->horaCierre = $request->horaCierre;
        $negocio->descripcion = $request->descripcion;
        $negocio->save();
    }

    public function eliminarNegocio($idNegocio)
    {
        $negocio = Negocios::find($idNegocio);
        $usuario = User::find($negocio->idUsuario);
        $direccion = Direcciones::find($usuario->idDireccion);

        $negocio->delete();
        $usuario->delete();
        $direccion->delete();
    }

    public function completarPedido(Request $request)
    {
        $idPedido = $request->idPedido;
        $pedido = new pedidosController();

        $pedido->editarEstado($idPedido, 'Preparado');
    }
}
