<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class UsersExportView implements FromView, ShouldAutoSize, WithEvents
{
  public function view(): View
  {
    return view('admin.users._table', [
      'users' => User::all()
    ]);
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