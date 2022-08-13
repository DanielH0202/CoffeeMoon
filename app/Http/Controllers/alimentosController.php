<?php

namespace App\Http\Controllers;

use App\Models\Alimentos;
use App\Models\Negocios;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class alimentosController extends Controller
{
    public function vista()
    {
        return view('pages.alimentos');
    }

    /**
     * Función para obtener los datos para mostrar los detalles de un alimento
     */
    public function infoAlimento($idAlimentos)
    {
        $alimento = Alimentos::find($idAlimentos);

        return $alimento;
    }

    public function listarAlimentos($tipoUsuario)
    {
        if ($tipoUsuario == 8 || $tipoUsuario == 0) {
            $negocios = DB::table('users')
                ->join('negocios', 'negocios.idUsuario', '=', 'users.id')
                ->join('alimentos', 'alimentos.idNegocios', '=', 'negocios.id')
                ->select('users.name', 'alimentos.*')
                ->where('tipoUsuario', '=', 2)
                ->get();

            return $negocios;
        } else {
            $idUsuario = auth()->user()->id;
            $idNegocio = DB::table('negocios')->where('idUsuario', '=', $idUsuario)->first()->id;
            $negocios = DB::table('users')
                ->join('negocios', 'negocios.idUsuario', '=', 'users.id')
                ->join('alimentos', 'alimentos.idNegocios', '=', 'negocios.id')
                ->select('users.name', 'alimentos.*')
                ->where('tipoUsuario', '=', 2)
                ->where('alimentos.idNegocios', '=', $idNegocio)
                ->get();

            return $negocios;
        }
    }

    public function listarNegocio()
    {
        $negocios = DB::table('users')
            ->join('negocios', 'negocios.idUsuario', '=', 'users.id')
            ->select('users.name', 'negocios.id')
            ->where('tipoUsuario', '=', 2)
            ->get();


        return $negocios;
    }

    public function guardarAlimentos(Request $request)
    {
        $reglas = new reglasController();
        $reglas->reglasAlimentos($request);

        $nuevoAlimento = new Alimentos();
        $nuevoAlimento->nombre = $request->nombre;
        $nuevoAlimento->precio = $request->precio;
        $nuevoAlimento->estatus = $request->estatus;
        if (auth()->user()->tipoUsuario == "8") {
            $nuevoAlimento->idNegocios = $request->idNegocios;
        } else {
            $idN = DB::table('negocios')->where('idUsuario', '=', $request->idUsuario)->first()->id;
            $nuevoAlimento->idNegocios = $idN;
        }
        if (is_file($request->file('archivo'))) {
            $nuevoAlimento->rutaImagen = $request->file('archivo')->store('alimentos', 'public');
        } else {
            $nuevoAlimento->rutaImagen = '../argon/img/brand/favicon.png';
        }

        $nuevoAlimento->save();
    }

    public function editarAlimentos(Request $request)
    {
        $reglas = new reglasController();
        $reglas->reglasAlimentos($request);

        $alimento = Alimentos::find($request->id);
        $alimento->nombre = $request->nombre;
        $alimento->precio = $request->precio;
        $alimento->estatus = $request->estatus;
        $alimento->idNegocios = $request->idNegocios;
        if (auth()->user()->tipoUsuario == "8") {
            $alimento->idNegocios = $request->idNegocios;
        } else {
            $idN = DB::table('negocios')->where('idUsuario', '=', $request->idUsuario)->first()->id;
            $alimento->idNegocios = $idN;
        }
        if (is_file($request->file('archivo'))) {
            $alimento->rutaImagen = $request->file('archivo')->store('alimentos', 'public');
        }

        $alimento->save();
    }

    public function eliminarAlimentos($idAlimentos)
    {
        $alimento = Alimentos::find($idAlimentos);
        $deletePath = "public/" . $alimento->rutaImagen;

        Storage::delete($deletePath);
        $alimento->delete();
    }
}
