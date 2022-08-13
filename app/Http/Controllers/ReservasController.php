<?php

namespace App\Http\Controllers;

use App\Models\Reservas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservasController extends Controller
{
    public function vista()
    {
        return view('pages.reservas');
    }
    public function obtenerReservas($idReservas)
    {
        $reservas = DB::table('reservas')
            ->select('reservas.*')
            ->where('reservas.id', '=', $idReservas)
            ->get();

        return $reservas;
    }
   /* public function obtenerReservas($idReservas)
    {
        $reservas = DB::table('reservas')
            ->select('r.*,h.horaini, h.horafin
            FROM 
                reservas as r
                inner join horarios as h
                on r.id_horario = h.id')
            ->where('r.id', '=', $idReservas)
            ->get();

        return $reservas;
    }*/

    public function listar()
    {
        
        //$negocios = Negocios::all();
        $reservas = DB::table('reservas') 
            ->join('horarios', 'horarios.id', '=','reservas.id_horario')
            ->select('reservas.*', 'horarios.horaini as hora_ini', 'horarios.horafin as hora_fin')
            
            ->get();
            
        return $reservas;
    }

    public function guardarReservas(Request $request)
    {
        


        //$cantidad = Reservas::where('',[$request->horaApertura,'horaCierre'])

        //$horarios = DB::select("");

        $reglas = new reglasController();      
        $reglas->reglasReservas($request);

        

        $nuevoReservas = new Reservas();
        $nuevoReservas->nombre = $request->nombre;
        $nuevoReservas->telefono = $request->telefono;
        $nuevoReservas->id_horario = $request->id_horario;
        
        $nuevoReservas->save();
    }

    /**public function editarReservas(Request $request)
    {

        $reglas = new reglasController();
                 
        $reglas->reglasReservas($request);


        

        $reservas = Reservas::find($request->id);
        

       $nuevoReservas->nombre = $request->nombre;
       $nuevoReservas->telefono = $request->telefono;
       $nuevoReservas->horaApertura = $request->horaApertura;
       $nuevoReservas->horaCierre = $request->horaCierre;
        $reservas->save();
    }*/

    public function eliminarReservas($idReservas)
    {
        $reservas = Reservas::find($idReservas);
        

        $reservas->delete();
        
    }

    
}

