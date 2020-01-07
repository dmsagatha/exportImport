<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    Schema::defaultStringLength(191);
    
    Route::resourceVerbs([
        'create' => 'crear',
        'edit'   => 'editar',
    ]);

    $this->commands([
      \App\Console\Commands\ImportCategories::class
    ]);

    $this->app->booted(function () {
        $schedule = $this->app->make(Schedule::class);
        $schedule->command('import:categories')->everyMinute();
    });
  }
}