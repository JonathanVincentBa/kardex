<?php

namespace App\Exports;

use App\Models\Cliente;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReporteExport implements FromView, ShouldAutoSize
{
    use Exportable;

    public $clientes;

    public function __construct() {
        $this->clientes = Cliente::all();
    }

    public function view(): View
    {
        return view('livewire.reporte',[
            $this->clientes
        ]);
    }
}
