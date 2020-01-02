<?php

namespace App\Services\CsvImporter\Pipes;

use App\Models\User;
use App\Services\CsvImporter\CsvImportTraveler;

/**
 * Class ImportUser
 * @package App\Services\CsvImporter\Pipes
 */
class ImportUsers implements CsvImporterPipe
{
  /**
   * @param CsvImportTraveler $traveler
   * @param \Closure $next
   * @return mixed
   */
  public function handle(CsvImportTraveler $traveler, \Closure $next)
  {
    /* if ( ! isset($traveler->getRow()->contents['email'])) {
        throw new MissingUserEmailException('No email was set for user.');
    } */

    $user = User::firstOrCreate([
        'email'    => $traveler->getRow()->contents['email']
    ],
    [
        'username' => $traveler->getRow()->contents['username'],
        'name'     => $traveler->getRow()->contents['name'],
        'password' => $traveler->getRow()->contents['password'],
    ]);

    $traveler->setUser($user);

    return $next($traveler);
  }
}