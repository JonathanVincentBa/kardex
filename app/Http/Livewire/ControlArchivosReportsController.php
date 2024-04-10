<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\ControlArchivo;
use App\Models\TipoServicio;
use Livewire\Component;

class ControlArchivosReportsController extends Component
{
    public $componentName, $data, $clienteId, $reportType, $carpetaId;
    public $opcionSeleccionada;

    public function mount()
    {
        $this->componentName = 'Reporte de Carpetas';
        $this->reportType = 0;
        $this->carpetaId = 0;
        $this->data = [];
    }

    public function render()
    {
        $clientes = Cliente::orderBy('nombre', 'asc')->get();
        $carpetas = TipoServicio::orderBy('codigo', 'asc')->get();
        $this->componentName = 'Reporte de Carpetas';
        return view('livewire.control-archivos-reports.component', ['clientes' => $clientes, 'carpetas' => $carpetas])
            ->extends('layouts.app')
            ->section('content');
    }

    public function updatedClienteId()
    {
        if ($this->clienteId == 0 && $this->reportType == 0) {

            $this->data = ControlArchivo::join('clientes as c', 'c.id', '=', 'control_archivos.cliente_id')
            ->join('tipo_servicios as t', 't.id', '=', 'control_archivos.tipo_servicio_id')
            ->join('users as u', 'u.id', '=', 'control_archivos.user_id')
            ->select('control_archivos.id', 'u.name as usuario', 'c.codigo as cod_cliente', 'c.nombre as cliente', 't.codigo as tipo', 'carpeta', 'asunto', 'control_archivos.created_at', 'control_archivos.deleted_at', 'control_archivos.caja_deleted')
            ->orderby('t.codigo')
            ->orderby('control_archivos.carpeta')
            ->withTrashed()
            ->get();
        } else if($this->clienteId <> 0 && $this->reportType == 0)
        {
            $this->data = ControlArchivo::join('clientes as c', 'c.id', '=', 'control_archivos.cliente_id')
            ->join('tipo_servicios as t', 't.id', '=', 'control_archivos.tipo_servicio_id')
            ->join('users as u', 'u.id', '=', 'control_archivos.user_id')
            ->select('control_archivos.id', 'u.name as usuario', 'c.codigo as cod_cliente', 'c.nombre as cliente', 't.codigo as tipo', 'carpeta', 'asunto', 'control_archivos.created_at', 'control_archivos.deleted_at', 'control_archivos.caja_deleted')
            ->where('control_archivos.cliente_id', '=', $this->clienteId)
            ->orderby('t.codigo')
            ->orderby('control_archivos.carpeta')
            ->withTrashed()
            ->get();
        }
    }

