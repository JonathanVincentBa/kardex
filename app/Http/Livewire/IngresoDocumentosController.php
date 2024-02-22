<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\IngresoDocumento;
use App\Models\Cliente;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;


class IngresoDocumentosController extends Component
{
    public $select_id, $user, $remitente, $destinatario, $detalle, $fechaActual, $desde, $hasta, $selectedRemitente,  $user_id, $remitentes, $ingresos,
        $ingresoDocumentos, $componetName;


    public function mount()
    {
        $this->componetName = 'Ingreso de Documentos';
        $fecha = Carbon::now();
        $this->fechaActual = $fecha->toDateTimeString();
        $this->remitentes = IngresoDocumento::whereBetween('created_at', ['2023-8-1', Carbon::today()->toDateString()])
            ->select('remitente')
            ->groupBy('remitente')
            ->get();
        $this->user = Auth::user()->name;
    }
    public function render()
    {
        $this->ingresoDocumentos = IngresoDocumento::whereDate('ingreso_documentos.created_at', '=', Carbon::today()->toDateString())
            ->select('ingreso_documentos.id', 'u.name as user', 'ingreso_documentos.remitente', 'ingreso_documentos.remitente', 'ingreso_documentos.detalle', 'ingreso_documentos.destinatario', 'ingreso_documentos.created_at')
            ->join('users as u', 'u.id', '=', 'ingreso_documentos..user_id')
            ->get();

        return view(
            'livewire.ingresoDocumentos.component',
            [
                'ingresoDocumentos' => $this->ingresoDocumentos,
            ]
        )
            ->extends('layouts.app')
            ->section('content');
    }

    public function updatedDesde()
    {
        $fecha = Carbon::now();
        $fecha = $fecha->toDateTimeString();

        if ($this->desde > $fecha) {
            $this->ingresos = IngresoDocumento::whereDate('ingreso_documentos.created_at', '=', Carbon::today()->toDateString())
                ->select('ingreso_documentos.id', 'u.name as user', 'ingreso_documentos.remitente', 'ingreso_documentos.remitente', 'ingreso_documentos.detalle', 'ingreso_documentos.destinatario', 'ingreso_documentos.created_at')
                ->join('users as u', 'u.id', '=', 'ingreso_documentos..user_id')
                ->get();
            $this->emit('errorFecha', 'Error fecha seleccionada es mayor a la fecha actual');
        } else {
            $this->ingresos = IngresoDocumento::whereDate('ingreso_documentos.created_at', $this->desde)
                ->select('ingreso_documentos.id', 'u.name as user', 'ingreso_documentos.remitente', 'ingreso_documentos.remitente', 'ingreso_documentos.detalle', 'ingreso_documentos.destinatario', 'ingreso_documentos.created_at')
                ->join('users as u', 'u.id', '=', 'ingreso_documentos..user_id')
                ->get();
        }
    }
    public function updatedHasta()
    {
        $fecha = Carbon::now();
        $fecha = $fecha->toDateTimeString();
        if ($this->desde >= $this->hasta) {
            $this->ingresos = IngresoDocumento::whereDate('ingreso_documentos.created_at', $this->desde)
                ->select('ingreso_documentos.id', 'u.name as user', 'ingreso_documentos.remitente', 'ingreso_documentos.remitente', 'ingreso_documentos.detalle', 'ingreso_documentos.destinatario', 'ingreso_documentos.created_at')
                ->join('users as u', 'u.id', '=', 'ingreso_documentos..user_id')
                ->get();
            $this->hasta = "";
            $this->emit('errorFecha', 'Error fecha seleccionada es mayor a la fecha anterior');
        } elseif ($this->hasta > $fecha) {
            $this->ingresos = IngresoDocumento::whereDate('ingreso_documentos.created_at', $this->desde)
                ->select('ingreso_documentos.id', 'u.name as user', 'ingreso_documentos.remitente', 'ingreso_documentos.remitente', 'ingreso_documentos.detalle', 'ingreso_documentos.destinatario', 'ingreso_documentos.created_at')
                ->join('users as u', 'u.id', '=', 'ingreso_documentos..user_id')
                ->get();
            $this->hasta = "";
            $this->emit('errorFecha', 'Error fecha seleccionada es mayor a la fecha actual');
        } else {
            $this->ingresos = IngresoDocumento::whereBetween('ingreso_documentos.created_at', [$this->desde, $this->hasta])
                ->select('ingreso_documentos.id', 'u.name as user', 'ingreso_documentos.remitente', 'ingreso_documentos.remitente', 'ingreso_documentos.detalle', 'ingreso_documentos.destinatario', 'ingreso_documentos.created_at')
                ->join('users as u', 'u.id', '=', 'ingreso_documentos..user_id')
                ->get();
        }

        $this->remitentes = [];
        $this->selectedRemitente = "";
        $this->remitentes = IngresoDocumento::whereBetween('created_at', ['2023-8-1', Carbon::today()->toDateString()])
            ->select('remitente')
            ->groupBy('remitente')
            ->get();
    }

