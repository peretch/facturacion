<?php

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

#Route::get('/', function () {
#    return view('welcome');
#});

Auth::routes();

Route::group(['middleware'=>'auth'], function () {
	Route::get('/', 'HomeController@index');
	Route::get('/home', 'HomeController@index');
	
	Route::get('/ajustes', 'HomeController@ajustes');
	Route::post('/ajustes/datosPersonales', 'HomeController@ajustesDatosPersonales');
	
	Route::DELETE('/notificaciones/borrar/{notificacion_id}', 'HomeController@borrarNotificacion')->name('borrarNotificacion');

	Route::post('/productos/familiaProductos/nueva', 'ProductoController@nuevaFamiliaProducto');

	Route::get('/productos', 'ProductoController@index');
	Route::get('/productos/movimientos', 'ProductoController@movimientos');

	Route::get('/productos/buscar', 'ProductoController@buscar');		
	
	Route::get('/productos/nuevo', 'ProductoController@nuevo');
	Route::post('/productos/nuevo', 'ProductoController@guardar');
	Route::post('/productos/editar', 'ProductoController@editar');
	Route::post('/productos/borrar', 'ProductoController@borrar');
	Route::get('/productos/detalle/{codigo}', 'ProductoController@detalle');
	Route::post('/productos/{codigo}/configuracion', 'ProductoController@configuracion');
	Route::post('/productos/{codigo}/ModificarStock', 'ProductoController@movimientoModificarStock');
	Route::get('/productos/{codigo}/NotifStockMin', 'ProductoController@NotifStockMin');

	Route::get('/comprobantes/', 'ComprobanteController@index');
	Route::get('/comprobantes/consultas', 'ComprobanteController@consultas');
	Route::get('/comprobantes/nuevo', 'ComprobanteController@nuevo');
	Route::get('/comprobantes/detalle/{comprobanteId}', 'ComprobanteController@detalle');
	Route::get('/comprobantes/imprimir/{comprobanteId}', 'ComprobanteController@imprimir');
	Route::post('/comprobantes/guardar', 'ComprobanteController@guardar');

	Route::get('/clientes/', 'ClienteController@index');
	Route::get('/clientes/nuevo', 'ClienteController@nuevo');
	Route::post('/clientes/guardar', 'ClienteController@guardar');
	Route::get('/clientes/buscar', 'ClienteController@buscar');
	Route::get('/clientes/detalle/{clienteId}', 'ClienteController@detalle');

	Route::get('/indicadores/masVendidos/{mes}', 'IndicadoresController@masVendidos');
});