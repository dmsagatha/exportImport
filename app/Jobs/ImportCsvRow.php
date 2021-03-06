<?php

namespace App\Jobs;

use App\Models\CsvRow;
use App\Services\CsvImporter\CsvImporter;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ImportCsvRow implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  private $csvRow;

  public function __construct(CsvRow $csvRow)
  {
    $this->csvRow = $csvRow;
  }

  /**
   * Execute the job.
   *
   * @param CSVImporter $csvImporter
   * @return void
   */
  public function handle(CsvImporter $csvImporter)
  {
    // Después de crear la nueva fila CsvRow a una clase CsvImporter que iniciará 
    // la integración de los datos de la fila CSV en la aplicación
    $csvImporter->importRow($this->csvRow);
  }
}