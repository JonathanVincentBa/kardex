<?php

namespace App\Http\Livewire;

use App\Models\ControlArchivo;
use Livewire\Component;

class PassivesController extends Component
{
    public $componetName, $pageTitle;
    private $pagination = 50;

    public function mount()
    {
        $this->componetName = 'Listado';
        $this->pageTitle = 'Control de Archivos Pasivos';
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }


    public function render()
    {
        $data = ControlArchivo::join('clientes as c', 'c.id', '=', 'control_archivos.cliente_id')
        ->join('tipo_servicios as t', 't.id', '=', 'control_archivos.tipo_servicio_id')
        ->join('users as u', 'u.id', '=', 'control_archivos.user_id')
        ->select('control_archivos.id', 'u.name as usuario', 'c.codigo as cod_cliente', 'c.nombre as cliente', 't.codigo as tipo', 'carpeta', 'caja_deleted')
        ->whereNotNull('control_archivos.caja_deleted')
        ->orderby('control_archivos.caja_deleted', 'desc')
        ->onlyTrashed()
        ->paginate($this->pagination);
        return view('livewire.pasivos.component',['controlArchivos' => $data])
        ->extends('layouts.app')
        ->section('content');
    }
}
