<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class validacionRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $rol)
    {
        $tipoUsuario = $request->user()->tipoUsuario;
        $mensaje = 'Acceso denegado a: ' . $request->user()->name;
        if ($rol == 'alimentos') {
            if ($tipoUsuario == 8 || $tipoUsuario == 2 || $tipoUsuario == 0) {
                return $next($request);
            } else {
                //abort(403, $mensaje);
                return redirect()->to('/home')->withCookie('aviso','Acceso Denegado',1);
            }
        }else if($rol == 'negocio'){
            if($tipoUsuario == 8){
                return $next($request);
            } else {
                return redirect()->to('/home')->withCookie('aviso','Acceso Denegado',1);
            }
        }else if($rol == 'cliente'){
            if($tipoUsuario == 8){
                return $next($request);
            } else {
                return redirect()->to('/home')->withCookie('aviso','Acceso Denegado',1);
            }
        }else if($rol == 'repartidor'){
            if($tipoUsuario == 8){
                return $next($request);
            } else {
                return redirect()->to('/home')->withCookie('aviso','Acceso Denegado',1);
            }
        }else{
            return redirect()->to('/home')->withCookie('aviso','Acceso Denegado',1);
        }
        //return $next($request);
    }
}
