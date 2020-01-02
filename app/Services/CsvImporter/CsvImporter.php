<?php

namespace App\Services\CsvImporter;

use App\Models\CsvRow;
use Illuminate\Pipeline\Pipeline;
use App\Services\CsvImporter\Pipes\ImportUsers;

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