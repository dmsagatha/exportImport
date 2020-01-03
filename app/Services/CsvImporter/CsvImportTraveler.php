<?php
    
namespace App\Services\CsvImporter;

use App\Models\CsvRow;

/**
 *  E objeto CsvImportTraveler es como una forma de mover datos entre las tuberías (Pipes)
 */
class CsvImportTraveler
{
  private $row;

  private $user;
  private $product;

  public function setRow(CsvRow $row): CsvImportTraveler
  {
    $this->row = $row;

    return $this;
  }

  public function getRow(): CsvRow
  {
    return $this->row;
  }
  
  public function getUser()
  {
    return $this->user;
  }
  
  public function getProduct()
  {
    return $this->product;
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

  public function setProduct($product): CsvImportTraveler
  {
    $this->product = $product;

    return $this;
  }
}