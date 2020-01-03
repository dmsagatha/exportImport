<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Rastrear eventos que suceden a los registros CsvRow individuales 
 * a medida que pasan a través de la tubería (pipes)
 */
class CsvRowLog extends Model
{
  const LEVEL_ERROR = 'error';
  const LEVEL_WARN  = 'warn';

  protected $table = 'csv_row_logs';
  
  protected $fillable = [
      'csv_row_id',
      'code',
      'pipe',
      'message',
      'level'
  ];
}