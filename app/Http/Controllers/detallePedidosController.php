<?php

namespace App\Http\Controllers;

use App\Models\DetallePedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class detallePedidosController extends Controller
{
    public function vista()
    {
        return view('pages.carrito');
    }

    public function obtenerPedido(Request $request)
    {
        $Clientes = new clientesController();
        $pedidos = new pedidosController();
        $productos = new detallePedidosController();

        //Obtener el id del cliente, el id del pedido y los productos del pedido
        $idCliente = $Clientes->obtenerCliente($request->idUsuario);
        $idPedido = $pedidos->obtenerIDPedido($idCliente->first()->id)->id;
        $productos = $productos->listarProductos($idPedido);

        return $productos;
    }

    public function listarProductos($idPedido)
    {
        $listaProductos = DB::table('detallePedido')
            ->join('alimentos', 'detallePedido.idAlimento', '=', 'alimentos.id')
            ->join('pedidos','detallePedido.idPedido', '=', 'pedidos.id')
            ->join('clientes','pedidos.idCliente', '=', 'clientes.id')
            ->join('users','clientes.idUsuario', '=', 'users.id')
            ->select('detallePedido.*', 'alimentos.idNegocios', 'alimentos.nombre',
                'alimentos.precio', 'alimentos.estatus', 'users.name')
            ->where('idPedido', '=', $idPedido)
            ->get();

        return $listaProductos;
    }

    public function guardarProducto(Request $request)
    {
        $nuevoProducto = new DetallePedido();

        $nuevoProducto->idPedido = $request->idPedido;
        $nuevoProducto->idAlimento = $request->id_Alimento;

        //Verificar que el producto no se haya registrado con anterioridad
        $comprobacion = DB::table('detallePedido')
            ->select('detallePedido.*')
            ->where('idAlimento', '=', $nuevoProducto->idAlimento)
            ->count();

        if ($comprobacion == 0) {
            $nuevoProducto->cantidad = $request->cantidad;
            $nuevoProducto->save();
        }
    }

    public function editarProducto(Request $request)
    {
        $producto = DetallePedido::find($request->id);
        $producto->cantidad = $request->cantidad;

        $producto->save();
    }


    public function eliminarProducto($idDetalleProducto)
    {
        $producto = DetallePedido::find($idDetalleProducto);
        $producto->delete();
    }
}
