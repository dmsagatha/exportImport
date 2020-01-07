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
    Route::post('users/importValidate', 'UsersExcelController@import_validate')->name('usersExcel.import_validate');
    
    // Importar Productos y Categorías con Laravel Excel
    Route::get('importsExcel', 'ImportsExcelController@index')->name('importsExcel.index');
    Route::post('importsExcel/Products', 'ImportsExcelController@importProductsCategories')->name('importsExcel.importProductsCategories');
    
    // Importar con Trait - Daily Laravel
    // https://www.youtube.com/watch?v=tpZK2A98ig0
    // Validaciones: https://www.youtube.com/watch?v=pshvWCCyCGw
    Route::resource('users', 'UsersController');
    Route::post('usersImport/parseCsv', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('usersImport/processCsv', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::resource('categories', 'CategoryController');
    Route::post('categoriesImport/parseCsv', 'CategoryController@parseCsvImport')->name('categories.parseCsvImport');
    Route::post('categoriesImport/processCsv', 'CategoryController@processCsvImport')->name('categories.processCsvImport');

    // Importar Usuarios con Trait - Zaengle
    // https://zaengle.com/blog/building-a-csv-importer-part-1
    // https://github.com/zaengle/demo-csv-importer
    Route::get('csvUploads', 'CsvUploadController@index')->name('csvUploads.index');
    Route::get('csvUploads/create', 'CsvUploadController@create')->name('csvUploads.create');
    Route::post('csvUploads', 'CsvUploadController@store')->name('csvUploads.store');
    Route::get('csvUploads/{csvUpload}', 'CsvUploadController@show')->name('csvUploads.show');

    Route::get('csvUploads/{csvUpload}/map-columns', 'MapColumnsController@show')->name('csvUploads.map-columns.show');
    Route::post('csvUploads/{csvUpload}/map-columns', 'MapColumnsController@store')->name('csvUploads.map-columns.store');

    // Importar tablas relacionadas
    // Programación y más
    // https://www.youtube.com/watch?v=xEpNTPJ2dOc&list=PLzSFZWTjelbIi1UJ3WZZK8vVzgmhjAq25&index=19
    Route::get('importView/relatedTables', 'Import\ImportController@importProducts')->name('importView.relatedTables');

    // Importar archivos grandes
    // https://daveismyname.blog/laravel-import-large-csv-file
    Route::get('importView/categories', 'Import\ImportController@importViewCategories')->name('importView.categories');
    Route::post('importView/importLarge', 'Import\ImportController@importLarge')->name('importView.importLarge');
  }
);

// Importaciones de datos a la Base de Datos
Route::group([
    'namespace' => 'Admin\Import',
    'as' 		=> 'import.',
    'prefix'    => 'import'
  ],
  function () {
    // Importar validando el campo único en el Modelo ImportData y realizar la importación
    // https://makitweb.com/import-csv-data-to-mysql-database-with-laravel/
    Route::get('users', 'ImportController@viewUsers')->name('users');
    Route::post('users', 'ImportController@importUsers')->name('usersCsv');
    
    Route::get('categories', 'ImportController@viewCategories')->name('categories');
    Route::post('categories', 'ImportController@importCategories')->name('categoriesCsv');
  });