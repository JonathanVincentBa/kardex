<?php

namespace App\Http\Livewire;

use App\Models\ControlArchivo;
use Livewire\Component;

class ControlArchivosController extends Component
{
    public $clienteId, $tipoSevicioId, $carpeta, $asunto, $status, $search, $selected_id, $pageTitle, $componetName;
    private $pagination = 10;

    public function mount()
    {
        $this->clientes = Cliente::orderBy('nombre', 'asc')->get();
    }



    public function render()
    {
        if (strlen($this->search) > 0) {
            $data = ControlArchivo::join('clientes as c', 'c.id', '=', 'control_archivos.cliente_id')
                ->join('tipo_servicios as t', 't.id', '=', 'control_archivos.tipo_servicio_id' )
                ->select('c.nombre as cliente', 't.codigo as tipo' ,'carpeta', 'asunto')
                ->where('c.nombre', 'like', '%' . $this->search . '%')
                ->orderby('control_archivos.id', 'desc')
                ->paginate($this->pagination);
        }
        else
        {
            $data = ControlArchivo::join('clientes as c', 'c.id', '=', 'control_archivos.cliente_id')
            ->join('tipo_servicios as t', 't.id', '=', 'control_archivos.tipo_servicio_id' )
            ->select('c.nombre as cliente', 't.codigo as tipo' ,'carpeta', 'asunto')
            ->orderby('control_archivos.id', 'desc')
            ->get();
        }
        return view('livewire.controlArchivos.component', ['controlArchivos' => $data])
            ->extends('layouts.app')
            ->section('content');
    }

    public function updatedselectedCliente($cliente_id)
    {
        $this->tipos = TipoServicio::orderBy('codigo', 'asc')->get();
    }
}
