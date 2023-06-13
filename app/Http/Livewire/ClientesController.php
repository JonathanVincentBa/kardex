<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use Livewire\Component;
use Livewire\WithPagination;

class ClientesController extends Component
{
    use WithPagination;

    public $codigo, $nombre, $direccion, $dni, $fono1, $fono2, $email, $search, $selected_id, $pageTitle, $componetName;
    private $pagination = 10;

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componetName = 'Clientes';
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        if (strlen($this->search) > 0) {
            $data = Cliente::where('codigo', 'like', '%' . $this->search . '%')
                ->orWhere('nombre', 'like', '%' . $this->search . '%')
                ->orWhere('dni', 'like', '%' . $this->search . '%')
                ->paginate($this->pagination);
        } else {
            $data = Cliente::paginate($this->pagination);
        }


        return view('livewire.cliente.component', ['clientes' => $data])
            ->extends('layouts.app')
            ->section('content');
    }

    public function Edit($id)
    {
        $record = Cliente::find($id);
        $this->selected_id = $record->id;
        $this->codigo = $record->codigo;
        $this->nombre = $record->nombre;
        $this->direccion = $record->direccion;
        $this->dni = $record->dni;
        $this->fono1 = $record->fono1;
        $this->fono2 = $record->fono2;
        $this->email = $record->email;

        $this->emit('show-modal', 'Show modal!');
    }

    public function Store()
    {
        $rules = [
            'codigo' => 'required|unique:clientes|min:3|max:4',
            'nombre' => 'required',
            'direccion' => 'required',
            'dni' => 'required|min:10|max:13',
            'fono1' => 'required',
            'email' => 'required|unique:clientes'
        ];

        $messages = [
            'codigo.required' => 'Codigo de cliente es requerido',
            'codigo.unique' => 'Ya existe ese codigo de cliente',
            'codigo.min' => 'El codigo de debe tener al menos 3 caracteres',
            'codigo.max' => 'El codigo de debe tener no más de 4 caracteres',
            'nombre.required' => 'Nombre de cliente es requerido',
            'direccion.required' => 'Dirección de cliente es requerido',
            'dni.required' => 'R.U.C. de cliente es requerido',
            'dni.min' => 'El R.U.C. de debe tener al menos 10 caracteres',
            'dni.max' => 'El R.U.C. de debe tener no más de 13 caracteres',
            'fono1.required' => 'Teléfono de cliente es requerido',
            'email.required' => 'E-mail de cliente es requerido',
            'email.unique' => 'Ya existe ese email'
        ];


        $this->validate($rules, $messages);

        $cliente = Cliente::create([
            'codigo' => $this->codigo,
            'nombre' => $this->nombre,
            'direccion' => $this->direccion,
            'dni' => $this->dni,
            'fono1' => $this->fono1,
            'fono2' => $this->fono2,
            'email' => $this->email
        ]);



        $this->resetUI();
        $this->emit('cliente-added', 'Cliente Registrado');
    }

    public function Update()
    {

        $rules = [
            'codigo' => "required|min:3|max:4| unique:clientes,codigo,{$this->selected_id}",
            'nombre' => 'required',
            'direccion' => 'required',
            'dni' => 'required|min:10|max:13',
            'fono1' => 'required',
            'email' =>"required|unique:clientes,email,{$this->selected_id}"
        ];
        $messages = [
            'codigo.required' => 'Codigo de cliente es requerido',
            'codigo.unique' => 'Ya existe ese codigo de cliente',
            'codigo.min' => 'El codigo de debe tener al menos 3 caracteres',
            'codigo.max' => 'El codigo de debe tener no más de 4 caracteres',
            'nombre.required' => 'Nombre de cliente es requerido',
            'direccion.required' => 'Dirección de cliente es requerido',
            'dni.required' => 'R.U.C. de cliente es requerido',
            'dni.min' => 'El R.U.C. de debe tener al menos 10 caracteres',
            'dni.max' => 'El R.U.C. de debe tener no más de 13 caracteres',
            'fono1.required' => 'Teléfono de cliente es requerido',
            'email.required' => 'E-mail de cliente es requerido',
            'email.unique' => 'Ya existe ese email'
        ];


        $this->validate($rules, $messages);

        $cliente = Cliente::find($this->selected_id);
        $cliente->update([
            'codigo' => $this->codigo,
            'nombre' => $this->nombre,
            'direccion' => $this->direccion,
            'dni' => $this->dni,
            'fono1' => $this->fono1,
            'fono2' => $this->fono2,
            'email' => $this->email
        ]);

        $this->resetUI();
        $this->emit('cliente-updated', 'Cliente Actualizado');
    }

    public function resetUI()
    {
        $this->codigo = '';
        $this->nombre = '';
        $this->direccion = '';
        $this->dni = '';
        $this->fono1 = '';
        $this->fono2 = '';
        $this->email = '';
        $this->search = '';
        $this->selected_id = 0;
    }

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function Destroy(Cliente $cliente)
    {
        $cliente->delete();
        $this->resetUI();
        $this->emit('cliente-deleted', 'Cliente Eliminado');
    }
}
