<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;

class ClienteExportController extends Controller
{
    public function reportPDF($reportType)
    {
        $data = [];

        if ($reportType == 0) {
            $data = Cliente::withTrashed()->get();
        } else  if($reportType == 1){
            $data = Cliente::all();
        }else
        {
            $data = Cliente::onlyTrashed()->get();
        }
                
        $pdf = PDF::loadView('pdf.cliente', compact('data', 'reportType'));

        return $pdf->stream('cliente.pdf'); 
    }
}
