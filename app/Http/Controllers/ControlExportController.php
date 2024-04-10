<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\ControlArchivo;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
/*use Maatwebsite\Excel\Facades\Excel; */
class ControlExportController extends Controller
{
    
    public function reportPDF($clienteId, $reportType, $carpetaId)
    {
        
        $data = [];

        if ($clienteId == 0 && $reportType == 0 && $clienteId == 0) {
            $data = ControlArchivo::join('clientes as c', 'c.id', '=', 'control_archivos.cliente_id')
            ->join('tipo_servicios as t', 't.id', '=', 'control_archivos.tipo_servicio_id')
            ->join('users as u', 'u.id', '=', 'control_archivos.user_id')
            ->select('control_archivos.id', 'u.name as usuario', 'c.codigo as cod_cliente', 'c.nombre as cliente', 't.codigo as tipo', 'carpeta', 'asunto', 'control_archivos.created_at', 'control_archivos.deleted_at', 'control_archivos.caja_deleted')
            ->orderby('t.codigo')
            ->orderby('control_archivos.carpeta')
            ->withTrashed()
            ->get();
        } else if ($clienteId == 0 && $reportType == 0 && $carpetaId <> 0) {
            $data = ControlArchivo::join('clientes as c', 'c.id', '=', 'control_archivos.cliente_id')
            ->join('tipo_servicios as t', 't.id', '=', 'control_archivos.tipo_servicio_id')
            ->join('users as u', 'u.id', '=', 'control_archivos.user_id')
            ->select('control_archivos.id', 'u.name as usuario', 'c.codigo as cod_cliente', 'c.nombre as cliente', 't.codigo as tipo', 'carpeta', 'asunto', 'control_archivos.created_at', 'control_archivos.deleted_at', 'control_archivos.caja_deleted')
            ->where('control_archivos.tipo_servicio_id', '=', $carpetaId)
            ->orderby('t.codigo')
            ->orderby('control_archivos.carpeta')
            ->withTrashed()
            ->get();
        }  else if($clienteId == 0 && $reportType == 1 && $carpetaId <> 0)
        {
            $data = ControlArchivo::join('clientes as c', 'c.id', '=', 'control_archivos.cliente_id')
            ->join('tipo_servicios as t', 't.id', '=', 'control_archivos.tipo_servicio_id')
            ->join('users as u', 'u.id', '=', 'control_archivos.user_id')
            ->select('control_archivos.id', 'u.name as usuario', 'c.codigo as cod_cliente', 'c.nombre as cliente', 't.codigo as tipo', 'carpeta', 'asunto', 'control_archivos.created_at', 'control_archivos.deleted_at', 'control_archivos.caja_deleted')
            ->where('control_archivos.tipo_servicio_id', '=', $carpetaId)
            ->orderby('t.codigo')
            ->orderby('control_archivos.carpeta')
            ->get();
        }else if($clienteId == 0 && $reportType == 2 && $carpetaId <> 0)
        {
            $data = ControlArchivo::join('clientes as c', 'c.id', '=', 'control_archivos.cliente_id')
            ->join('tipo_servicios as t', 't.id', '=', 'control_archivos.tipo_servicio_id')
            ->join('users as u', 'u.id', '=', 'control_archivos.user_id')
            ->select('control_archivos.id', 'u.name as usuario', 'c.codigo as cod_cliente', 'c.nombre as cliente', 't.codigo as tipo', 'carpeta', 'asunto', 'control_archivos.created_at', 'control_archivos.deleted_at', 'control_archivos.caja_deleted')
            ->where('control_archivos.tipo_servicio_id', '=', $carpetaId)
            ->orderby('t.codigo')
            ->orderby('control_archivos.carpeta')
            ->onlyTrashed()
            ->get();
        }else if($clienteId <> 0 && $reportType == 0 && $carpetaId == 0)
        {
            $data = ControlArchivo::join('clientes as c', 'c.id', '=', 'control_archivos.cliente_id')
            ->join('tipo_servicios as t', 't.id', '=', 'control_archivos.tipo_servicio_id')
            ->join('users as u', 'u.id', '=', 'control_archivos.user_id')
            ->select('control_archivos.id', 'u.name as usuario', 'c.codigo as cod_cliente', 'c.nombre as cliente', 't.codigo as tipo', 'carpeta', 'asunto', 'control_archivos.created_at', 'control_archivos.deleted_at', 'control_archivos.caja_deleted')
            ->where('control_archivos.cliente_id', '=', $clienteId)
            ->orderby('t.codigo')
            ->orderby('control_archivos.carpeta')
            ->withTrashed()
            ->get();
        }else if($clienteId <> 0 && $reportType == 0 && $carpetaId <> 0)
        {
            $data = ControlArchivo::join('clientes as c', 'c.id', '=', 'control_archivos.cliente_id')
            ->join('tipo_servicios as t', 't.id', '=', 'control_archivos.tipo_servicio_id')
            ->join('users as u', 'u.id', '=', 'control_archivos.user_id')
            ->select('control_archivos.id', 'u.name as usuario', 'c.codigo as cod_cliente', 'c.nombre as cliente', 't.codigo as tipo', 'carpeta', 'asunto', 'control_archivos.created_at', 'control_archivos.deleted_at', 'control_archivos.caja_deleted')
            ->where('control_archivos.cliente_id', '=', $clienteId)
            ->where('control_archivos.tipo_servicio_id', '=', $carpetaId)
            ->orderby('t.codigo')
            ->orderby('control_archivos.carpeta')
            ->withTrashed()
            ->get();
        }else if($clienteId <> 0 && $reportType == 1 && $carpetaId <> 0)
        {
            $data = ControlArchivo::join('clientes as c', 'c.id', '=', 'control_archivos.cliente_id')
            ->join('tipo_servicios as t', 't.id', '=', 'control_archivos.tipo_servicio_id')
            ->join('users as u', 'u.id', '=', 'control_archivos.user_id')
            ->select('control_archivos.id', 'u.name as usuario', 'c.codigo as cod_cliente', 'c.nombre as cliente', 't.codigo as tipo', 'carpeta', 'asunto', 'control_archivos.created_at', 'control_archivos.deleted_at', 'control_archivos.caja_deleted')
            ->where('control_archivos.cliente_id', '=', $clienteId)
            ->where('control_archivos.tipo_servicio_id', '=', $carpetaId)
            ->orderby('t.codigo')
            ->orderby('control_archivos.carpeta')
            ->get();
        }else if($clienteId <> 0 && $reportType == 2 && $carpetaId <> 0)
        {
            $data = ControlArchivo::join('clientes as c', 'c.id', '=', 'control_archivos.cliente_id')
            ->join('tipo_servicios as t', 't.id', '=', 'control_archivos.tipo_servicio_id')
            ->join('users as u', 'u.id', '=', 'control_archivos.user_id')
            ->select('control_archivos.id', 'u.name as usuario', 'c.codigo as cod_cliente', 'c.nombre as cliente', 't.codigo as tipo', 'carpeta', 'asunto', 'control_archivos.created_at', 'control_archivos.deleted_at', 'control_archivos.caja_deleted')
            ->where('control_archivos.cliente_id', '=', $clienteId)
            ->where('control_archivos.tipo_servicio_id', '=', $carpetaId)
            ->orderby('t.codigo')
            ->orderby('control_archivos.carpeta')
            ->onlyTrashed()
            ->get();
        }

        $clienteNombre = $clienteId ==0 ? 'Todos los clientes' : Cliente::find($clienteId)->nombre;
        $pdf = PDF::loadView('pdf.control-archivo', compact('data', 'reportType','clienteNombre'));

        return $pdf->stream('control-archivo.pdf'); 
        /* return $pdf->download('control-archivo.pdf'); //exportar */
    }
}
