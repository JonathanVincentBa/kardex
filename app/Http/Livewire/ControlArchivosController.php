<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\ControlArchivo;
use App\Models\TipoServicio;
use Livewire\Component;

class ControlArchivosController extends Component
{
    public $clienteId, $tipoId, $carpeta, $asunto, $status, $search, $selected_id, $pageTitle, $componetName;
    private $pagination = 100;

    public function mount()
    {
        $this->pageTitle = "Listado";
        $this->componetName = "Control de archivos";
    }

    public function paginationView()
    {
        return 'vendor.livewire.boostrap';
    }

    


    public function render()
    {

        if (strlen($this->search) > 0) {
            $data = ControlArchivo::join('clientes as c', 'c.id', '=', 'control_archivos.cliente_id')
                ->join('tipo_servicios as t', 't.id', '=', 'control_archivos.tipo_servicio_id' )
                ->select('c.nombre as cliente', 't.codigo as tipo' ,'carpeta', 'asunto')
                ->where('c.nombre', 'like', '%' . $this->search . '%')
                ->orderby('t.codigo')
                ->orderby('control_archivos.carpeta')
                ->get();
        }
        else
        {
            $data = ControlArchivo::join('clientes as c', 'c.id', '=', 'control_archivos.cliente_id')
            ->join('tipo_servicios as t', 't.id', '=', 'control_archivos.tipo_servicio_id' )
            ->select('c.nombre as cliente', 't.codigo as tipo' ,'carpeta', 'asunto')
            ->orderby('control_archivos.id', 'desc')
            ->get();
        }
        return view('livewire.controlArchivos.component', 
            [
                'controlArchivos' => $data,
                'clientes' => Cliente::orderBy('nombre', 'asc')->get(),
                'tipos' => TipoServicio::orderBy('codigo', 'asc')->get(),
            ])
            ->extends('layouts.app')
            ->section('content');
    }
}
