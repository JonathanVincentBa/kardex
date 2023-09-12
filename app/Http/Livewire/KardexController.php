<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\ControlArchivo;
use App\Models\Kardex;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Kardexcontroller extends Component
{
    public $desde, $hasta, $cliente, $servicio, $fechaActual,
        $clientes, $servicios, $destinatario, $descripcion, $control_archivo_id, $kardexes;

    public function mount()
    {
        $fecha = Carbon::now();
        $this->fechaActual = $fecha->toDateTimeString();
        $this->clientes = Cliente::all();
        $this->servicios = collect();
    }

    public function render()
    {
        $fecha = Carbon::now();
        $fecha = $fecha->toDateString();
        $fecha = "2023-09-12";

        $this->kardexes = Kardex::join('control_archivos as ca', 'ca.id', '=', 'kardexes.control_archivo_id')
            ->join('tipo_servicios as t', 't.id', '=', 'ca.tipo_servicio_id')
            ->join('clientes as c', 'c.id', '=', 'ca.cliente_id')
            ->join('users as u', 'u.id', '=', 'kardexes.enviadoPor')
            ->select('kardexes.id', 'c.nombre as cliente', 't.codigo as tipo', 'ca.carpeta', 'kardexes.destinatario', 'kardexes.descripcion', 'u.name as enviadoPor')
            ->whereDate('kardexes.created_at', '=', $fecha)
            ->OrwhereDate('kardexes.updated_at', '=', $fecha)
            ->get();



        return view('livewire.kardex.component', [

            'kardexes' => $this->kardexes,
        ])
            ->extends('layouts.app')
            ->section('content');
    }

    public function updatedCliente($value)
    {


        $this->servicios = ControlArchivo::join('tipo_servicios', 'tipo_servicios.id', '=', 'control_archivos.tipo_servicio_id')
            ->select('control_archivos.id', 'tipo_servicios.codigo', 'control_archivos.carpeta')
            ->where('control_archivos.cliente_id', '=', $value)
            ->orderBy('tipo_servicios.codigo', 'asc')
            ->orderBy('carpeta', 'asc')
            ->get();
        $this->servicio = $this->servicios->first()->id ?? null;
    }

    public function updatedDesde()
    {
        $fecha = Carbon::today()->toDateString();

        if ($this->desde > $fecha) {
            $this->kardexes = Kardex::join('control_archivos as ca', 'ca.id', '=', 'kardexes.control_archivo_id')
                ->join('tipo_servicios as t', 't.id', '=', 'ca.tipo_servicio_id')
                ->join('clientes as c', 'c.id', '=', 'ca.cliente_id')
                ->join('users as u', 'u.id', '=', 'kardexes.enviadoPor')
                ->select('kardexes.id', 'c.nombre as cliente', 't.codigo as tipo', 'ca.carpeta', 'kardexes.destinatario', 'kardexes.descripcion', 'u.name as enviadoPor')
                ->whereDate('kardexes.created_at', '=', $fecha)
                ->OrwhereDate('kardexes.updated_at', '=', $fecha)
                ->get();
            $this->emit('errorFecha', 'La fecha seleccionada debe ser menor a la fecha actual');
        } else {
            $this->kardexes = Kardex::whereDate('kardexes.created_at', '=', $this->desde)
                ->OrwhereDate('kardexes.updated_at', '=', $this->desde)
                ->join('control_archivos as ca', 'ca.id', '=', 'kardexes.control_archivo_id')
                ->join('tipo_servicios as t', 't.id', '=', 'ca.tipo_servicio_id')
                ->join('clientes as c', 'c.id', '=', 'ca.cliente_id')
                ->join('users as u', 'u.id', '=', 'kardexes.enviadoPor')
                ->select('kardexes.id', 'c.nombre as cliente', 't.codigo as tipo', 'ca.carpeta', 'kardexes.destinatario', 'kardexes.descripcion', 'u.name as enviadoPor')
                ->get();
        }
    }
    public function updatedHasta()
    {
        $fecha = Carbon::now();
        $fecha = $fecha->toDateTimeString();
        if ($this->desde >= $this->hasta) {
            $this->kardexes = Kardex::whereDate('kardexes.created_at', '=', $this->desde)
                ->OrwhereDate('kardexes.updated_at', '=', $this->desde)
                ->join('control_archivos as ca', 'ca.id', '=', 'kardexes.control_archivo_id')
                ->join('tipo_servicios as t', 't.id', '=', 'ca.tipo_servicio_id')
                ->join('clientes as c', 'c.id', '=', 'ca.cliente_id')
                ->join('users as u', 'u.id', '=', 'kardexes.enviadoPor')
                ->select('kardexes.id', 'c.nombre as cliente', 't.codigo as tipo', 'ca.carpeta', 'kardexes.destinatario', 'kardexes.descripcion', 'u.name as enviadoPor')
                ->get();
            $this->hasta = "";
            $this->emit('errorFecha', 'Error fecha seleccionada es mayor a la fecha anterior');
        } elseif ($this->hasta > $fecha) {
            $this->kardexes = Kardex::whereDate('kardexes.created_at', '=', $this->desde)
            ->OrwhereDate('kardexes.updated_at', '=', $this->desde)
            ->join('control_archivos as ca', 'ca.id', '=', 'kardexes.control_archivo_id')
            ->join('tipo_servicios as t', 't.id', '=', 'ca.tipo_servicio_id')
            ->join('clientes as c', 'c.id', '=', 'ca.cliente_id')
            ->join('users as u', 'u.id', '=', 'kardexes.enviadoPor')
            ->select('kardexes.id', 'c.nombre as cliente', 't.codigo as tipo', 'ca.carpeta', 'kardexes.destinatario', 'kardexes.descripcion', 'u.name as enviadoPor')
            ->get();
            $this->hasta = "";
            $this->emit('errorFecha', 'Error fecha seleccionada es mayor a la fecha actual');
        } else {
            $this->kardexes = Kardex::whereBetween('kardexes.created_at', [$this->desde,$this->hasta])
                ->join('control_archivos as ca', 'ca.id', '=', 'kardexes.control_archivo_id')
                ->join('tipo_servicios as t', 't.id', '=', 'ca.tipo_servicio_id')
                ->join('clientes as c', 'c.id', '=', 'ca.cliente_id')
                ->join('users as u', 'u.id', '=', 'kardexes.enviadoPor')
                ->select('kardexes.id', 'c.nombre as cliente', 't.codigo as tipo', 'ca.carpeta', 'kardexes.destinatario', 'kardexes.descripcion', 'u.name as enviadoPor')
                ->get();
        }
    }


    public function saveKardex()
    {

        $kardex = Kardex::create([
            'control_archivo_id' => $this->servicio,
            'destinatario' => $this->destinatario,
            'descripcion' => $this->descripcion,
            'enviadoPor' => Auth::user()->id
        ]);
        $this->reset();
        $fecha = Carbon::now();
        $this->fechaActual = $fecha->toDateTimeString();
        $this->emit('kardex-added', 'Carta Registrada');
    }
}
