<?php

namespace App\Jobs;

use App\Models\CsvRow;
use App\Models\CsvUpload;
use App\Jobs\ImportCsvRow;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DistributeCsvUploadContentIntoCsvRows implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  private $csvUpload;

  /**
   * Create a new job instance.
   *
   * @return void
   */
  public function __construct(CsvUpload $csvUpload)
  {
    $this->csvUpload = $csvUpload;
  }

  /**
   * Execute the job.
   * 
   * Una vez que se proporciona el mapeo de columnas, hay suficiente información para crear
   * los registros individuales CsvRow.
   * Poner en cola el proceso
   * @return void
   */
  public function handle()
  {
    // Se toma cada fila de la columna file_contents, se aplica la asignación de columnas
    // recién seleccionadas, se crea un registro CsvRow y se pasa al trabajo ImportCsvRow
    collect($this->csvUpload->file_contents)
                ->each(function ($csvRow) {
                    dispatch(new ImportCsvRow(CsvRow::create([
                        'csv_upload_id' => $this->csvUpload->getKey(),
                        'contents'      => $this->normalizeCsvRow($csvRow)
                    ])));
                }
    );
  }

  /**
   * @param array $csvRow
   * 
   * Distribuir la fila CSV en los lugares adecuados en la aplicación
   * @return array
   */
  private function normalizeCsvRow(array $csvRow)
  {
    return collect($this->csvUpload->column_mapping)
              ->flatMap(function ($columnName, $index) use ($csvRow) {
                  return [$columnName => $csvRow[$index]];
              })->toArray();
  }
}