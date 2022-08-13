<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class horariosController extends Controller
{
    public function listar(Request $request)
    {

        //$cantidad = Reservas::where('',[$request->horaApertura,'horaCierre'])

        $horarios = DB::select(DB::raw("select h.*
        ,count(r.id) as reservaciones
    FROM 
        horarios as h
        left join reservas as r
        on h.id = r.id_horario
        AND r.created_at::date = now()::date
    GROUP BY
        h.id 
        
    HAVING 
        count(r.id) < 2"));
            

        return $horarios;

    }

   /* public function obtenerHorario($idHorario)
    {
        $horario = DB::table('horarios')
            ->select('horarios.horaini')
            ->where('horarios.id', '=', $idHorario)
            ->get();

        return $horario;
    }*/
}
