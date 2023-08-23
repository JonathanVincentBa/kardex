<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;


class IngresoDocumentosController extends Component
{
    public $fechaActual,$horaActual,$user;

    public function mount()
    {
        $this->fechaActual = Carbon::now();
        $this->fechaActual->format("Y-m-d");

    }
    public function render()
    {
        return view('livewire.ingresoDocumentos.component')
        ->extends('layouts.app')
        ->section('content');
    }
}
