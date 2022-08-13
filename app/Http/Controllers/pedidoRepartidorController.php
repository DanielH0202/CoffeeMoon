<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class pedidoRepartidorController extends Controller
{
    public function vista()
    {
        return view('pages.pedidoActual');
    }

    public function listarPedidoActual($idUsuario)
    {
        $pedido = new pedidosController();
        $repartidor = new repartidoresController();

        $idRepartidor = $repartidor->obtenerRepartidor($idUsuario)->first()->id;

        //Obtener ID del pedido actual
        $pedidoActual = DB::table('pedidos')
            ->select('pedidos.id')
            ->where('idRepartidor', '=', $idRepartidor)
            ->where('estatusPedido', '=', 'En espera')
            ->orWhere('estatusPedido', '=', 'Preparado')
            ->orWhere('estatusPedido', '=', 'Recogido')
            ->get();

        //Obtener datos del pedido que se acaba de obtener
        $datosPedido = DB::table('detallePedido')
            ->join('pedidos', 'detallePedido.idPedido', 'pedidos.id')
            ->join('clientes', 'pedidos.idCliente', '=', 'clientes.id')
            ->join('users', 'clientes.idUsuario', '=', 'users.id')
            
            ->join('alimentos', 'detallePedido.idAlimento', 'alimentos.id')
            ->select(
                'alimentos.nombre',
                'detallePedido.cantidad',
                'users.name',
                
            )
            ->where('idPedido', '=', $pedidoActual->first()->id)
            ->get();
        
        return $datosPedido;
    }

    public function recogerPedido($idUsuario)
    {
        $repartidor = new repartidoresController();
        $pedido = new pedidosController();        

        $idRepartidor = $repartidor->obtenerRepartidor($idUsuario)->first()->id;
        //Obtener ID del pedido actual
        $pedidoActual = DB::table('pedidos')
            ->select('pedidos.id')
            ->where('idRepartidor', '=', $idRepartidor)
            ->where('estatusPedido', '=', 'En espera')
            ->orWhere('estatusPedido', '=', 'Preparado')
            ->orWhere('estatusPedido', '=', 'Recogido')
            ->get();

        $idPedido = $pedidoActual->first()->id;

        $pedido->editarEstado($idPedido, 'Recogido');
    }

    public function entregarPedido($idUsuario)
    {
       $repartidor = new repartidoresController();
        $pedido = new pedidosController();        

        $idRepartidor = $repartidor->obtenerRepartidor($idUsuario)->first()->id;
        //Obtener ID del pedido actual
        $pedidoActual = DB::table('pedidos')
            ->select('pedidos.id')
            ->where('idRepartidor', '=', $idRepartidor)
            ->where('estatusPedido', '=', 'En espera')
            ->orWhere('estatusPedido', '=', 'Preparado')
            ->orWhere('estatusPedido', '=', 'Recogido')
            ->get();

        $idPedido = $pedidoActual->first()->id;

        $pedido->editarEstado($idPedido, 'Entregado');
    }
}
