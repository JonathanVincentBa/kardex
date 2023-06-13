<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\ControlArchivo;
use App\Models\TipoServicio;
use Livewire\Component;
use Livewire\WithPagination;

class ControlArchivosController extends Component
{
    use WithPagination;

    public $clienteId, $servicioId, $tipoId, $carpeta, $asunto, $status, $search, $select_id, $pageTitle, $componetName;

    private $pagination = 10;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componetName = 'Control de Archivos';
        $this->clienteId = 'Elegir';
        $this->servicioId = 'Elegir';
        $this->tipoId = 'Elegir';
    }

    public function render()
    {
        if (strlen($this->search) > 0) {
            $data = ControlArchivo::join('clientes as c', 'control_archivos.id', '=', 'c.id')
            ->join('tipo_servicios as s', 'control_archivos.id', '=', 's.id')
            ->select('control_archivos.*', 'c.nombre as cliente', 's.codigo as tipoCodigo', 's.nombre as tipoNombre')
            ->orderByRaw('s.codigo - control_archivos.carpeta ASC')
            ->paginate($this->pagination);
        }

        return view(
            'livewire.control-archivos.component',
            )
            ->extends('layouts.app')
            ->section('content');
    }
}
