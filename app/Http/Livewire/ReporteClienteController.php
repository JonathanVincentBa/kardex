<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class ReporteClienteController extends Component
{
    use WithPagination;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    
    public $componentName, $pageTitle, $search;
    private $pagination = 50;

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Clientes';
    }
    
    public function render()
    {
        if (strlen($this->search) > 0) {
            $data = Cliente::where('codigo', 'like', '%' . $this->search . '%')
                ->orWhere('nombre', 'like', '%' . $this->search . '%')
                ->orWhere('dni', 'like', '%' . $this->search . '%')
                ->orderBy('id', 'desc')
                ->paginate($this->pagination);
        } else {
            $data = Cliente::withTrashed()
                ->orderBy('id', 'desc')
                ->paginate($this->pagination);
        }
        return view('livewire.cliente.reporte-cliente',['clientes' => $data])
        ->extends('layouts.app')
        ->section('content');
    }

    public function exportExcel()
    {
        return Excel::download(new \App\Exports\ReporteExport, 'reporte.xlsx');
    }

    public function exportPDF()
    {
        if (strlen($this->search) > 0) {
            $data = Cliente::where('codigo', 'like', '%' . $this->search . '%')
                ->orWhere('nombre', 'like', '%' . $this->search . '%')
                ->orWhere('dni', 'like', '%' . $this->search . '%')
                ->orderBy('id', 'desc')
                ->paginate($this->pagination);
        } else {
            $data = Cliente::withTrashed()
                ->orderBy('id', 'desc')
                ->paginate($this->pagination);
        }
        $pdf = PDF::loadView('livewire.cliente.reporte-cliente',[$this->componentName, $this->pageTitle, 'clientes' => $data]);
        return $pdf->download('reporte.pdf');
    }
}
