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
    Route::get('usuarios', 'UserController@index')->name('users.index');
    Route::get('usuarios/crear', 'UserController@create')->name('users.create');
    Route::post('usuarios', 'UserController@store')->name('users.store');
    Route::get('usuarios/{user}', 'UserController@show')->name('users.show');
    Route::get('usuarios/{user}/editar', 'UserController@edit')->name('users.edit');
    Route::post('usuarios/actualizar', 'UserController@update')->name('users.update');
    Route::delete('usuarios/{user}', 'UserController@destroy')->name('users.destroy');

    // Exportar Usuarios
    Route::get('usuariosExcel', 'UsersExcelController@index')->name('users.excel.index');
    Route::get('users/exportar', 'UsersExcelController@export_view')->name('usersExcel.export_view');
    Route::get('users/exportarStilos', 'UsersExcelController@export_styling')->name('usersExcel.export_styling');

    // Importar Usuarios
    Route::post('users/importar', 'UsersExcelController@import')->name('usersExcel.import');
    Route::post('users/importarValidar', 'UsersExcelController@importValidate')->name('usersExcel.importValidate');
    
    Route::get('cpus', 'CpuController@index')->name('cpus.index');
    Route::get('cpus/crear', 'CpuController@create')->name('cpus.create');
    Route::post('cpus', 'CpuController@store')->name('cpus.store');
    Route::get('cpus/{cpu}', 'CpuController@show')->name('cpus.show');
    Route::get('cpus/{cpu}/editar', 'CpuController@edit')->name('cpus.edit');
    Route::patch('cpus/{cpu}', 'CpuController@update')->name('cpus.update');
    Route::delete('cpus/{cpu}', 'CpuController@destroy')->name('cpus.destroy');
    
    // Select dinámico para elegir el Tipo y Modelo de la Cpu
    Route::get('getCpuModels', 'CpuController@getCpuModels');
    
    Route::get('pantallas', 'ScreenController@index')->name('screens.index');
    Route::get('pantallas/crear', 'ScreenController@create')->name('screens.create');
    Route::post('pantallas', 'ScreenController@store')->name('screens.store');
    Route::get('pantallas/{screen}', 'ScreenController@show')->name('screens.show');
    Route::get('pantallas/{screen}/editar', 'ScreenController@edit')->name('screens.edit');
    Route::patch('pantallas/{screen}', 'ScreenController@update')->name('screens.update');
    Route::delete('pantallas/{screen}', 'ScreenController@destroy')->name('screens.destroy');

    // Adicionar/Remover varios campos a la vez
    Route::get("productos/crear", "ProductController@create")->name('products.create');
    Route::post("productos", "ProductController@store")->name('products.store');
    
    // Adicionar/Remover varios campos a la vez
    Route::get('marcas', 'BrandController@index')->name('brands.index');
    Route::get('marcas/crear', 'BrandController@create')->name('brands.create');
    Route::post('marcas', 'BrandController@store')->name('brands.store');
    Route::get('marcas/{brand}', 'BrandController@show')->name('brands.show');
    Route::get('marcas/{brand}/editar', 'BrandController@edit')->name('brands.edit');
    Route::patch('marcas/{brand}', 'BrandController@update')->name('brands.update');
    Route::delete('marcas/{brand}', 'BrandController@destroy')->name('brands.destroy');
  }
);