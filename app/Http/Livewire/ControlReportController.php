<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ControlReportController extends Component
{
    public $pageTitle, $componentName;
    private $pagination = 10;

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Carpetas';
    }
    public function render()
    {
        return view('livewire.control-report.component');
    }
}
