<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Direcciones;
use App\Models\Negocios;
use App\Models\Repartidores;
use App\Models\User;
use Illuminate\Http\Request;

/*class direccionesController extends Controller
{

   
    public function infoDireccion($idDireccion)
    {
        $alimento = Direcciones::find($idDireccion);

        return $alimento;
    }

    public function guardarDireccion(Request $request){

        $nuevaDireccion = new Direcciones();
        $nuevaDireccion->calle = $request->calle;
        $nuevaDireccion->colonia = $request->colonia;
        $nuevaDireccion->ciudad = $request->ciudad;
        $nuevaDireccion->estado = $request->estado;
        $nuevaDireccion->pais = $request->pais;
        $nuevaDireccion->codigoPostal = $request->codigoPostal;
        $nuevaDireccion->noExt = $request->noExt;
        $nuevaDireccion->noInt = $request->noInt;
        $nuevaDireccion->save();
    }

    public function editarDireccionesNegocios(Request $request){
        $negocio = Negocios::find($request->id);
        $usuario = User::find($negocio->idUsuario);        
        $direccion = Direcciones::find($usuario->idDireccion);
        
        $direccion->calle = $request->calle;
        $direccion->colonia = $request->colonia;
        $direccion->ciudad = $request->ciudad;
        $direccion->estado = $request->estado;
        $direccion->pais = $request->pais;
        $direccion->codigoPostal = $request->codigoPostal;
        $direccion->noExt = $request->noExt;
        $direccion->noInt = $request->noInt;
        $direccion->save();
    }
    public function editarDireccionesClientes(Request $request){
        $clientes = Clientes::find($request->id);
        $usuario = User::find($clientes->idUsuario);        
        $direccion = Direcciones::find($usuario->idDireccion);
        
        $direccion->calle = $request->calle;
        $direccion->colonia = $request->colonia;
        $direccion->ciudad = $request->ciudad;
        $direccion->estado = $request->estado;
        $direccion->pais = $request->pais;
        $direccion->codigoPostal = $request->codigoPostal;
        $direccion->noExt = $request->noExt;
        $direccion->noInt = $request->noInt;
        $direccion->save();
    }
    public function editarDireccionesRepartidor(Request $request){
        $repartidor = Repartidores::find($request->id);
        $usuario = User::find($repartidor->idUsuario);        
        $direccion = Direcciones::find($usuario->idDireccion);
        
        $direccion->calle = $request->calle;
        $direccion->colonia = $request->colonia;
        $direccion->ciudad = $request->ciudad;
        $direccion->estado = $request->estado;
        $direccion->pais = $request->pais;
        $direccion->codigoPostal = $request->codigoPostal;
        $direccion->noExt = $request->noExt;
        $direccion->noInt = $request->noInt;
        $direccion->save();
    }
}*/
