<?php

use App\Trabajador;
use Illuminate\Http\Request;

/**
 *  Get the full list of trabajadors
 */
Route::get('/','TrabajadorController@index');
Route::resource('trabajador', 'TrabajadorController');

/**
 *  Get a specific trabajador
 */

Route::get('/trabajador/edit/{id}', function($id) {
	$trabajador = Trabajador::findOrFail($id);

	return response()->json($trabajador);
});


/**
 *  Edit a trabajador
 */
Route::put('/trabajador/editar/', 'TrabajadorController@update');

/**
 *  Delete a trabajador
 */
Route::delete('/trabajador/eliminar/', 'TrabajadorController@destroy');
Route::get('/trabajador/delete/{id}',['as' => 'deleteTrabajador', function(Request $request, $id){
	if ($request->ajax()) {
		 $trabajador = Trabajador::destroy($id);
	     return Redirect('/');
	}
	   
}]) 
->where(['id' => '[0-9]+']);
