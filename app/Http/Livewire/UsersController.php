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

    public $componetName, $pageTitle, $search, $imagen, $selected_id;

    public function mount()
    {
        $this->componetName = "Usuarios";
        $this->pageTitle = "listado";
    }

    public function render()
    {
        $data = User::all();
        $data2 = Role::all();
        return view('livewire.users.component', ['data' => $data, 'roles' => $data2])
            ->extends('layouts.app')
            ->section('content');
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
