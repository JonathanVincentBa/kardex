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

    public $name, $email, $password, $imagen, $selected_id, $status, $perfil, $dni, $componetName, $pageTitle, $search;
    private $pagination = 10;

    public function mount()
    {
        $this->componetName = "Usuarios";
        $this->pageTitle = "listado";
        $this->status = "ELEGIR";
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
       if (strlen($this->search) > 0) {
            $data = User::where('name','like','%'.$this->search.'%')
                    ->select('*')
                    ->orderBy('name','asc')
                    ->paginate($this->pagination);
       }else
       {
            $data = User::select('*')
                    ->orderBy('name','asc')
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
        $this->perfil ='';
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
        $this->perfil = $user->perfil;
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
            'perfil'    => 'required|not_in:ELEGIR',
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
            'perfil.required'   => 'Selecciona el perfil/role del usuario',
            'perfil.not_in'     =>'seleccione un perfil / role distinto  a ELEGIR',
            'password.required' => 'Ingresa el password',
            'password.min'      => 'El password debe poseer al menos 3 caracteres'
        ];
        $this->validate($rules, $messages);

        $user = User::create([
            'name'      => $this->name,
            'email'     => $this->email,
            'email'     => $this->email,
            'status'    => $this->status,
            'perfil'    => $this->perfil,
            'password'  => bcrypt($this->password)
        ]);
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
            'perfil'    => 'required|not_in:ELEGIR',
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
            'perfil.required'   => 'Selecciona el perfil/role del usuario',
            'perfil.not_in'     =>'seleccione un perfil / role distinto  a ELEGIR',
            'password.required' => 'Ingresa el password',
            'password.min'      => 'El password debe poseer al menos 3 caracteres'
        ];
        $this->validate($rules, $messages);
        $user = User::find($this->selected_id);
        $user->update([
            'name'      => $this->name,
            'email'     => $this->email,
            'email'     => $this->email,
            'status'    => $this->status,
            'perfil'    => $this->perfil,
            'password'  => bcrypt($this->password)
        ]);
        
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
