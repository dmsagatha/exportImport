<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class TraitMakeCommand extends GeneratorCommand
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  //protected $signature = 'make:trait';
  protected $name = 'make:trait';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Create a new Trait';

  /**
   * Get the stub file for the generator.
   *
   * @return string
   */
  protected function getStub()
  {
      return __DIR__.'/stubs/trait.stub';
  }

  /**
   * Execute the console command.
   *
   * @return mixed
   */
  public function handle()
  {
    //
  }

  /**
   * Get the default namespace for the class.
   *
   * @param  string  $rootNamespace
   * @return string
   */
  protected function getDefaultNamespace($rootNamespace)
  {
    return $rootNamespace.'\Traits';
  }
}