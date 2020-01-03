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

  /**
   * Columnas disponibles que se usar para mapear los valores CSV
   * en la aplicación
   */
  public function getAvailableFieldsAttribute()
  {
    return [
      'username',
      'name',
      'email',
      'password',
      'created_at',
      'updated_at',
    ];
  }

  public function rows()
  {
    return $this->hasMany(CsvRow::class, 'csv_upload_id');
  }

  public function getHeaderRowAttribute()
  {
    return array_keys($this->file_contents[0]);
  }

  public function getPreviewRowsAttribute()
  {
    return array_slice($this->file_contents, 0, 5);
  }

  public function getAdditionalRowCountAttribute()
  {
    return (count($this->file_contents) - 5) < 0 ? 0 : count($this->file_contents) - 5;
  }
  
  public function importedRows()
  {
    return $this->hasMany(CsvRow::class, 'csv_upload_id')->imported();
  }
  
  public function warnedRows()
  {
    return $this->hasMany(CsvRow::class, 'csv_upload_id')->warned();
  }
  
  public function failedRows()
  {
    return $this->hasMany(CsvRow::class, 'csv_upload_id')->failed();
  }
}