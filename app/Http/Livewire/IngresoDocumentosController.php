<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\IngresoDocumento;
use App\Models\Cliente;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;


class IngresoDocumentosController extends Component
{
    public $empresa, $destino, $asunto, $fechaActual, $desde, $hasta, $selectedRemitente,  $user_id, $remitentes, $ingresos;

    public function mount()
    {
        $fecha = Carbon::now();
        $this->fechaActual = $fecha->toDateTimeString();
        $this->remitentes = IngresoDocumento::whereBetween('created_at',['2023-8-1',Carbon::today()->toDateString()] )
                                            ->select('remitente')
                                            ->groupBy('remitente')
                                            ->get();
    }
    public function render()
    {
        $data = IngresoDocumento::whereDate('ingreso_documentos.created_at', '=', Carbon::today()->toDateString() )
                ->select('ingreso_documentos.id','u.name as user','ingreso_documentos.remitente','ingreso_documentos.remitente', 'ingreso_documentos.detalle', 'ingreso_documentos.destinatario', 'ingreso_documentos.created_at')
                ->join('users as u', 'u.id', '=', 'ingreso_documentos..user_id')
                ->get();  

        return view('livewire.ingresoDocumentos.component',
            [
                'ingresoDocumentos' => $data,
            ]
        )
        ->extends('layouts.app')
        ->section('content');
    }
    
    public function updateddesde()
    {
        $this->ingresos = IngresoDocumento::whereDate('ingreso_documentos.created_at', $this->desde )
                    ->select('ingreso_documentos.id','u.name as user','ingreso_documentos.remitente','ingreso_documentos.remitente', 'ingreso_documentos.detalle', 'ingreso_documentos.destinatario', 'ingreso_documentos.created_at')
                    ->join('users as u', 'u.id', '=', 'ingreso_documentos..user_id')
                    ->get();     
    }
    public function updatedhasta()
    {
        $this->ingresos = IngresoDocumento::whereBetween('ingreso_documentos.created_at', [$this->desde, $this->hasta] )
                    ->select('ingreso_documentos.id','u.name as user','ingreso_documentos.remitente','ingreso_documentos.remitente', 'ingreso_documentos.detalle', 'ingreso_documentos.destinatario', 'ingreso_documentos.created_at')
                    ->join('users as u', 'u.id', '=', 'ingreso_documentos..user_id')
                    ->get();  
    }
    
    public function updatedselectedRemitente()
    {
        if(strlen($this->desde))
        {
            $this->ingresos = IngresoDocumento::whereDate('ingreso_documentos.created_at', $this->desde )
                    ->where('ingreso_documentos.remitente', 'LIKE', '%'.$this->selectedRemitente. '%')
                    ->select('ingreso_documentos.id','u.name as user','ingreso_documentos.remitente','ingreso_documentos.remitente', 'ingreso_documentos.detalle', 'ingreso_documentos.destinatario', 'ingreso_documentos.created_at')
                    ->join('users as u', 'u.id', '=', 'ingreso_documentos..user_id')
                    ->get();  
        }
        if(strlen($this->hasta))
        {
            $this->ingresos = IngresoDocumento::whereBetween('ingreso_documentos.created_at', [$this->desde, $this->hasta] )
                    ->where('ingreso_documentos.remitente', 'LIKE', '%'.$this->selectedRemitente. '%')
                    ->select('ingreso_documentos.id','u.name as user','ingreso_documentos.remitente','ingreso_documentos.remitente', 'ingreso_documentos.detalle', 'ingreso_documentos.destinatario', 'ingreso_documentos.created_at')
                    ->join('users as u', 'u.id', '=', 'ingreso_documentos..user_id')
                    ->get();  
        }
        if(strlen($this->desde) <= 0)
        {
            $this->ingresos = IngresoDocumento::where('ingreso_documentos.remitente', 'LIKE', '%'.$this->selectedRemitente. '%')
                    ->select('ingreso_documentos.id','u.name as user','ingreso_documentos.remitente','ingreso_documentos.remitente', 'ingreso_documentos.detalle', 'ingreso_documentos.destinatario', 'ingreso_documentos.created_at')
                    ->join('users as u', 'u.id', '=', 'ingreso_documentos..user_id')
                    ->get();
        }
    }

    public function saveIngresoDocumentos()
    {
        $documetos = IngresoDocumento::create([
            'user_id' => Auth::user()->id,
            'remitente' => $this->empresa,
            'detalle' => $this->asunto,
            'destinatario' => $this->destino,
        ]);
        $this->resetUI();
    }

    public function resetUi(){
        $fecha = Carbon::now();
        $this->fechaActual = $fecha->toDateTimeString();
        $this->empresa = null;
        $this->asunto = null;
        $this->destino = null;

    }
        

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function Destroy(IngresoDocumento $ingresoDocumento)
    {
        $ingresoDocumento->delete();
        $this->resetUI();
        $this->emit('ingresoDocumento-deleted', 'Registro Eliminado');
    }
}