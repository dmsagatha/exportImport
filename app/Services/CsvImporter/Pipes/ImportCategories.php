<?php

namespace App\Services\CsvImporter\Pipes;

use App\Models\Category;
use App\Services\CsvImporter\CsvImportTraveler;
use App\Services\CSVImporter\Exceptions\MissingNameException;
use App\Services\CSVImporter\Exceptions\MissingUrlException;


/**
 * Class ImportUser
 * @package App\Services\CsvImporter\Pipes
 */
class ImportCategories implements CsvImporterPipe
{
  /**
   * @param CsvImportTraveler $traveler
   * @param \Closure $next
   * @return mixed
   * @throws MissingNameException
   * @throws MissingUrlException
   */
  public function handle(CsvImportTraveler $traveler, \Closure $next)
  {
    $this->validateData($traveler);

    $traveler->getProduct()
            ->category()
            ->associate(
              Category::firstOrCreate([
                'name'  => $traveler->getRow()->contents['category_name'],
                'url'   => $traveler->getRow()->contents['category_url'],
              ])
            )->save();

    return $next($traveler);
  }

  /**
   * @param $traveler
   * @throws MissingNameException
   * @throws MissingUrlException
   */
  private function validateData($traveler)
  {
    if (! isset($traveler->getRow()->contents['category_name'])
        || empty($traveler->getRow()->contents['category_name'])) {
        throw new MissingNameException('A la Categoría le falta el nombre.');
    }
    if (! isset($traveler->getRow()->contents['category_url'])
        || empty($traveler->getRow()->contents['category_url'])) {
        throw new MissingUrlException('A la Categoría le falta la url (slug).');
    }
  }
}