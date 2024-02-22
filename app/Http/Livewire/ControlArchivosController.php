<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\ControlArchivo;
use App\Models\TipoServicio;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ControlArchivosController extends Component
{
    public $clientes = [], $tipos = [], $asunto = "", $selectedCliente = "", $selectedTipo = "", $codigo = "", $selected_id = "", $search, $controles;


    public function mount()
    {

        $this->clientes = Cliente::orderBy('nombre', 'asc')->get();
        $this->tipos = TipoServicio::orderBy('codigo', 'asc')->get();
    }

    public function render()
    {
        if ($this->selectedCliente <> "") {
            $data = ControlArchivo::join('clientes as c', 'c.id', '=', 'control_archivos.cliente_id')
                ->join('tipo_servicios as t', 't.id', '=', 'control_archivos.tipo_servicio_id')
                ->join('users as u', 'u.id', '=', 'control_archivos.user_id')
                ->select('control_archivos.id', 'u.name as usuario', 'c.codigo as cod_cliente', 'c.nombre as cliente', 't.codigo as tipo', 'carpeta', 'asunto')
                ->where('control_archivos.cliente_id', '=', $this->selectedCliente)
                ->orderby('t.codigo')
                ->orderby('control_archivos.carpeta')
                ->get();
        } else {
            $data = ControlArchivo::join('clientes as c', 'c.id', '=', 'control_archivos.cliente_id')
                ->join('tipo_servicios as t', 't.id', '=', 'control_archivos.tipo_servicio_id')
                ->join('users as u', 'u.id', '=', 'control_archivos.user_id')
                ->select('control_archivos.id', 'u.name as usuario', 'c.codigo as cod_cliente', 'c.nombre as cliente', 't.codigo as tipo', 'carpeta', 'asunto')
                ->orderby('control_archivos.id', 'desc')
                ->get();
        }

        //dd($this->selectedTipo, $this->selectedTipo, $data);
        return view(
            'livewire.controlArchivos.component',
            [
                'controlArchivos' => $data,
            ]
        )
            ->extends('layouts.app')
            ->section('content');
    }

    public function Edit($id)
    {
        $record = ControlArchivo::find($id);

        $this->selected_id = $record->id;
        $this->selectedCliente = $record->cliente_id;
        $this->selectedTipo = $record->tipo_servicio_id;
        $this->codigo = $record->carpeta;
        $this->asunto = $record->asunto;
        $this->emit('updateSelect2Servicio');
    }

    public function updatedSearch()
    {
        if (strlen($this->search) > 0 && $this->selectedCliente <> "") {
            $this->controles = ControlArchivo::join('clientes as c', 'c.id', '=', 'control_archivos.cliente_id')
                ->join('tipo_servicios as t', 't.id', '=', 'control_archivos.tipo_servicio_id')
                ->join('users as u', 'u.id', '=', 'control_archivos.user_id')
                ->select('control_archivos.id', 'u.name as usuario', 'c.codigo as cod_cliente', 'c.nombre as cliente', 't.codigo as tipo', 'carpeta', 'asunto')
                ->where('control_archivos.cliente_id', '=', $this->selectedCliente)
                ->Where('control_archivos.asunto', 'like', '%' . $this->search . '%')
                ->orderby('t.codigo')
                ->orderby('control_archivos.carpeta')
                ->get();
        }
        else
        {
            $this->controles = ControlArchivo::join('clientes as c', 'c.id', '=', 'control_archivos.cliente_id')
            ->join('tipo_servicios as t', 't.id', '=', 'control_archivos.tipo_servicio_id')
            ->join('users as u', 'u.id', '=', 'control_archivos.user_id')
            ->select('control_archivos.id', 'u.name as usuario', 'c.codigo as cod_cliente', 'c.nombre as cliente', 't.codigo as tipo', 'carpeta', 'asunto')
            ->where('control_archivos.cliente_id', '=', $this->selectedCliente)
            ->orderby('t.codigo')
            ->orderby('control_archivos.carpeta')
            ->get();
        }
    }
    public function updatedselectedTipo($tipoId)
    {


        $this->codigo = ControlArchivo::withTrashed()
            ->where('cliente_id', $this->selectedCliente)
            ->where('tipo_servicio_id', $tipoId)
            ->count();
    }

    public function updateCliente($id)
    {
        $this->reset();
        $this->selectedCliente = $id;
        $this->emit('updateSelect2Servicio');
    }



    public function saveControl()
    {
        $rules = [
            /* 'tipo_servicio_id'=> 'required', */
            'asunto'=> 'required',
        ];

        $messages = [
            /* 'tipo_servicio_id.required' => 'Codigo de servicio es requerido', */
            'asunto.required' => 'El asunto es requerido',
        ];


        $this->validate($rules, $messages);

        $control = ControlArchivo::create([
            'cliente_id' => $this->selectedCliente,
            'tipo_servicio_id' => $this->selectedTipo,
            'carpeta' => $this->codigo,
            'asunto' => $this->asunto,
            'user_id' => Auth::user()->id
        ]);


        $this->emit('control-added', 'REGISTRO INGRESADO CORRECTAMENTE');
        $this->resetExcept('selectedCliente');
    }

    public function actualizarControl()
    {
        
        $control = ControlArchivo::find($this->selected_id);
        $control->update([
            'tipo_servicio_id' => $this->selectedTipo,
            'asunto' => $this->asunto,
            'user_id' => Auth::user()->id
        ]);


        $this->emit('control-updated', 'REGISTRO ACTUALIZADO CORRECTAMENTE');
        $this->resetExcept('selectedCliente');
    }


    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function Destroy($valor, $controlArchivo )
    {
        $control = ControlArchivo::find($controlArchivo);
        $control->update([
            'caja_deleted' => $valor
        ]);
       $control->delete();
        $this->resetExcept('selectedCliente');
        $this->emit('control-deleted', 'El registro paso a pasivo correctamente');
        $this->emit('updateSelect2Servicio');
    }
}
