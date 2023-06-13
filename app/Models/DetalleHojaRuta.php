<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetalleHojaRuta extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'hoja_ruta_id',
        'remitente',
        'descripcion',
        'destinatario'
    ];
}
