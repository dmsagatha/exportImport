<?php

namespace App\Models;

use Carbon\Carbon;
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

  public function logs()
  {
    return $this->hasMany(CsvRowLog::class, 'csv_row_id');
  }

  public function getStatusAttribute()
  {
    if (! is_null($this->attributes['imported_at'])) {
        if (! is_null($this->attributes['warned_at'])) {
            return 'warned';
        }
        return 'imported';
    }
    if (! is_null($this->attributes['failed_at'])) {
        return 'failed';
    }
  }

  public function scopePendingImport($query)
  {
    $query->whereNull('imported_at');
  }

  public function scopeImported($query)
  {
    $query->whereNotNull('imported_at');
  }

  public function scopeWarned($query)
  {
    $query->whereNotNull('warned_at');
  }

  public function scopeFailed($query)
  {
    $query->whereNotNull('failed_at');
  }

  public function markImported()
  {
    $this->update([
        'imported_at' => Carbon::now()
    ]);

    $this->logs()->create([
        'message' => 'Fila importada satisfactoriamente.',
        'level'   => 'success'
    ]);

    return $this;
  }

  public function markFailed()
  {
    $this->update([
        'failed_at' => Carbon::now()
    ]);

    return $this;
  }

  public function markWarned()
  {
    $this->update([
        'warned_at' => Carbon::now()
    ]);

    return $this;
  }
}