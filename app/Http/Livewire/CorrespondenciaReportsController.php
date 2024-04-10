<?php

namespace App\Http\Livewire;

use App\Models\IngresoDocumento;
use Carbon\Carbon;
use Livewire\Component;

class CorrespondenciaReportsController extends Component
{
    public $componentName, $data, $clienteId, $reportType, $dateFrom, $dateTo;

    public function mount()
    {
        $this->componentName = "Listado de Correspondencia";
        $this->data = [];
    }
    public function render()
    {
        $clientes = IngresoDocumento::whereBetween('created_at', ['2023-8-1', Carbon::today()->toDateString()])
        ->select('remitente')
        ->groupBy('remitente')
        ->orderBy('remitente','asc')
        ->get();
        return view('livewire.correspondencia-reports.component', ['clientes' => $clientes])
        ->extends('layouts.app')
        ->section('content');
    }

    public function updatedClienteId()
    {
        if ($this->clienteId == 0) {
            $this->data = IngresoDocumento::select('u.name as user', 'ingreso_documentos.remitente', 'ingreso_documentos.remitente', 'ingreso_documentos.detalle', 'ingreso_documentos.destinatario', 'ingreso_documentos.created_at')
            ->join('users as u', 'u.id', '=', 'ingreso_documentos..user_id')
            ->orderBy('ingreso_documentos.created_at')
            ->get();
        } else {
            $this->data = IngresoDocumento::where('ingreso_documentos.remitente','=', $this->clienteId)
            ->select('u.name as user', 'ingreso_documentos.remitente', 'ingreso_documentos.remitente', 'ingreso_documentos.detalle', 'ingreso_documentos.destinatario', 'ingreso_documentos.created_at')
            ->join('users as u', 'u.id', '=', 'ingreso_documentos..user_id')
            ->orderBy('ingreso_documentos.created_at')
            ->get();
        }
        
    }
}
