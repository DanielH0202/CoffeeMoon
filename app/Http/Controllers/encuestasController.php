<?php

namespace App\Http\Controllers;

use App\Models\Encuestas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class encuestasController extends Controller
{
    public function vista()
    {
        return view('pages.encuestas');
    }

    /**
     * Función para obtener los datos para mostrar los detalles de las
     * encuestas de un pedido
     */
    public function infoEncuestas($idPedido)
    {
        $encuestas = Encuestas::where('idPedido', $idPedido)
            ->orderBy('id')
            ->get();

        return $encuestas;
    }

    public function guardarEncuestas(Request $request)
    {
        $nuevoEncuesta = new Encuestas();
        $productoCon = new detallePedidosController();

        $listaProductos = $productoCon->listarProductos($request->idPedido);

        //Almacenar la calificación del repartidor
        $nuevoEncuesta->id_tabla = 2;
        $nuevoEncuesta->id_objeto = $request->idRepartidor;
        $nuevoEncuesta->calificacion = $request->califRepartidor;
        $nuevoEncuesta->save();

        //Por el momento todos los productos reciben la misma calificación
        foreach ($listaProductos as $prod) {
            $nuevoEncuesta->id_tabla = 1;
            $nuevoEncuesta->id_objeto = $prod->idAlimento;
            $nuevoEncuesta->calificacion = $request->califComida;
            $nuevoEncuesta->save();
        }
    }

    public function eliminarEncuestas($idEncuestas)
    {
        $encuesta = Encuestas::find($idEncuestas);
        $encuesta->delete();
    }
}
