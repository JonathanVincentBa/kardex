<?php

namespace App\Http\Livewire;

use App\Models\Servicio;
use App\Models\TipoServicio;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;


class TipoServiciosController extends Component
{
    use WithPagination;

    public $servicioid, $codigo, $nombre, $search, $selected_id, $pageTitle, $componetName, $user;
    private $pagination = 10;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componetName = 'Tipo de Servisios';
    }

    public function render()
    {
        if (strlen($this->search) > 0) {
            $data = TipoServicio::join('servicios as s', 's.id', '=', 'tipo_servicios.servicio_id')
                ->select('tipo_servicios.*', 's.nombre as servicio')
                ->where('tipo_servicios.nombre', 'like', '%' . $this->search . '%')
                ->orWhere('s.nombre', 'like', '%' . $this->search . '%')
                ->orderByRaw('tipo_servicios.id - tipo_servicios.codigo ASC')
                ->paginate($this->pagination);
        } else {
            $data = TipoServicio::join('servicios as s', 's.id', '=', 'tipo_servicios.servicio_id')
                ->select('tipo_servicios.*', 's.nombre as servicio')
                ->orderByRaw('tipo_servicios.id - tipo_servicios.codigo ASC')
                ->paginate($this->pagination);
        }

        return view(
            'livewire.tipo-servicio.component',
            [
                'tipoServicios' => $data,
                'servicios' => Servicio::orderBy('nombre', 'asc')->get()
            ]
        )
            ->extends('layouts.app')
            ->section('content');
    }

    public function Store()
    {
        $servicio = $this->servicioid;
        

        $cod = DB::select('select codigo from servicios where id = ?', [$this->servicioid]);

        

        $rules = [
            'servicioid' => 'required|not_in:Elegir',
            'codigo' => 'required|unique:tipo_servicios',
            'nombre' => 'required'

        ];

        $messages = [
            'servicioid.required' => 'Escoja un servicio',
            'servicio.not_in' => 'Escoja un cliente',
            'codigo.required' => 'El codigo del tipo de servicios es requerido',
            'codigo.unique' => 'El codigo ya existe'
        ];

        $this->validate($rules, $messages);

        $tipo_servicio = TipoServicio::create([
            'servicio_id' => $this->servicioid,
            'codigo' => $this->codigo,
            'nombre' => $this->nombre
        ]);

        $this->resetUI();
        $this->emit('tipoServicio-added', 'Tipo de servicio Registrado');
    }

    public function resetUI()
    {
        $this->servicioid = '';
        $this->codigo = '';
        $this->nombre = '';
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }

    public function Edit(TipoServicio $tipoServicio)
    {
        $this->selected_id = $tipoServicio->id;
        $this->servicioid = $tipoServicio->servicio_id;
        $this->codigo = $tipoServicio->codigo;
        $this->nombre = $tipoServicio->nombre;

        $this->emit('show-modal', 'Show modal!');
    }

    public function Update()
    {
        $rules = [
            'servicioid' => 'required|not_in:Elegir',
            'codigo' => "required|unique:tipo_servicios,codigo,{$this->selected_id}",
            'nombre' => 'required'

        ];

        $messages = [
            'servicioid.required' => 'Escoja un servicio',
            'servicio.not_in' => 'Escoja un cliente',
            'codigo.required' => 'El codigo del tipo de servicios es requerido',
            'codigo.unique' => 'El codigo ya existe'
        ];

        $this->validate($rules, $messages);


        $tipo_servicio = TipoServicio::find($this->selected_id);

        $tipo_servicio->update([
            'servicio_id' => $this->servicioid,
            'codigo' => $this->codigo,
            'nombre' => $this->nombre
        ]);

        $this->resetUI();
        $this->emit('tipoServicio-updated', 'Tipo de servicio Actualizado');
    }

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function Destroy(TipoServicio $tipoServicio)
    {
        $tipoServicio->delete();
        $this->resetUI();
        $this->emit('tipoServicio-deleted', 'Tipo de servicio Eliminado');
    }
}
