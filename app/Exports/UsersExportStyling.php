<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;

class UsersExportStyling implements FromCollection, WithHeadings, WithEvents, ShouldAutoSize
{
  /**
  * @return \Illuminate\Support\Collection
  */
  public function collection()
  {
    return User::all();
  }

  public function headings(): array
  {
    return [
      'No.',
      'Nombre de Usuario',
      'Nombre Completo',
      'Correo Electrónico',
      'Creación',
      'Actualización'
    ];
  }

  /**
   * @retur array
   */
  public function registerEvents(): array
  {
    return [
      AfterSheet::class => function(AfterSheet $event) {
        $cellRange = 'A1:W1'; // Todos los encabezados
        $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
      },
    ];
  }
}