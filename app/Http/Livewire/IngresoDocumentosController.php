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
    public $fechaActual, $fechaDesde = null, $fechaHasta = null,$clientes,$empresa,$destino,$asunto,$user_id;

    public function mount()
    {
        
        $this->clientes = IngresoDocumento::get();
        $fecha = Carbon::now();
        $this->fechaActual = $fecha->toDateTimeString();
    }
    public function render()
    {
        $today = Carbon::now();
        $today = $today->toDateString();
       $data = DB::table('ingreso_documentos as i')
                        ->where('i.created_at', 'like', '%'.$today.'%' )
                        ->select('i.id','u.name as user','i.remitente','i.remitente', 'i.detalle', 'i.destinatario', 'i.created_at')
                        ->join('users as u', 'u.id', '=', 'i.user_id')
                        ->get();
       
        return view('livewire.ingresoDocumentos.component',
            [
                'ingresoDocumentos' => $data,
            ]
        )
        ->extends('layouts.app')
        ->section('content');
    }

    public function saveIngresoDocumentos()
    {
        $documetos = IngresoDocumento::create([
            'user_id' => Auth::user()->id,
            'remitente' => $this->empresa,
            'detalle' => $this->asunto,
            'destinatario' => $this->destino,
        ]);
        $fecha = Carbon::now();
        $this->fechaActual = $fecha->toDateTimeString();
        $this->empresa = null;
        $this->asunto = null;
        $this->destino = null;
    }
}