    public function updatedselectedRemitente()
    {
        if (strlen($this->desde)) {
            $this->ingresos = IngresoDocumento::whereDate('ingreso_documentos.created_at', $this->desde)
                ->where('ingreso_documentos.remitente', 'LIKE', '%' . $this->selectedRemitente . '%')
                ->select('ingreso_documentos.id', 'u.name as user', 'ingreso_documentos.remitente', 'ingreso_documentos.remitente', 'ingreso_documentos.detalle', 'ingreso_documentos.destinatario', 'ingreso_documentos.created_at')
                ->join('users as u', 'u.id', '=', 'ingreso_documentos..user_id')
                ->get();
        }
        if (strlen($this->hasta)) {
            $this->ingresos = IngresoDocumento::whereBetween('ingreso_documentos.created_at', [$this->desde, $this->hasta])
                ->where('ingreso_documentos.remitente', 'LIKE', '%' . $this->selectedRemitente . '%')
                ->select('ingreso_documentos.id', 'u.name as user', 'ingreso_documentos.remitente', 'ingreso_documentos.remitente', 'ingreso_documentos.detalle', 'ingreso_documentos.destinatario', 'ingreso_documentos.created_at')
                ->join('users as u', 'u.id', '=', 'ingreso_documentos..user_id')
                ->get();
        }
        if (strlen($this->desde) == 0) {

            $this->ingresos = IngresoDocumento::where('ingreso_documentos.remitente', 'LIKE', '%' . $this->selectedRemitente . '%')
                ->select('ingreso_documentos.id', 'u.name as user', 'ingreso_documentos.remitente', 'ingreso_documentos.remitente', 'ingreso_documentos.detalle', 'ingreso_documentos.destinatario', 'ingreso_documentos.created_at')
                ->join('users as u', 'u.id', '=', 'ingreso_documentos..user_id')
                ->get();
        }
    }

    public function saveIngresoDocumentos()
    {
        $rules = [
            'remitente' => 'required',
            'destinatario' => 'required',
            'detalle' => 'required',
        ];

        $messages = [

            'remitente' => 'Remitente es requerido',
            'destinatario.required' => 'Destinatario es requerido',
            'detalle.required' => 'La Descripcion no puede estar vacia'
        ];


        $this->validate($rules, $messages);
        $documetos = IngresoDocumento::create([
            'user_id' => Auth::user()->id,
            'remitente' => $this->remitente,
            'detalle' => $this->detalle,
            'destinatario' => $this->destinatario,
        ]);
        $this->resetExcept('remitentes');
        $fecha = Carbon::now();
        $this->fechaActual = $fecha->toDateTimeString();
        $this->user = Auth::user()->name;
        $this->emit('ingreso-added', 'Cliente Registrado');
    }

    public function Edit($id)
    {
        $record = IngresoDocumento::find($id);
        $this->select_id = $record->id;
        $this->user_id = $record->user_id;
        $user = User::where('id', '=', $this->user_id)->select('name')->first();
        $this->user = $user->name;
        $this->remitente = $record->remitente;
        $this->detalle = $record->detalle;
        $this->destinatario = $record->destinatario;
    }


    public function actualizarIngresoDocumentos()
    {
        if (is_null($this->remitente)) {
            $this->emit('sale-error', 'NO PUEDE ESTAR VACIO EL CAMPO');
            return;
        }
        if (is_null($this->detalle)) {
            $this->emit('sale-error', 'NO PUEDE ESTAR VACIO EL CAMPO');
            return;
        }
        if (is_null($this->destinatario)) {
            $this->emit('sale-error', 'NO PUEDE ESTAR VACIO EL CAMPO');
            return;
        }
        $ingreso = IngresoDocumento::find($this->select_id);
        $ingreso->update([
            'user_id' => $this->user_id,
            'remitente' => $this->remitente,
            'detalle' => $this->detalle,
            'destinatario' => $this->destinatario,
        ]);
        $this->resetExcept('remitentes');
        $fecha = Carbon::now();
        $this->fechaActual = $fecha->toDateTimeString();
        $this->user = Auth::user()->name;
        $this->emit('ingreso-updated', 'Cliente Registrado');
    }

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function Destroy(IngresoDocumento $ingresoDocumento)
    {
        $ingresoDocumento->delete();
        $this->reset();
        $this->emit('ingresoDocumento-deleted', 'Registro Eliminado');
    }
}
