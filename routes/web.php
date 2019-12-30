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
    Route::get('usersExcel', 'UsersExcelController@index')->name('users.excel.index');
    
    // Exportar Usuarios con Laravel Excel
    Route::get('users/export', 'UsersExcelController@export')->name('usersExcel.export');
    Route::get('users/exportView', 'UsersExcelController@export_view')->name('usersExcel.export_view');
    Route::get('users/exportStyling', 'UsersExcelController@export_styling')->name('usersExcel.export_styling');
    
    // Importar Usuarios con Laravel Excel
    Route::post('users/import', 'UsersExcelController@import')->name('usersExcel.import');
    Route::post('users/importValidate', 'UsersExcelController@import_validate')->name('usersExcel.import_validate');
    
    // Importar Usuarios con Trait - Daily Laravel
    // https://www.youtube.com/watch?v=tpZK2A98ig0
    // Validaciones: https://www.youtube.com/watch?v=pshvWCCyCGw
    Route::resource('users', 'UsersController');
    Route::post('usersImport/parseCsv', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('usersImport/processCsv', 'UsersController@processCsvImport')->name('users.processCsvImport');

    // Importar Usuarios con Trait - Zaengle
    // https://zaengle.com/blog/building-a-csv-importer-part-1
    // https://github.com/zaengle/demo-csv-importer
    Route::get('csvUploads', 'CsvUploadController@index')->name('csvUploads.index');
  }
);