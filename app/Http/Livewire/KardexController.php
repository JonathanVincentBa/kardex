<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Kardexcontroller extends Component
{
    public $desde="", $hasta="", $controlArchivo =[], $selectedControlArchivo_id = "", $clientes =[], $selectedCliente_id="", $destinatario, $descripcion;
    
    
    public function render()
    {
        return view('livewire.kardex.component')
        ->extends('layouts.app')
        ->section('content');

    }
}
