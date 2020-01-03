<?php

namespace App\Services\CsvImporter\Exceptions;

/**
 * Class MissingUrlException
 * @package App\Services\CsvImporter\Exceptions
 */
class MissingUrlException extends CsvImporterException
{
  const CODE = 'missing_url';
}