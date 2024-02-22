<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\ControlArchivo;
use App\Models\Kardex;
use App\Models\Servicio;
use App\Models\TipoServicio;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use PhpOffice\PhpWord\TemplateProcessor;

class KardexController extends Component
{
    public $componetName, $pageTitle, $clientes = [], $clienteId = null, $servicios = [], $servicioId = null, $enviadoPor, $destinatario, $descripcion, $fechaActual, $desde, $hasta, $selected_id, $carpeta, $control_id,
        $tipoCodigo, $tipoNombre, $clienteNombre, $enviadoX, $fechaEnvio, $date, $kardexes;

    protected $listeners = ['changeData'];

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componetName = 'Cartas';
        $fecha = Carbon::now();
        $this->fechaActual = $fecha->toDateTimeString();
        $this->clientes = Cliente::all();
        $this->servicios = collect();
        $fecha = Carbon::now();
        $this->fechaActual = $fecha->toDateString();
    }

    public function render()
    {

        $data = Kardex::join('control_archivos as ca', 'ca.id', '=', 'kardexes.control_archivo_id')
            ->join('tipo_servicios as t', 't.id', '=', 'ca.tipo_servicio_id')
            ->join('clientes as c', 'c.id', '=', 'ca.cliente_id')
            ->join('users as u', 'u.id', '=', 'kardexes.enviadoPor')
            ->select('kardexes.id', 'c.nombre as cliente', 't.codigo as tipo', 'ca.carpeta', 'kardexes.destinatario', 'kardexes.descripcion', 'u.name as enviadoPor',
            'kardexes.updated_at')
            ->whereDate('kardexes.created_at', '=', $this->fechaActual)
            ->OrwhereDate('kardexes.updated_at', '=', $this->fechaActual)
            ->orderBy('kardexes.updated_at')
            ->get();
        return view('livewire.kardex.component', ['cartas' => $data])
            ->extends('layouts.app')
            ->section('content');
    }

    public function updatedDesde()
    {
        if ($this->fechaActual < $this->desde) {
            $this->emit('errorFecha', 'La fecha seleccionada debe ser menor a la fecha actual');
            $this->desde = null;
        }
        if ($this->fechaActual > $this->desde) {
            $this->kardexes = Kardex::join('control_archivos as ca', 'ca.id', '=', 'kardexes.control_archivo_id')
                ->join('tipo_servicios as t', 't.id', '=', 'ca.tipo_servicio_id')
                ->join('clientes as c', 'c.id', '=', 'ca.cliente_id')
                ->join('users as u', 'u.id', '=', 'kardexes.enviadoPor')
                ->select('kardexes.id', 'c.nombre as cliente', 't.codigo as tipo', 'ca.carpeta', 'kardexes.destinatario', 'kardexes.descripcion', 'u.name as enviadoPor','kardexes.updated_at')
                ->whereDate('kardexes.created_at', '=', $this->desde)
                ->OrwhereDate('kardexes.updated_at', '=', $this->desde)
                ->orderBy('kardexes.updated_at')
                ->get();
        }
    }

    public function updatedHasta()
    {
        if (!empty($this->hasta) && $this->desde >= $this->hasta) {
            $this->hasta = null;
            $this->emit('errorFecha', 'Error fecha seleccionada es mayor a la fecha anterior');
        }
        if ($this->hasta > $this->fechaActual) {
            $this->hasta = null;
            $this->emit('errorFecha', 'Error fecha seleccionada es mayor a la fecha actual');
        }
        if ($this->hasta > $this->desde && $this->hasta <= $this->fechaActual) {
            //$this->hasta = $this->hasta + 1;
            $this->kardexes = Kardex::whereBetween('kardexes.created_at', [$this->desde, $this->hasta])
                ->join('control_archivos as ca', 'ca.id', '=', 'kardexes.control_archivo_id')
                ->join('tipo_servicios as t', 't.id', '=', 'ca.tipo_servicio_id')
                ->join('clientes as c', 'c.id', '=', 'ca.cliente_id')
                ->join('users as u', 'u.id', '=', 'kardexes.enviadoPor')
                ->select('kardexes.id', 'c.nombre as cliente', 't.codigo as tipo', 'ca.carpeta', 'kardexes.destinatario', 'kardexes.descripcion', 'u.name as enviadoPor','kardexes.updated_at')
                ->orderBy('kardexes.updated_at', 'desc')
                ->get();
        }
    }

    public function getDataServicios($value)
    {
        $this->servicios = ControlArchivo::join('tipo_servicios', 'tipo_servicios.id', '=', 'control_archivos.tipo_servicio_id')
            ->select('control_archivos.id', 'tipo_servicios.codigo as codigo', 'control_archivos.carpeta', 'tipo_servicios.nombre as nombre')
            ->where('control_archivos.cliente_id', '=', $value)
            ->orderBy('tipo_servicios.codigo', 'asc')
            ->orderBy('carpeta', 'asc')
            ->get();
        return collect($this->servicios)->toArray();
    }


    public function saveKardex()
    {
        $rules = [
            'destinatario' => 'required',
            'descripcion'=> 'required',
        ];

        $messages = [
            'destinatario.required' => 'Destinatario es requerido',
            'descripcion.required' => 'La Descripcion no puede estar vacia'
        ];


        $this->validate($rules, $messages);
        $kardex = Kardex::create([
            'control_archivo_id' => $this->servicioId,
            'destinatario' => $this->destinatario,
            'descripcion' => $this->descripcion,
            'enviadoPor' => Auth::user()->id
        ]);
        $this->reset();
        $fecha = Carbon::now();
        $this->fechaActual = $fecha->toDateTimeString();
        $this->emit('kardex-added', 'Carta Registrada');
        $this->reset();
        $this->clientes = Cliente::all();
    }

    public function Edit($id)
    {
        $record = Kardex::find($id);
        $this->selected_id = $record->id;
        $this->servicioId = $record->control_archivo_id;
        $control = ControlArchivo::find($record->control_archivo_id);
        $this->clienteId = $control->cliente_id;
        $this->carpeta = $control->carpeta;
        $this->destinatario = $record->destinatario;
        $this->descripcion = $record->descripcion;
        $this->enviadoPor = $record->enviadoPor;
        $this->emit('updateSelect2');
    }

    public function Ver($id)
    {
        $record = Kardex::find($id);
        $control = ControlArchivo::find($record->control_archivo_id);
        $enviadoPor = User::find($record->enviadoPor);
        $clienteId = $control->cliente_id;
        $tipoId = $control->tipo_servicio_id;
        $cliente = Cliente::find($clienteId);
        $this->clienteNombre = $cliente->nombre;
        $tipo = TipoServicio::find($tipoId);
        $this->tipoCodigo = $tipo->codigo;
        $this->tipoNombre = $tipo->nombre;
        $this->carpeta = $control->carpeta;
        $this->date = $record->created_at->toDateTimeString();
        $this->destinatario = $record->destinatario;
        $this->descripcion = $record->descripcion;
        $this->enviadoX = $enviadoPor->name;

        $this->emit('show-modal');
    }

    public function resetUI()
    {
        $this->resetExcept('componetName', 'pageTitle', 'desde', 'hasta');
    }

    public function actualizarKardex()
    {
        $rules = [
            'destinatario' => 'required',
            'descripcion'=> 'required',
        ];

        $messages = [
            'destinatario.required' => 'Destinatario es requerido',
            'descripcion.required' => 'La Descripcion no puede estar vacia'
        ];


        $this->validate($rules, $messages);
        $kardex = Kardex::find($this->selected_id);
        $kardex->update([
            'control_archivo_id' => $this->servicioId,
            'destinatario' => $this->destinatario,
            'descripcion' => $this->descripcion,
            'enviadoPor' => $this->enviadoPor,
        ]);
        $this->reset();
        $this->pageTitle = 'Listado';
        $this->componetName = 'Cartas';
        $fecha = Carbon::now();
        $this->fechaActual = $fecha->toDateTimeString();
        $this->reset();
        $this->clientes = Cliente::all();
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
