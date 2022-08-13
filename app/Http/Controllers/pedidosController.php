<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Echo_;

class pedidosController extends Controller
{
    public function vista()
    {
        return view('pages.pedidos');
    }

    public function obtenerIDPedido($idCliente)
    {
        $pedido = DB::table('pedidos')
            ->select('pedidos.*')
            ->where('idCliente', '=', $idCliente)
            ->where('estatusPedido', '=', 'Comprando')
            ->orderBy('pedidos.id', 'desc')
            ->first();

        return $pedido;
    }

    public function listarPedidos()
    {
        $pedidos = DB::table('pedidos')
            ->join('clientes', 'pedidos.idCliente', '=', 'clientes.id')
            ->join('users', 'clientes.idUsuario', '=', 'users.id')
            ->select('pedidos.*', 'users.name', 'users.email')
            ->get();

        return $pedidos;
    }

    public function listarPedidosRep()
    {
        $pedidos = DB::table('pedidos')
            ->join('clientes', 'pedidos.idCliente', '=', 'clientes.id')
            ->join('users', 'clientes.idUsuario', '=', 'users.id')
            ->join('direcciones', 'users.idDireccion', 'direcciones.id')
            ->select(
                'pedidos.*',
                'users.name',
                'direcciones.calle',
                'direcciones.colonia',
                'direcciones.ciudad',
                'direcciones.estado',
                'direcciones.pais',
                'direcciones.codigoPostal',
                'direcciones.noExt',
                'direcciones.noInt'
            )
            ->where('pedidos.estatusPedido', '=', 'Pagado')
            ->get();

        return $pedidos;
    }

    public function listarPedidosNegocio($idUsuario)
    {
        $Negocio = new negociosController();
        $productos = new detallePedidosController();

        $idNegocio = $Negocio->obtenerNegocio($idUsuario);

        //Obtener las ID unicas de los pedidos del negocio
        $idsPedido = DB::table('pedidos')
            ->select('pedidos.id')
            ->join('detallePedido', 'detallePedido.idPedido', '=', 'pedidos.id')
            ->join('alimentos', 'detallePedido.idAlimento', 'alimentos.id')
            ->where("alimentos.idNegocios", "=", $idNegocio->first()->id)
            ->where("pedidos.estatusPedido", "=", "En espera")
            ->distinct()->get();

        $prods = [];

        //Obtener todos los productos de cada negocio
        foreach ($idsPedido as $producto) {

            $id = $producto->id;
            $prods[$id] = $productos->listarProductos($id);
        }
        return $prods;
    }

    public function guardarPedido(Request $request)
    {
        $nuevoPedido = new Pedidos();
        $Clientes = new clientesController();

        //Obtención del id del cliente
        $idUsuario = $request->id_Usuario;
        $idCliente = $Clientes->obtenerCliente($idUsuario);

        //Detectar si existe un pedido de este cliente o hay que crear uno nuevo
        $existePedido = DB::table('pedidos')
            ->select('pedidos.*')
            ->where('estatusPedido', '=', 'Comprando')
            ->where('idCliente', '=', $idCliente->first()->id)
            ->count();

        if ($existePedido == 0) {
            $nuevoPedido->idCliente = $idCliente->first()->id;
            //Repartidor por defecto para indicar que no existe un repartidor todavia
            $nuevoPedido->idRepartidor = 1;
            $nuevoPedido->estatusPedido = 'Comprando';
            $nuevoPedido->save();
        }

        //Encontrar el pedido pendiente más reciente
        $pedidoCon = new pedidosController();
        $pedido = $pedidoCon->obtenerIDPedido($idCliente->first()->id);
        $idPed = $pedido->id;

        //Detectar si ya se ha añadido el producto y añadirlo
        $request->idPedido = $idPed;
        $guardarDetallePedido = new detallePedidosController();
        $guardarDetallePedido->guardarProducto($request);
    }

    public function editarEstado($id, $estatus)
    {
        $pedido = Pedidos::find($id);
        $pedido->estatusPedido = $estatus;
        $pedido->save();
    }

    public function editarRepartidor($id, $idRepartidor)
    {
        $pedido = Pedidos::find($id);
        $pedido->idRepartidor = $idRepartidor;
        $pedido->save();
    }

    public function eliminarPedido($idPedido)
    {
        $pedido = Pedidos::find($idPedido);
        $pedido->delete();
    }

    function console_log($data)
    {
        echo '<script>';
        echo 'console.log(' . json_encode($data) . ')';
        echo '</script>';
    }
}
