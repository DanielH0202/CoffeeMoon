<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Direcciones;
use App\Models\Clientes;
use App\Models\Negocios;
use App\Models\Repartidores;
use DateTime;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required','string','min:8','same:password'],
            'telefono' => ['required','numeric','min:10'],
            /*'calle' => ['required','string','min:4','max:50'],
            'colonia' => ['required','string','min:4','max:50'],
            'ciudad' => ['required','string','min:4','max:50'],
            'estado' => ['required','string','min:4','max:50'],
            'pais' => ['required','string','min:4','max:50'],
            'codigoPostal' => ['required','numeric','min:4'],
            'noExt' => ['required','string','min:1','max:50'],
            'noInt' => ['required','string','min:1','max:50'],*/
            'tipoUser' => ['required'],
            'FecNac'=> ['required_if:tipoUser,0,1'],
            'HorAp' => ['required_if:tipoUser,2'],
            'HorCi' => ['required_if:tipoUser,2'],
            'Desc' => ['required_if:tipoUser,2'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        
            
            
                         
            $crearUsuario = User::create([
                'name' => $data['nombre'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'telefono' => $data['telefono'],
                'tipoUsuario' => $data['tipoUser'],
                
            ]);

            if ($data['tipoUser']=="0") {
            
                
                $idUsuario = User::orderBy('id', 'desc')->first()->id;

                Clientes::create([
                    'idUsuario' => $idUsuario,
                    'sexo' => $data['sexo'],
                    'fechaNacimiento' => $data['FecNac'],
                ]);   
                
                return $crearUsuario;

            }elseif ($data['tipoUser']=="1") {

                $idUsuario = User::orderBy('id', 'desc')->first()->id;

                Repartidores::create([
                    'idUsuario' => $idUsuario,
                    'fechaRegistro' => now(),
                    'fechaNacimiento' => $data['FecNac'],
                    'sexo' => $data['sexo'],                    
                ]);   
                
                return $crearUsuario;
                
            }elseif ($data['tipoUser']=="2") {
                
                $idUsuario = User::orderBy('id', 'desc')->first()->id;

                Negocios::create([
                    'horaApertura' => $data['HorAp'],
                    'horaCierre' => $data['HorCi'],
                    'descripcion' => $data['Desc'],
                    'idUsuario' => $idUsuario,
                    
                ]);   
                
                return $crearUsuario;
            }   

        }
    }

