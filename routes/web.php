<?php

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', 'DashboardController@panel')->name('panel');

Route::group(
  [
    'namespace' => 'Admin',
    'as' 		    => 'admin.',
    'prefix'    => 'admin'
  ],
  function () {
    Route::get('usuariosExcel', 'UsersExcelController@index')->name('users.excel.index');
    
    // Exportar Usuarios
    Route::get('users/exportar', 'UsersExcelController@export')->name('usersExcel.export');
    Route::get('users/exportarVista', 'UsersExcelController@export_view')->name('usersExcel.export_view');
    Route::get('users/exportarEstilos', 'UsersExcelController@export_styling')->name('usersExcel.export_styling');
    
    // Importar Usuarios
    Route::post('users/importar', 'UsersExcelController@import')->name('usersExcel.import');
    Route::post('users/importarValidar', 'UsersExcelController@import_validate')->name('usersExcel.import_validate');
  }
);