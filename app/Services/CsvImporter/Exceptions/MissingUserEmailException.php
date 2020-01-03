<?php

namespace App\Services\CsvImporter\Exceptions;

/**
 * Class MissingUserEmailException
 * @package App\Services\CsvImporter\Exceptions
 */
class MissingUserEmailException extends CsvImporterException
{
  const CODE = 'missing_user_email';
}