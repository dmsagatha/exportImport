<?php

namespace App\Services\CsvImporter\Exceptions;

/**
 * Class MissingNameException
 * @package App\Services\CsvImporter\Exceptions
 */
class MissingNameException extends CsvImporterException
{
  const CODE = 'missing_name';
}