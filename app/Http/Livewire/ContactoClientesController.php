<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\ContactoCliente;
use Livewire\Component;
use Livewire\WithPagination;

class ContactoClientesController extends Component
{
    use WithPagination;

    public $clienteid, $nombre, $fono, $extension, $celular, $email, $search, $selected_id, $pageTitle, $componetName;

    private $pagination = 5;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componetName = 'Contato Clientes';
    }


    public function render()
    {
        if (strlen($this->search) > 0) {
            $data = ContactoCliente::join('clientes as c', 'c.id', '=', 'contacto_clientes.cliente_id')
                ->select('contacto_clientes.*', 'c.nombre as cliente')
                ->where('contacto_clientes.nombre', 'like', '%' . $this->search . '%')
                ->orWhere('c.nombre', 'like', '%' . $this->search . '%')
                ->orderBy('contacto_clientes.nombre', 'asc')
                ->paginate($this->pagination);

        } else {
            $data = ContactoCliente::join('clientes as c', 'c.id', '=', 'contacto_clientes.cliente_id')
                ->select('contacto_clientes.*', 'c.nombre as cliente')
                ->orderBy('contacto_clientes.nombre', 'asc')
                ->paginate($this->pagination);
        }


        return view(
            'livewire.contacto-cliente.component',
            [
                'contactoClientes' => $data,
                'clientes' => Cliente::orderBy('nombre', 'asc')->get()
            ]
        )
            ->extends('layouts.app')
            ->section('content');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function Store()
    {
        $rules = [
            'clienteid' => 'required',
            'nombre' => 'required',
            'fono' => 'required',
            'celular' => 'required',
            'email' => 'required|unique:contacto_clientes'
        ];

        $messages = [
            'clienteid.required' => 'Escoja un cliente',
            'nombre.required' => 'Nombre del contacto es requerido',
            'fono.required' => 'Teléfono de contacto es requerido',
            'celular.required' => 'Celular de contacto es requerido',
            'email.required' => 'E-mail de contacto es requerido',
            'email.unique' => 'Ya existe ese email'
        ];


        $this->validate($rules, $messages);

        $contacto_cliente = ContactoCliente::create([
            'cliente_id' => $this->clienteid,
            'nombre' => $this->nombre,
            'fono' => $this->fono,
            'extension' => $this->extension,
            'celular' => $this->celular,
            'email' => $this->email
        ]);



        $this->resetUI();
        $this->emit('contactoCliente-added', 'Contacto Registrado');
    }

    public function resetUI()
    {
        $this->clienteid = '';
        $this->nombre = '';
        $this->fono = '';
        $this->extension = '';
        $this->celular = '';
        $this->email = '';
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }

      public function Edit(ContactoCliente $contactoCliente)
    {

        $this->selected_id = $contactoCliente->id;
        $this->clienteid = $contactoCliente->cliente_id;
        $this->nombre = $contactoCliente->nombre;
        $this->fono = $contactoCliente->fono;
        $this->extension = $contactoCliente->extension;
        $this->celular = $contactoCliente->celular;
        $this->email = $contactoCliente->email;

        $this->emit('show-modal', 'Show modal!');
    }

    public function Update()
    {

        $rules = [
            'clienteid' => 'required',
            'nombre' => 'required',
            'fono' => 'required',
            'celular' => 'required',
            'email' =>"required|unique:contacto_clientes,email,{$this->selected_id}"
        ];

        $messages = [
            'clienteid.required' => 'Escoja un cliente',
            'nombre.required' => 'Nombre del contacto es requerido',
            'fono.required' => 'Teléfono de contacto es requerido',
            'celular.required' => 'Celular de contacto es requerido',
            'email.required' => 'E-mail de contacto es requerido',
            'email.unique' => 'Ya existe ese email'
        ];

        $this->validate($rules, $messages);



        $contacto_cliente = ContactoCliente::find($this->selected_id);

        $contacto_cliente ->updated([
            'cliente_id' => $this->clienteid,
            'nombre' => $this->nombre,
            'fono' => $this->fono,
            'extension' => $this->extension,
            'celular' => $this->celular,
            'email' => $this->email
        ]);

        $this->resetUI();
        $this->emit('contactoCliente-updated', 'Contacto Actualizado');
    }

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function Destroy(ContactoCliente $contactoCliente)
    {
        $contactoCliente->delete();
        $this->resetUI();
        $this->emit('contactoCliente-deleted', 'Contacto Eliminado');
    }
}
