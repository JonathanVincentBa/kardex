<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\ControlArchivo;
use App\Models\TipoServicio;
use Livewire\Component;

class ControlArchivosController extends Component
{
    public $clientes = [], $tipos = [], $asunto = "", $selectedCliente = "", $selectedTipo = "", $codigo ="", $selected_id = "";
    

    public function mount()
    {
        
        $this->clientes = Cliente::orderBy('nombre', 'asc')->get();
        $this->tipos = TipoServicio::orderBy('codigo', 'asc')->get();
        
    }

    public function render()
    {
             

        if ($this->selectedCliente <> "") {
               
            $data = ControlArchivo::join('clientes as c', 'c.id', '=', 'control_archivos.cliente_id')
                ->join('tipo_servicios as t', 't.id', '=', 'control_archivos.tipo_servicio_id' )
                ->select('control_archivos.id','c.nombre as cliente', 't.codigo as tipo' ,'carpeta', 'asunto')
                ->where('control_archivos.cliente_id', '=', $this->selectedCliente)
                ->orderby('t.codigo')
                ->orderby('control_archivos.carpeta')
                ->get();
        }
        else
        {
            $data = ControlArchivo::join('clientes as c', 'c.id', '=', 'control_archivos.cliente_id')
            ->join('tipo_servicios as t', 't.id', '=', 'control_archivos.tipo_servicio_id' )
            ->select('control_archivos.id','c.nombre as cliente', 't.codigo as tipo' ,'carpeta', 'asunto')
            ->orderby('control_archivos.id', 'desc')
            ->get();
        }

       // dd($this->selectedTipo, $this->selectedTipo, $data);
        return view('livewire.controlArchivos.component', 
            [
                'controlArchivos' => $data,
            ])
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

    public function updatedselectedTipo($tipoId)
    {
        $this->codigo = ControlArchivo::withTrashed()
                                        ->where('cliente_id',$this->selectedCliente)
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
        if (is_null($this->selectedCliente)) {
            $this->emit('sale-error', 'SELECCIONAR UN CLIENTE');
            return;
        }
        
        if (is_null($this->selectedTipo))
        {
            $this->emit('sale-error', 'SELECCIONAR UN SERVICIO');
            return;
        }

        if (is_null($this->asunto)) {
            $this->emit('sale-error', 'INGRESE EL ASUNTO DEL DOCUMENTO');
            return;
        }

        $control = ControlArchivo::create([
            'cliente_id' => $this->selectedCliente,
            'tipo_servicio_id' => $this->selectedTipo,
            'carpeta' => $this->codigo,
            'asunto' => $this->asunto,
        ]);

        $this->resetExcept('selectedCliente');
    }

    public function actualizarControl()
    {
        if (is_null($this->selectedTipo))
        {
            $this->emit('sale-error', 'SELECCIONAR UN SERVICIO');
            return;
        }

        if (is_null($this->asunto)) {
            $this->emit('sale-error', 'INGRESE EL ASUNTO DEL DOCUMENTO');
            return;
        }
        $control = ControlArchivo::find($this->selected_id);
        $control->update([
            'tipo_servicio_id' => $this->selectedTipo,
            'carpeta' => $this->codigo,
            'asunto' => $this->asunto,
        ]);

        

        $this->resetExcept('selectedCliente');
    }
    

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function Destroy(ControlArchivo $controlArchivo)
    {
        $controlArchivo->delete();
        $this->resetExcept('selectedCliente');
        $this->emit('controlArchivo-deleted', 'Registro Eliminado');
        $this->emit('updateSelect2Servicio');
    }
    
}
