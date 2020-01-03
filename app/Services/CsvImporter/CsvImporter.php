<?php

namespace App\Services\CsvImporter;

use App\Models\CsvRow;
use App\Models\CsvRowLog;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\DB;
use App\Services\CsvImporter\Pipes\ImportUsers;
use App\Services\CsvImporter\Exceptions\MissingUserEmailException;

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
    // Capturar las excepciones y convertirlas en registros CsvRowLog
    // para mostrar al usuario
    // Enviar los datos a través de la tubería
    try {
      // Una transacción de base de datos permite revertir cualquiera
      // de los cambios anteriores
      DB::beginTransaction();

      return app(Pipeline::class)
          ->send($this->traveler->setRow($row))
          ->through([
              ImportUsers::class
          ])->then(function ($progress) {
              $this->traveler->getRow()->markImported();
              DB::commit();

              return $progress;
          });
    } catch (\Exception $e) {
      DB::rollBack();
      $this->logException($e);
      
      return false;
    }
  }

  /**
   * Generar una excepción si sucede algo que se considera un "error"
   */
  private function logException(\Exception $e)
  {
    switch (get_class($e)) {
        case MissingUserEmailException::class;
            $pipe = MissingUserEmailException::class;
            $code = MissingUserEmailException::CODE;
            break;
            
        default:
            $code = 'general_error';
            break;
    }

    // Detectar el error y conviértalo en un registro para realizar 
    // un seguimiento de lo que salió mal
    $this->traveler->getRow()
        ->markFailed()
        ->logs()
        ->create([
            'pipe'    => $pipe ?? null,
            'code'    => $code ?? null,
            'message' => $e->getMessage(),
            'level'   => CsvRowLog::LEVEL_ERROR
        ]);
  }
}