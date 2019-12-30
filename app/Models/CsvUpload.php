<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CsvUpload extends Model
{
  protected $table = 'csv_uploads';

  protected $fillable = [
    'original_filename',
    'has_headers',
    'file_contents',
    'column_mapping',
    'parsed_at',
  ];

  protected $dates = [
    'parsed_at'
  ];

  protected $casts = [
    'file_contents'  => 'array',
    'column_mapping' => 'array',
    'permissions'    => 'array'
  ];
}