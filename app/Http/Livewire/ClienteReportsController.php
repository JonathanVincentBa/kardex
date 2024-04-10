<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Livewire\Component;

class ClienteReportsController extends Component
{

    public $componentName, $data, $reportType;

    public function mount()
    {
        $this->componentName = 'Reporte de Clientes';
        $this->data =[];
    }
    public function render()
    {
        return view('livewire.cliente-reports.component',[
            'clientes' => Cliente::orderBy('nombre', 'asc')->get()
        ]) 
        ->extends('layouts.app')
        ->section('content');
    }

    public function updatedReportType()
    {
        if ($this->reportType == 0) {
            $this->data = Cliente::withTrashed()->get();
        } else  if($this->reportType == 1){
            $this->data = Cliente::all();
        }else
        {
            $this->data = Cliente::onlyTrashed()->get();
        }

    }
}
