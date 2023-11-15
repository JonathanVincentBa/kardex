<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class UsersController extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $name, $email, $password, $imagen, $selected_id, $status, $role_id, $dni, $componetName, $pageTitle, $search;
    private $pagination = 10;

    public function mount()
    {
        $this->componetName = "Usuarios";
        $this->pageTitle = "listado";
        $this->role_id = "ELEGIR";
        $this->status = "ELEGIR";
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
            $data = User::join('roles','roles.id','users.role_id')
                    ->where('users.name','like','%'.$this->search.'%')
                    ->select('users.id','users.name','users.email','roles.name as role','users.status')
                    ->orderBy('users.id','asc')
                    ->paginate($this->pagination);
       }else
       {
            $data = User::join('roles','roles.id','users.role_id')
                    ->select('users.id','users.name','users.email','roles.name as role','users.status')
                    ->orderBy('users.id','asc')
                    ->paginate($this->pagination);
       }
        return view('livewire.users.component', [
                        'data' => $data, 
                        'roles' => Role::orderBy('name')->get()
                        ])
            ->extends('layouts.app')
            ->section('content');
    }

    public function resetUI()
    {
        $this->name ='';
        $this->email ='';
        $this->password ='';
        $this->imagen ='';
        $this->role_id ='';
        $this->dni ='';
        $this->search ='';
        $this->status ='';
        $this->selected_id ='';
        $this->resetValidation();
    }

    public function Edit(User $user)
    {
        $this->selected_id = $user->id;
        $this->name= $user->name;
        $this->role_id = $user->role_id;
        $this->status = $user->status;
        $this->email = $user->email;
        $this->password = '';
        $this->dni = $user->dni;

        $this->emit('show-modal', 'Show modal!');

    }

    protected $listeners =[
        'deleteRow' => 'destroy',
        'resetUI' => 'resetUI'
    ];

    public function Store()
    {
        $rules =[
            'name'      =>'required|min:3',
            'email'     => 'required|unique:users|email',
            'status'    => 'required|not_in:ELEGIR',
            'role_id'    => 'required|not_in:ELEGIR',
            'password'  => 'required|min:3'

        ];

        $messages =[
            'name.required'     => 'Ingresa el nombre',
            'name.min'          => 'El nombre del usuario debe tener al menos 3 caracteres',
            'email.required'    => 'Ingresa el correo',
            'email.email'       => 'Ingresa un correo valido',
            'email.unique'      => 'El email ya existe en sistema',
            'status.required'   => 'Selecciona el estatus del usuario',
            'status.not_in'     =>'seleccione el status',
            'role_id.required'   => 'Selecciona el rol del usuario',
            'role_id.not_in'     =>'seleccione un rol distinto  a ELEGIR',
            'password.required' => 'Ingresa el password',
            'password.min'      => 'El password debe poseer al menos 3 caracteres'
        ];
        $this->validate($rules, $messages);

        $role = $this->role_id;
        $user = User::create([
            'name'      => $this->name,
            'email'     => $this->email,
            'password'  => bcrypt($this->password),
            'role_id'    => $this->role_id,
            'status'    => $this->status,
            'dni'       =>$this->dni
            
        ]);

        if ($role == 1) {
            $user->assignRole('ADMINISTRACION');
        } else if ($role == 2) {
            $user->assignRole('SISTEMAS');
        }{
            $user->assignRole('ABOGADOS');
        }

        if ($this->imagen) {
            $customFileName = uniqid() .'_.' .$this->imagen->extension();
            $this->imagen->storeAs('storage/users', $customFileName);
            dd($this->imagen);
            $user->imagen = $customFileName;
            $user->save();
        }

        $this->resetUI();
        $this->emit('user-added', 'Usuario registrado');
    }

    public function Update()
    {


        $rules =[
            'email'     => "required|email|unique:users,email,{$this->selected_id}",
            'name'      => 'required|min:3',
            'status'    => 'required|not_in:ELEGIR',
            'role_id'    => 'required|not_in:ELEGIR',
            'password'  => 'required|min:3'

        ];

        $messages =[
            'name.required'     => 'Ingresa el nombre',
            'name.min'          => 'El nombre del usuario debe tener al menos 3 caracteres',
            'email.required'    => 'Ingresa el correo',
            'email.email'       => 'Ingresa un correo valido',
            'email.unique'      => 'El email ya existe en sistema',
            'status.required'   => 'Selecciona el estatus del usuario',
            'status.not_in'     =>'seleccione el status',
            'role_id.required'   => 'Selecciona el rol del usuario',
            'role_id.not_in'     =>'seleccione un rol distinto  a ELEGIR',
            'password.required' => 'Ingresa el password',
            'password.min'      => 'El password debe poseer al menos 3 caracteres'
        ];
        $this->validate($rules, $messages);
        $user = User::find($this->selected_id);
        $role = $this->role_id;
        $user->update([
            'name'      => $this->name,
            'email'     => $this->email,
            'password'  => bcrypt($this->password),
            'role_id'    => $this->role_id,
            'status'    => $this->status,
            'dni'       =>$this->dni
        ]);
        if ($role == 1) {
            $user->assignRole('ADMINISTRACION');
        } else if ($role == 2) {
            $user->assignRole('SISTEMAS');
        }{
            $user->assignRole('ABOGADOS');
        }
        
        if ($this->imagen) {
            $customFileName = uniqid() .'_.' .$this->imagen->extension();
            $this->imagen->storeAs('storage/users', $customFileName);
            $imageTemp = $user->imagen;

            $user->imagen = $customFileName;
            $user->save();

            if ($imageTemp != null) {
                if (file_exists('sotorage/users/' . $imageTemp)) {
                    unlink('sotorage/users/' . $imageTemp);
                }
            }
        }

        $this->resetUI();
        $this->emit('user-updated', 'Usuario actualizado');
    }


    public function destroy(User $user)
    {
        $user->delete();
        $this->resetUI();
        $this->emit('user-deleted','Usuario eliminado');
    }    

    public function getImagenAttribute()
    {
        if ($this->imagen == null) {
            return 'noimg.png';
        }

        if (file_exists('store/users/' . $this->imagen)) {
            return $this->imagen;
        } 
        else 
        {
            return 'noimg.png';
        }
    }
}
