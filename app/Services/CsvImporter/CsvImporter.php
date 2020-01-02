<?php

namespace App\Services\CsvImporter;

use App\Models\CsvRow;
use Illuminate\Pipeline\Pipeline;
use App\Services\CsvImporter\Pipes\ImportUsers;

/**
 * Servicio de arranque que crea una nueva instancia CSVImportTraveler,
 * la configura CsvRow y la pasa a través de una serie de tuberías, 
 * y finalmente devuelve el objeto viajero al final.
 */
class CsvImporter
{
  private $traveler;

  public function __construct(CsvImportTraveler $traveler)
  {
    $this->traveler = $traveler;
  }

  public function importRow(CsvRow $row)
  {
    return app(Pipeline::class)
          ->send($this->traveler->setRow($row))
          ->through([
              ImportUsers::class
          ])->then(function ($traveler) {
              return $traveler;
          });
  }
}