<?php
    
namespace App\Services\CsvImporter;

use App\Models\CsvRow;
    
class CsvImportTraveler
{
  private $row;

  private $user;

  public function setRow(CsvRow $row): CsvImportTraveler
  {
    $this->row = $row;

    return $this;
  }

  public function getRow(): CsvRow
  {
    return $this->row;
  }

  /**
   * @return mixed
   */
  public function getUser()
  {
      return $this->user;
  }

  /**
   * @param mixed $user
   * @return CsvImportTraveler
   */
  public function setUser($user): CsvImportTraveler
  {
      $this->user = $user;

      return $this;
  }
}