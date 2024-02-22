<?php

namespace App\Http\Livewire;

use App\Models\Servicio;
use Livewire\Component;
use Livewire\WithPagination;

class ServiciosController extends Component
{
    use WithPagination;

    public $codigo, $nombre, $search, $selected_id, $pageTitle, $componetName, $user;
    private $pagination = 10;

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componetName ='Servicios';
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function render()
    {
        if (strlen($this->search) > 0) {
            $data = Servicio::where('codigo', 'like', '%' .$this->search. '%')
                          ->orWhere('nombre', 'like', '%' .$this->search. '%')
                          ->paginate($this->pagination);
        } else {
            $data = Servicio::paginate($this->pagination);
        }

        return view('livewire.servicio.component', ['servicios' => $data])
               ->extends('layouts.app')
               ->section('content');
    }

    public function Edit($id)
    {
        $record = Servicio::find($id);
        $this->selected_id = $record->id;
        $this->codigo = $record->codigo;
        $this->nombre = $record->nombre;

        $this->emit('show-modal', 'Show modal!');
    }

    public function Store()
    {
        $rules = [
            'codigo' => 'required|unique:servicios|max:4',
            'nombre' => 'required'
        ];
        $messages = [
            'codigo.required' => 'Codigo de servicio es requerido',
            'codigo.unique' => 'Ya existe ese codigo de servicio',
            'codigo.max' => 'El codigo de debe tener no más de 4 caracteres',
            'nombre.required' => 'Nombre de servicio es requerido'
        ];

        $this->validate($rules, $messages);

        $cliente = Servicio::create([
            'codigo' => $this->codigo,
            'nombre' => $this->nombre
        ]);

        $this->resetUI();
        $this->emit('servicio-added', 'Servicio Registrado');
    }

    public function Update()
    {
        $rules = [
            'codigo' => [
                'required',
                'max:4',
                'unique:clientes,codigo,'
                    . $this->selected_id
            ],
            'nombre' => 'required'
        ];
        $messages = [
            'codigo.required' => 'Codigo de servicio es requerido',
            'codigo.unique' => 'Ya existe ese codigo de servicio',
            'codigo.max' => 'El codigo de debe tener no más de 4 caracteres',
            'nombre.required' => 'Nombre de servicio es requerido'
        ];

        $this->validate($rules, $messages);

        $cliente = Servicio::find($this->selected_id);
        $cliente->update([
            'codigo' => $this->codigo,
            'nombre' => $this->nombre
        ]);

        $this->resetUI();
        $this->emit('servicio-updated', 'Servicio Actualizado');
    }

    public function resetUI()
    {
        $this->codigo = '';
        $this->nombre = '';
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function Destroy(Servicio $servicio)
    {
        $servicio->delete();
        $this->resetUI();
        $this->emit('servicio-deleted', 'Servicio Eliminado');
    }
}
