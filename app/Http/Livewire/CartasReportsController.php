<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\Kardex;
use App\Models\TipoServicio;
use Carbon\Carbon;
use Livewire\Component;

class CartasReportsController extends Component
{
    public $componentName, $data, $clienteId, $tipoId, $dateFrom, $dateTo;

    public function mount()
    {
        $this->componentName = 'Reporte de Cartas';
        $this->data = [];
        $this->tipoId = 0;
    }
    public function render()
    {
        $this->ReportByDate;
        $clientes = Cliente::orderBy('nombre', 'asc')->get();
        $tipos = TipoServicio::orderBy('codigo', 'asc')->get();

        return view('livewire.cartas-reports.component', ['clientes' => $clientes, 'tipos' => $tipos])
            ->extends('layouts.app')
            ->section('content');
    }


    public function reportByDate()
    {
        
    }

    public function updatedClienteId()
    {
        $from = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00';
        $to = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 23:59:59';
        if ($this->clienteId == 0 && $this->tipoId == 0) {
            $this->data = Kardex::join('control_archivos as ca', 'ca.id', '=', 'kardexes.control_archivo_id')
                ->join('tipo_servicios as t', 't.id', '=', 'ca.tipo_servicio_id')
                ->join('clientes as c', 'c.id', '=', 'ca.cliente_id')
                ->join('users as u', 'u.id', '=', 'kardexes.enviadoPor')
                ->select(
                    'c.nombre as cliente',
                    't.codigo as tipo',
                    'ca.carpeta',
                    'kardexes.destinatario',
                    'kardexes.descripcion',
                    'u.name as enviadoPor',
                    'kardexes.updated_at'
                )
                ->whereDate('kardexes.created_at', '=', $from)
                ->OrwhereDate('kardexes.updated_at', '=', $from)
                ->orderBy('kardexes.updated_at')
                ->get();
                /* dd($this->data); */
        } else {
            # code...
        }









        $cartas = Kardex::join('control_archivos as ca', 'ca.id', '=', 'kardexes.control_archivo_id')
            ->join('tipo_servicios as t', 't.id', '=', 'ca.tipo_servicio_id')
            ->join('clientes as c', 'c.id', '=', 'ca.cliente_id')
            ->join('users as u', 'u.id', '=', 'kardexes.enviadoPor')
            ->select(
                'c.nombre as cliente',
                't.codigo as tipo',
                'ca.carpeta',
                'kardexes.destinatario',
                'kardexes.descripcion',
                'u.name as enviadoPor',
                'kardexes.updated_at'
            )
            ->whereDate('kardexes.created_at', '=', $from)
            ->OrwhereDate('kardexes.updated_at', '=', $from)
            ->orderBy('kardexes.updated_at')
            ->get();


























        /* if ($this->reportType == 0) // clientes activos
        {
            $from = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 23:59:59';
        } else {
            $from = Carbon::parse($this->dateFrom)->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse($this->dateTo)->format('Y-m-d') . ' 23:59:59';
        }

        if ($this->reportType == 1 && ($this->dateFrom == '' || $this->dateTo == '')) {
            return;
        }

        if ($this->clienteId == 0) {
            $this->data = Kardex::whereBetween('created_at', [$from, $to])
                ->get();
        } else {
            $this->data = Kardex::whereBetween('created_at', [$from, $to])
                ->where('id', $this->clienteId)
                ->get();
        } */
    }
}