    public function updatedReportType()
    {
        if ($this->clienteId == 0 && $this->reportType == 0) {
            $this->data = ControlArchivo::join('clientes as c', 'c.id', '=', 'control_archivos.cliente_id')
            ->join('tipo_servicios as t', 't.id', '=', 'control_archivos.tipo_servicio_id')
            ->join('users as u', 'u.id', '=', 'control_archivos.user_id')
            ->select('control_archivos.id', 'u.name as usuario', 'c.codigo as cod_cliente', 'c.nombre as cliente', 't.codigo as tipo', 'carpeta', 'asunto', 'control_archivos.created_at', 'control_archivos.deleted_at', 'control_archivos.caja_deleted')
            /* ->where('control_archivos.cliente_id', '=', $this->clienteId) */
            ->orderby('t.codigo')
            ->orderby('control_archivos.carpeta')
            ->withTrashed()
            ->get();
        }  else if($this->clienteId == 0 && $this->reportType == 1)
        {
            $this->data = ControlArchivo::join('clientes as c', 'c.id', '=', 'control_archivos.cliente_id')
            ->join('tipo_servicios as t', 't.id', '=', 'control_archivos.tipo_servicio_id')
            ->join('users as u', 'u.id', '=', 'control_archivos.user_id')
            ->select('control_archivos.id', 'u.name as usuario', 'c.codigo as cod_cliente', 'c.nombre as cliente', 't.codigo as tipo', 'carpeta', 'asunto', 'control_archivos.created_at', 'control_archivos.deleted_at', 'control_archivos.caja_deleted')
            /* ->where('control_archivos.cliente_id', '=', $this->clienteId) */
            ->orderby('t.codigo')
            ->orderby('control_archivos.carpeta')
            ->get();
        }else if($this->clienteId == 0 && $this->reportType == 2)
        {
            $this->data = ControlArchivo::join('clientes as c', 'c.id', '=', 'control_archivos.cliente_id')
            ->join('tipo_servicios as t', 't.id', '=', 'control_archivos.tipo_servicio_id')
            ->join('users as u', 'u.id', '=', 'control_archivos.user_id')
            ->select('control_archivos.id', 'u.name as usuario', 'c.codigo as cod_cliente', 'c.nombre as cliente', 't.codigo as tipo', 'carpeta', 'asunto', 'control_archivos.created_at', 'control_archivos.deleted_at', 'control_archivos.caja_deleted')
            /* ->where('control_archivos.cliente_id', '=', $this->clienteId) */
            ->orderby('t.codigo')
            ->orderby('control_archivos.carpeta')
            ->onlyTrashed()
            ->get();
        }else if($this->clienteId <> 0 && $this->reportType == 0)
        {
            $this->data = ControlArchivo::join('clientes as c', 'c.id', '=', 'control_archivos.cliente_id')
            ->join('tipo_servicios as t', 't.id', '=', 'control_archivos.tipo_servicio_id')
            ->join('users as u', 'u.id', '=', 'control_archivos.user_id')
            ->select('control_archivos.id', 'u.name as usuario', 'c.codigo as cod_cliente', 'c.nombre as cliente', 't.codigo as tipo', 'carpeta', 'asunto', 'control_archivos.created_at', 'control_archivos.deleted_at', 'control_archivos.caja_deleted')
            ->where('control_archivos.cliente_id', '=', $this->clienteId)
            ->orderby('t.codigo')
            ->orderby('control_archivos.carpeta')
            ->withTrashed()
            ->get();
        }else if($this->clienteId <> 0 && $this->reportType == 1)
        {
            $this->data = ControlArchivo::join('clientes as c', 'c.id', '=', 'control_archivos.cliente_id')
            ->join('tipo_servicios as t', 't.id', '=', 'control_archivos.tipo_servicio_id')
            ->join('users as u', 'u.id', '=', 'control_archivos.user_id')
            ->select('control_archivos.id', 'u.name as usuario', 'c.codigo as cod_cliente', 'c.nombre as cliente', 't.codigo as tipo', 'carpeta', 'asunto', 'control_archivos.created_at', 'control_archivos.deleted_at', 'control_archivos.caja_deleted')
            ->where('control_archivos.cliente_id', '=', $this->clienteId)
            ->orderby('t.codigo')
            ->orderby('control_archivos.carpeta')
            ->get();
        }else if($this->clienteId <> 0 && $this->reportType == 2)
        {
            $this->data = ControlArchivo::join('clientes as c', 'c.id', '=', 'control_archivos.cliente_id')
            ->join('tipo_servicios as t', 't.id', '=', 'control_archivos.tipo_servicio_id')
            ->join('users as u', 'u.id', '=', 'control_archivos.user_id')
            ->select('control_archivos.id', 'u.name as usuario', 'c.codigo as cod_cliente', 'c.nombre as cliente', 't.codigo as tipo', 'carpeta', 'asunto', 'control_archivos.created_at', 'control_archivos.deleted_at', 'control_archivos.caja_deleted')
            ->where('control_archivos.cliente_id', '=', $this->clienteId)
            ->orderby('t.codigo')
            ->orderby('control_archivos.carpeta')
            ->onlyTrashed()
            ->get();
        }
    }

