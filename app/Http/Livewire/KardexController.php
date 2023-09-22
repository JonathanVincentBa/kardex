<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\ControlArchivo;
use App\Models\Kardex;
use App\Models\TipoServicio;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use PhpOffice\PhpWord\TemplateProcessor;

class KardexController extends Component
{
    public $componetName, $pageTitle, $clientes= [], $cliente, $servicios= [], $servicio, $enviadoPor, $kardexes= [], $destinatario, $descripcion,
        $fechaActual, $desde, $hasta, $selected_id, $selectedTipo, $carpeta, $control_id;

    protected $listeners = ['changeData'];

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componetName = 'Cartas';
        $fecha = Carbon::now();
        $this->fechaActual = $fecha->toDateTimeString();
        $this->clientes = Cliente::all();
        $this->servicios = collect();
    }

    public function render()
    {
        $fecha = Carbon::now();
        $this->fechaActual = $fecha->toDateString();
        $data = Kardex::join('control_archivos as ca', 'ca.id', '=', 'kardexes.control_archivo_id')
            ->join('tipo_servicios as t', 't.id', '=', 'ca.tipo_servicio_id')
            ->join('clientes as c', 'c.id', '=', 'ca.cliente_id')
            ->join('users as u', 'u.id', '=', 'kardexes.enviadoPor')
            ->select('kardexes.id', 'c.nombre as cliente', 't.codigo as tipo', 'ca.carpeta', 'kardexes.destinatario', 'kardexes.descripcion', 'u.name as enviadoPor')
            ->whereDate('kardexes.created_at', '=', $this->fechaActual)
            ->OrwhereDate('kardexes.updated_at', '=', $this->fechaActual)
            ->get();

        return view('livewire.kardex.component', [
            'cartas' => $data
        ])
            ->extends('layouts.app')
            ->section('content');
    }

    public function updatedCliente($value)
    {
        $this->servicios = ControlArchivo::join('tipo_servicios', 'tipo_servicios.id', '=', 'control_archivos.tipo_servicio_id')
            ->select('control_archivos.id', 'tipo_servicios.codigo as codigo', 'control_archivos.carpeta', 'tipo_servicios.nombre as nombre')
            ->where('control_archivos.cliente_id', '=', $value)
            ->orderBy('tipo_servicios.codigo', 'asc')
            ->orderBy('carpeta', 'asc')
            ->get();
    }

    public function updatedDesde($value)
    {
        if ($this->fechaActual < $this->desde) {
            $this->emit('errorFecha', 'La fecha seleccionada debe ser menor a la fecha actual');
            $this->desde = null;
        } else {
            $this->kardexes = Kardex::join('control_archivos as ca', 'ca.id', '=', 'kardexes.control_archivo_id')
                ->join('tipo_servicios as t', 't.id', '=', 'ca.tipo_servicio_id')
                ->join('clientes as c', 'c.id', '=', 'ca.cliente_id')
                ->join('users as u', 'u.id', '=', 'kardexes.enviadoPor')
                ->select('kardexes.id', 'c.nombre as cliente', 't.codigo as tipo', 'ca.carpeta', 'kardexes.destinatario', 'kardexes.descripcion', 'u.name as enviadoPor')
                ->whereDate('kardexes.created_at', '=', $value)
                ->OrwhereDate('kardexes.updated_at', '=', $value)
                ->get();
        }
    }

    public function updatedHasta()
    {
        if (empty($this->desde)) {
            $this->kardexes = Kardex::whereDate('kardexes.created_at', '=', $this->desde)
                ->OrwhereDate('kardexes.updated_at', '=', $this->desde)
                ->join('control_archivos as ca', 'ca.id', '=', 'kardexes.control_archivo_id')
                ->join('tipo_servicios as t', 't.id', '=', 'ca.tipo_servicio_id')
                ->join('clientes as c', 'c.id', '=', 'ca.cliente_id')
                ->join('users as u', 'u.id', '=', 'kardexes.enviadoPor')
                ->select('kardexes.id', 'c.nombre as cliente', 't.codigo as tipo', 'ca.carpeta', 'kardexes.destinatario', 'kardexes.descripcion', 'u.name as enviadoPor')
                ->get();
            $this->emit('errorFecha', 'Debes seleccionar primero una fecha de Inicio');
            $this->hasta = null;
        } elseif ($this->desde >= $this->hasta) {
            $this->kardexes = Kardex::whereDate('kardexes.created_at', '=', $this->desde)
                ->OrwhereDate('kardexes.updated_at', '=', $this->desde)
                ->join('control_archivos as ca', 'ca.id', '=', 'kardexes.control_archivo_id')
                ->join('tipo_servicios as t', 't.id', '=', 'ca.tipo_servicio_id')
                ->join('clientes as c', 'c.id', '=', 'ca.cliente_id')
                ->join('users as u', 'u.id', '=', 'kardexes.enviadoPor')
                ->select('kardexes.id', 'c.nombre as cliente', 't.codigo as tipo', 'ca.carpeta', 'kardexes.destinatario', 'kardexes.descripcion', 'u.name as enviadoPor')
                ->get();
            $this->hasta = null;
            $this->emit('errorFecha', 'Error fecha seleccionada es mayor a la fecha anterior');
        } elseif ($this->hasta > $this->fechaActual) {
            $this->kardexes = Kardex::whereDate('kardexes.created_at', '=', $this->desde)
                ->OrwhereDate('kardexes.updated_at', '=', $this->desde)
                ->join('control_archivos as ca', 'ca.id', '=', 'kardexes.control_archivo_id')
                ->join('tipo_servicios as t', 't.id', '=', 'ca.tipo_servicio_id')
                ->join('clientes as c', 'c.id', '=', 'ca.cliente_id')
                ->join('users as u', 'u.id', '=', 'kardexes.enviadoPor')
                ->select('kardexes.id', 'c.nombre as cliente', 't.codigo as tipo', 'ca.carpeta', 'kardexes.destinatario', 'kardexes.descripcion', 'u.name as enviadoPor')
                ->get();
            $this->hasta = null;
            $this->emit('errorFecha', 'Error fecha seleccionada es mayor a la fecha actual');
        } else {
            $this->kardexes = Kardex::whereBetween('kardexes.created_at', [$this->desde, $this->hasta])
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
        $this->clientes = Cliente::all();
        $this->servicios = collect();
    }

    public function Edit($id)
    {
        $this->reset();
        $record = Kardex::find($id);
        $this->selected_id = $record->id;
        $this->control_id = $record->control_archivo_id;
        $control = ControlArchivo::find($record->control_archivo_id);
        $this->cliente = $control->cliente_id;
        $this->servicio = $control->tipo_servicio_id;
        $this->carpeta = $control->carpeta;
        $this->destinatario = $record->destinatario;
        $this->descripcion = $record->descripcion;
        $this->enviadoPor = $record->enviadoPor;
        $this->emit('updateSelect2');
    }

    public function actualizarKardex()
    {
        $kardex = Kardex::find($this->selected_id);
        $kardex->update([
            'control_archivo_id' => $this->control_id,
            'destinatario' => $this->destinatario,
            'descripcion' => $this->descripcion,
            'enviadoPor' => $this->enviadoPor,
        ]);
        $this->reset();
        $this->pageTitle = 'Listado';
        $this->componetName = 'Cartas';
        $fecha = Carbon::now();
        $this->fechaActual = $fecha->toDateTimeString();
        $this->clientes = Cliente::all();
        $this->servicios = collect();
        $this->emit('kardex-added', 'Carta Actualizada');
    }

    public function exportarWord($id)
    {
        $record = Kardex::find($id);
        $fecha = Carbon::parse($record->created_at);
        $afecha = $fecha->year;
        $control = ControlArchivo::find($record->control_archivo_id);
        $client = Cliente::find($control->cliente_id);
        $tipo = TipoServicio::find($control->tipo_servicio_id);
        
        $templateProcessor = new TemplateProcessor('word-template/carta.docx');
        $templateProcessor->setValue('id', $record->id);
        $templateProcessor->setValue('anio', $afecha);
        $templateProcessor->setValue('codigoCliente', $client->codigo);
        $templateProcessor->setValue('codigoTipo', $tipo->codigo);
        $templateProcessor->setValue('carpeta', $control->carpeta);
        $templateProcessor->setValue('nombreCliente', $client->nombre);
        $templateProcessor->setValue('nomDestinatario', $record->destinatario);
        $templateProcessor->setValue('detalle', $record->descripcion);
        $templateProcessor->saveAs($afecha . '.docx');
        return response()->download($afecha . '.docx')->deleteFileAfterSend(true);
    }
}
