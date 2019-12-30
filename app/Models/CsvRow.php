<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CsvRow extends Model
{
  protected $table = 'csv_rows';

  protected $fillable = [
    'csv_upload_id',
    'contents',
    'imported_at',
    'failed_at',
    'warned_at'
  ];

  protected $dates = [
    'imported_at',
    'failed_at',
    'warned_at'
  ];
  
  protected $casts = [
    'contents' => 'array'
  ];
}