    public function updatedCarpetaId()
    {
        if ($this->clienteId == 0 && $this->reportType == 0 && $this->carpetaId <> 0) {
            $this->data = ControlArchivo::join('clientes as c', 'c.id', '=', 'control_archivos.cliente_id')
            ->join('tipo_servicios as t', 't.id', '=', 'control_archivos.tipo_servicio_id')
            ->join('users as u', 'u.id', '=', 'control_archivos.user_id')
            ->select('control_archivos.id', 'u.name as usuario', 'c.codigo as cod_cliente', 'c.nombre as cliente', 't.codigo as tipo', 'carpeta', 'asunto', 'control_archivos.created_at', 'control_archivos.deleted_at', 'control_archivos.caja_deleted')
            ->where('control_archivos.tipo_servicio_id', '=', $this->carpetaId)
            ->orderby('t.codigo')
            ->orderby('control_archivos.carpeta')
            ->withTrashed()
            ->get();
        }  else if($this->clienteId == 0 && $this->reportType == 1 && $this->carpetaId <> 0)
        {
            $this->data = ControlArchivo::join('clientes as c', 'c.id', '=', 'control_archivos.cliente_id')
            ->join('tipo_servicios as t', 't.id', '=', 'control_archivos.tipo_servicio_id')
            ->join('users as u', 'u.id', '=', 'control_archivos.user_id')
            ->select('control_archivos.id', 'u.name as usuario', 'c.codigo as cod_cliente', 'c.nombre as cliente', 't.codigo as tipo', 'carpeta', 'asunto', 'control_archivos.created_at', 'control_archivos.deleted_at', 'control_archivos.caja_deleted')
            ->where('control_archivos.tipo_servicio_id', '=', $this->carpetaId)
            ->orderby('t.codigo')
            ->orderby('control_archivos.carpeta')
            ->get();
        }else if($this->clienteId == 0 && $this->reportType == 2 && $this->carpetaId <> 0)
        {
            $this->data = ControlArchivo::join('clientes as c', 'c.id', '=', 'control_archivos.cliente_id')
            ->join('tipo_servicios as t', 't.id', '=', 'control_archivos.tipo_servicio_id')
            ->join('users as u', 'u.id', '=', 'control_archivos.user_id')
            ->select('control_archivos.id', 'u.name as usuario', 'c.codigo as cod_cliente', 'c.nombre as cliente', 't.codigo as tipo', 'carpeta', 'asunto', 'control_archivos.created_at', 'control_archivos.deleted_at', 'control_archivos.caja_deleted')
            ->where('control_archivos.tipo_servicio_id', '=', $this->carpetaId)
            ->orderby('t.codigo')
            ->orderby('control_archivos.carpeta')
            ->onlyTrashed()
            ->get();
        }else if($this->clienteId <> 0 && $this->reportType == 0 && $this->carpetaId <> 0)
        {
            $this->data = ControlArchivo::join('clientes as c', 'c.id', '=', 'control_archivos.cliente_id')
            ->join('tipo_servicios as t', 't.id', '=', 'control_archivos.tipo_servicio_id')
            ->join('users as u', 'u.id', '=', 'control_archivos.user_id')
            ->select('control_archivos.id', 'u.name as usuario', 'c.codigo as cod_cliente', 'c.nombre as cliente', 't.codigo as tipo', 'carpeta', 'asunto', 'control_archivos.created_at', 'control_archivos.deleted_at', 'control_archivos.caja_deleted')
            ->where('control_archivos.cliente_id', '=', $this->clienteId)
            ->where('control_archivos.tipo_servicio_id', '=', $this->carpetaId)
            ->orderby('t.codigo')
            ->orderby('control_archivos.carpeta')
            ->withTrashed()
            ->get();
        }else if($this->clienteId <> 0 && $this->reportType == 1 && $this->carpetaId <> 0)
        {
            $this->data = ControlArchivo::join('clientes as c', 'c.id', '=', 'control_archivos.cliente_id')
            ->join('tipo_servicios as t', 't.id', '=', 'control_archivos.tipo_servicio_id')
            ->join('users as u', 'u.id', '=', 'control_archivos.user_id')
            ->select('control_archivos.id', 'u.name as usuario', 'c.codigo as cod_cliente', 'c.nombre as cliente', 't.codigo as tipo', 'carpeta', 'asunto', 'control_archivos.created_at', 'control_archivos.deleted_at', 'control_archivos.caja_deleted')
            ->where('control_archivos.cliente_id', '=', $this->clienteId)
            ->where('control_archivos.tipo_servicio_id', '=', $this->carpetaId)
            ->orderby('t.codigo')
            ->orderby('control_archivos.carpeta')
            ->get();
        }else if($this->clienteId <> 0 && $this->reportType == 2 && $this->carpetaId <> 0)
        {
            $this->data = ControlArchivo::join('clientes as c', 'c.id', '=', 'control_archivos.cliente_id')
            ->join('tipo_servicios as t', 't.id', '=', 'control_archivos.tipo_servicio_id')
            ->join('users as u', 'u.id', '=', 'control_archivos.user_id')
            ->select('control_archivos.id', 'u.name as usuario', 'c.codigo as cod_cliente', 'c.nombre as cliente', 't.codigo as tipo', 'carpeta', 'asunto', 'control_archivos.created_at', 'control_archivos.deleted_at', 'control_archivos.caja_deleted')
            ->where('control_archivos.cliente_id', '=', $this->clienteId)
            ->where('control_archivos.tipo_servicio_id', '=', $this->carpetaId)
            ->orderby('t.codigo')
            ->orderby('control_archivos.carpeta')
            ->onlyTrashed()
            ->get();
        }
    }
}
