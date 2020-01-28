<?php

namespace App\Services\CsvImporter\Pipes;

use App\Models\Product;
use App\Services\CsvImporter\CsvImportTraveler;

/**
 * @package App\Services\CsvImporter\Pipes
 */
class ImportProducts implements CsvImporterPipe
{
  /**
   * @param CsvImportTraveler $traveler
   * @param \Closure $next
   * @return mixed
   */
  public function handle(CsvImportTraveler $traveler, \Closure $next)
  {
    $product = Product::firstOrCreate(
    [
        'title'       => $traveler->getRow()->contents['title'],
        'url'         => $traveler->getRow()->contents['url'],
        'description' => $traveler->getRow()->contents['description'],
    ]);

    $traveler->setProduct($product);

    return $next($traveler);
  }
}