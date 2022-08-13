<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class reglasController extends Controller
{
    public function reglasDirecciones(Request $request){
        $rules = [
            'calle' => 'required|min:4|max:50|string',
            'colonia' => 'required|min:4|max:50|string',
            'ciudad' => 'required|min:4|max:50|string',
            'estado' => 'required|min:4|max:50|string',
            'pais' => 'required|min:4|max:50|string',
            'codigoPostal' => 'required|min:4|numeric',
            'noInt' => 'required|min:1|max:50|string',
            'noExt' => 'required|min:1|max:50|string'
        ];
        
        $detalle_mensaje = [
            'required' => '<br>Por favor llene el campo de :attribute',
            'string' => '<br>La descripción debe ser un texto describiendo el negocio',
            'min' => '<br>El :attribute requiere un mínimo de :min caracteres',
            'max' => '<br>El :attribute requiere un máximo de :max caracteres',
            'numeric' => '<br>El código postal debe ser numérico'
        ];
        
        return $this->validate($request,$rules,$detalle_mensaje);
    }

    public function reglasUsuarios(Request $request){
        $rules = [
            'name' => 'required|min:4|max:50|string',
            'email' => 'required|min:4|max:50|email',
            'telefono' => 'required|min:10|numeric',
            'password' => 'required|min:8|max:64',
            'password_confirmation' => 'required|min:8|max:64|same:password'  
        ];
        
        $detalle_mensaje = [
            'required' => '<br>Por favor llene el campo de :attribute',
            'string' => '<br>La descripción debe ser un texto describiendo el negocio',
            'numeric' => '<br>Por favor ingrese un número de telefono numérico',
            'min' => '<br>El :attribute requiere un mínimo de :min caracteres',
            'confirmed' => '<br>La contraseña y su confirmación no coinciden',
            'email' => '<br>El email es invalido',
            'same'=> '<br>Las contraseñas no coinciden'
        ];

        return $this->validate($request,$rules,$detalle_mensaje);
    }

    public function reglasEditarUsuarios(Request $request){
        
        $rules = [
            'name' => 'required|min:4|max:50|string',
            'email' => 'required|min:4|max:50|email',
            'telefono' => 'required|min:10|numeric'/*,
            'passwordNew' => 'min:8|max:64|required_if:actualizarPasswordCheck,true',
            'password_confirmation' => 'min:8|max:64|same:passwordNew|required_with:passwordNew',
            'passwordValidation' => 'required|min:8'           */
        ];
        
        $detalle_mensaje = [
            'required' => '<br>Por favor llene el campo de :attribute',
            'string' => '<br>La descripción debe ser un texto describiendo el negocio',
            'numeric' => '<br>Por favor ingrese un número de telefono numérico',
            'min' => '<br>El :attribute requiere un mínimo de :min caracteres',
            'email' => '<br>El email es invalido'/*,
            'confirmed' => '<br>La contraseña y su confirmación no coinciden',
            'same'=> '<br>Las contraseñas no coinciden :attribute',
            'required_if' => '<br>Por favor ingrese la contraseña',
            'required_with' => '<br>Por favor llene la confirmación de la contraseña'*/
        ];

        return $this->validate($request,$rules,$detalle_mensaje);
    }

    public function reglasNegocios(Request $request){
        $rules = [
            /*'horaApertura' => 'required|min:5|max:5|string',
            'horaCierre' => 'required|min:5|max:5|string',*/
            'descripcion' => 'required|min:4|max:250|string'
        ];

        $detalle_mensaje = [
            'required' => '<br>Por favor llene el campo de :attribute',
            'min' => '<br>El :attribute requiere un mínimo de :min caracteres',
            'max' => '<br>El :attribute requiere un máximo de :max caracteres',
            'string' => '<br>La descripción debe ser un texto describiendo el negocio'
        ];

        return $this->validate($request,$rules,$detalle_mensaje);
    }

    public function reglasAlimentos(Request $request){
        $rules = [
            'nombre' => 'required|min:4|max:50|string',
            'precio' => 'required|min:1|numeric',
            'estatus' => 'required'
        ];
    
        $detalle_mensaje = [
            'required' => '<br>Por favor llene el campo de :attribute',
            'string' => '<br>Por favor utilice solamente letras, guión y guiones bajos en el campo :attribute',
            'min' => '<br>El :attribute requiere un mínimo de :min caracteres',
            'max' => '<br>El :attribute requiere un máximo de :max caracteres',
            'numeric' => '<br>El precio del alimento debe ser numérico'
        ];

        return $this->validate($request,$rules,$detalle_mensaje);
    }

    public function reglasCliente($request)
    {

        $rules = [
            'sexo' => 'required|alpha',
            'fechaNacimiento' => 'required'
        ];

        $detalle_mensaje = [
            'required' => '<br>Por favor llene el campo de :attribute',
            'alpha' => '<br>Por favor utilice solamente letras en el campo :attribute'
        ];

        return $this->validate($request, $rules, $detalle_mensaje);
    }

    public function reglasRepartidores($request)
    {
        $rules = [
            'sexo' => 'required|alpha',
            'fechaNacimiento' => 'required'
        ];

        $detalle_mensaje = [
            'required' => '<br>Por favor llene el campo de :attribute',
            'alpha' => '<br>Por favor utilice solamente letras en el campo :attribute'
        ];

        return $this->validate($request, $rules, $detalle_mensaje);
    }

    public function reglasReservas(Request $request){
        $rules = [
            //'horaApertura' => 'required|min:5|max:5|string',
            //'horaCierre' => 'required|min:5|max:5|string',
            
        ];

        $detalle_mensaje = [
            'required' => '<br>Por favor llene el campo de :attribute',
            'min' => '<br>El :attribute requiere un mínimo de :min caracteres',
            'max' => '<br>El :attribute requiere un máximo de :max caracteres',
            'string' => '<br>La descripción debe ser un texto describiendo el negocio'
        ];

        return $this->validate($request,$rules,$detalle_mensaje);
    }
}
