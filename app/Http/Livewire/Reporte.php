<?php

namespace App\Http\Livewire;

use App\Exports\ReporteExport;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Livewire\WithPagination;

class Reporte extends Component
{
    use WithPagination;
    public function render()
    {
        return view('livewire.reporte')
        ->extends('layouts.app')
        ->section('content');
    }

    public function exportExcel()
    {
        return Excel::download(new ReporteExport, 'reporte.xlsx');
    }

    public function exportPDF()
    {
        $pdf = PDF::loadView('livewire.reporte-pdf');
        return $pdf->download('reporte.pdf');
    }
}

