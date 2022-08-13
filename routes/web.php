<?php

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\alimentosController;
use App\Http\Controllers\clientesController;
use App\Http\Controllers\detallePedidosController;
use App\Http\Controllers\direccionesController;
use App\Http\Controllers\negociosController;
use App\Http\Controllers\repartidoresController;
use App\Http\Controllers\encuestasController;
use App\Http\Controllers\pagosController;
use App\Http\Controllers\pedidoRepartidorController;
use App\Http\Controllers\pedidosController;
use App\Http\Controllers\horariosController;
use App\Http\Controllers\reportesController;
use App\Http\Controllers\ReservasController;
use App\Models\Negocios;
use App\Models\Pedidos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/negocios',[negociosController::class,'vista']); /*->middleware('auth'); manual*/


Route::get('/CoffeeMoon', function () {
	$existePedido = DB::table('pedidos')
            ->select('pedidos.*')
            ->where('estatusPedido', '=', 'Comprando')
            ->where('idCliente', '=', 2)
            ->count();

        return $existePedido;
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::get('/avisoPrivacidad', function(){return view('privacyPolicy');})->name('avisoPrivacidad');

Route::get('/gmaps', ['as ' => 'gmaps', 'uses' => 'GmapsController@index']);

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
	Route::get('map', function () {return view('pages.maps');})->name('map');
	Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);


	/* Rutas protegidas*/
	Route::get('/negocios',[negociosController::class,'vista'])->name('m.negocios')->middleware('validarRol:negocio');
	Route::get('/alimentos',[alimentosController::class,'vista'])->name('m.alimentos')->middleware('validarRol:alimentos');
	Route::get('/clientes',[clientesController::class,'vista'])->name('m.clientes')->middleware('validarRol:cliente');
	Route::get('/repartidores',[repartidoresController::class,'vista'])->name('m.repartidores')->middleware('validarRol:repartidor');
	Route::get('/pedidos',[pedidosController::class,'vista'])->name('m.pedidos');
	Route::get('/carrito', [detallePedidosController::class, 'vista'])->name('m.carrito');
	Route::get('/historialPagos',[pagosController::class,'vista'])->name('m.pagos');
	Route::get('/pedidoActual',[pedidoRepartidorController::class,'vista'])->name('m.pedidoActual');
	Route::get('/reservas',[ReservasController::class,'vista'])->name('m.reservas');

	/* RUTAS NEGOCIOS */
	Route::get('/listaNegocios',[negociosController::class,'listar']);
	Route::post('/completarPedido',[negociosController::class,'completarPedido']);
	Route::post('/guardarNegocio',[negociosController::class, 'guardarNegocio']);
	Route::post('/editarNegocio',[negociosController::class,'editarNegocio']);
	Route::delete('/eliminarNegocio/{idNegocio}',[negociosController::class,'eliminarNegocio']);

	/* RUTAS RESERVAS */
	Route::get('/listaReservas',[ReservasController::class,'listar']);	
	Route::post('/guardarReservas',[ReservasController::class, 'guardarReservas']);
	Route::post('/editarReservas',[ReservasController::class,'editarReservas']);
	Route::delete('/eliminarReservas/{idReservas}',[ReservasController::class,'eliminarReservas']);

	/* RUTAS horarios */
	Route::get('/listaHorarios',[horariosController::class,'listar']);

	/* RUTAS ALIMENTOS */
	Route::get('/listaNegociosAlimentos',[alimentosController::class,'listarNegocio']);
	Route::get('/listaAlimentos/{tipoUsuario}',[alimentosController::class,'listarAlimentos']);
	Route::post('/guardarAlimentos',[alimentosController::class, 'guardarAlimentos']);
	Route::post('/editarAlimentos',[alimentosController::class,'editarAlimentos']);
	Route::delete('/eliminarAlimentos/{idAlimentos}',[alimentosController::class,'eliminarAlimentos']);
	Route::post('/editarImagen',[alimentosController::class, 'editarImagen']);

	/* RUTAS CLIENTES */
	Route::get('/listaCliente',[clientesController::class,'listar']);
	Route::post('/guardarCliente',[clientesController::class, 'almacenarCliente']);
	Route::post('/editarCliente',[clientesController::class,'editarCliente']);
	Route::delete('/eliminarCliente/{idCliente}',[clientesController::class,'eliminarCliente']);

	/* RUTAS REPARTIDORES */
	Route::get('/listaRepartidores',[repartidoresController::class,'listarRepartidores']);
	Route::post('/aceptarPedido',[repartidoresController::class,'aceptarPedido']);
	Route::post('/guardarRepartidor',[repartidoresController::class, 'guardarRepartidor']);
	Route::post('/editarRepartidor',[repartidoresController::class,'editarRepartidor']);
	
	Route::delete('/eliminarRepartidor/{idRepartidor}',[repartidoresController::class,'eliminarRepartidor']);

	/* RUTAS PEDIDOS */
	Route::get('/listaPedidos',[pedidosController::class,'listarPedidos']);
	Route::get('/listaPedidosRep',[pedidosController::class,'listarPedidosRep']);
	Route::get('/listarPedidosNegocio/{idUsuario}',[pedidosController::class,'listarPedidosNegocio']);
	Route::post('/editarPedidos',[pedidosController::class,'editarPedidos']);
	Route::delete('/eliminarPedido/{idPedidos}',[pedidosController::class,'eliminarPedido']);

	/* RUTAS PRODUCTOS EN PEDIDO */
	Route::post('/listaProducto',[detallePedidosController::class, 'obtenerPedido']);
	Route::post('/guardarProducto',[detallePedidosController::class, 'guardarProducto']);
	Route::delete('/eliminarProducto/{idProducto}',[detallePedidosController::class,'eliminarProducto']);

	/* RUTAS CARRITO DE COMPRAS */
	Route::post('/addCarrito', [pedidosController::class, 'guardarPedido']);
	Route::post('/editarCarrito',[pedidosController::class,'editarEstado']);
	Route::post('/eliminarCarrito',[pedidosController::class,'eliminarPedido']);

	/* RUTAS PAGOS */
	Route::post('/procesarPago',[pagosController::class, 'procesarPago']);
	Route::get('/listarPagos',[pagosController::class,'listarPagos']);
	Route::post('/editarPagos',[pagosController::class,'editarPagos']);
	Route::delete('/eliminarPago/{idPagos}',[pagosController::class,'eliminarPago']);

	/* RUTAS ENCUESTAS */
	Route::post('/guardarEncuestas',[encuestasController::class, 'guardarEncuestas']);
	Route::post('/editarEncuestas',[encuestasController::class,'editarEncuestas']);
	Route::delete('/eliminarEncuestas/{idEncuestas}',[encuestasController::class,'eliminarEncuestas']);

	/* RUTAS PARA EL REPORTE PDF */
	Route::get('/compilarReporte',[reportesController::class,'compilarReporte']);
	Route::get('/ejecutarReporte',[reportesController::class,'ejecutarReporte']);

	/* RUTAS PARA PEDIDO ACTUAL */
	Route::get('/listarPedidoActual/{idUsuario}',[pedidoRepartidorController::class,'listarPedidoActual']);
	Route::post('/recogerPedido',[pedidoRepartidorController::class,'recogerPedido']);
	Route::post('/entregarPedido',[pedidoRepartidorController::class,'entregarPedido']);
});
