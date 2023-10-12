<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class PermisosController extends Component
{
    use WithPagination;
    
    public $permissionName, $search, $selected_id, $componentName, $pageTitle;

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
        $this->componentName = "Permisos";
        $this->pageTitle = "Listado";
    }
    public function render()
    {
        if(strlen($this->search) > 0)
        {
            $data = Permission::where('name', 'like', '%' . $this->search . '%')->orderBy('id', 'asc')->paginate($this->pagination);
        }else
        {
            $data = Permission::orderBy('id', 'asc')->paginate($this->pagination);
        }
        return view('livewire.permisos.component', [
            'permisos' => $data
        ])
        ->extends('layouts.app')
        ->section('content');
    }

    public function CreatePermission()
    {
        $rules = ['permissionName' => 'required|min:2|unique:permissions,name'];
        $messages = [
            'permissionName.required' => 'El nombre del permiso es requerido',
            'permissionName.unique' => 'El permiso ya existe',
            'permissionName.min' => 'El nombre del permiso debe tener al menos 2 caracteres',
        ];

        $this->validate($rules,$messages);
        
        Permission::create(['name' => $this->permissionName]);

        $this->emit('permiso-add', 'Se registro el rol con éxito');
        $this->resetUI();
    }

    public function Edit(Permission $premission)
    {

        $this->selected_id = $premission->id;
        $this->permissionName = $premission->name;

        $this->emit('show-modal', 'Show modal');

    }

    public function UpdatePermission()
    {
        $rules = ['permissionName' => "required|min:2|unique:permissions,name, {$this->selected_id}"];
        $messages = [
            'permissionName.required' => 'El nombre del permiso es requerido',
            'permissionName.unique' => 'El permiso ya existe',
            'permissionName.min' => 'El nombre del permiso debe tener al menos 2 caracteres',
        ];

        $this->validate($rules,$messages);

        $permiso = Permission::find($this->selected_id);
        $permiso->name = $this->permissionName;
        $permiso->save();
        $this->emit('permiso-updated', 'Se actualizo el permiso con éxito');
        $this->resetUI();
    }

    protected $listeners = ['destroy' => 'Destroy'];

    public function Destroy($id)
    {
        $rolesCount = Permission::find($id)->getRoleNames()->count();

        if ($rolesCount > 0) {
            $this->emit('permiso-error', 'No se puede eliminar el permiso por que tiene roles asociados');
            return;
        } else {
            Permission::find($id)->delete();
            $this->emit('permiso-delete', 'Permiso eliminado con éxito');
            $this->resetUI();
        }
    }

    public function resetUI()
    {
        $this->permissionName = '';
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }

}
