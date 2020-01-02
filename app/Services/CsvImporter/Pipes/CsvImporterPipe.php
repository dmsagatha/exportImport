<?php

namespace App\Services\CsvImporter\Pipes;

use App\Services\CsvImporter\CsvImportTraveler;

/**
 * Interface CsvImporterPipe
 * @package App\Services\CsvImporter\Pipes
 */
interface CsvImporterPipe
{
  /**
   * @param CsvImportTraveler $traveler
   * @param \Closure $next
   * @return mixed
   */
  public function handle(CsvImportTraveler $traveler, \Closure $next);
}