<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IngresoDocumento extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'recibidoPor',
        'remitente',
        'detalle',
        'destinatario',
    ];
}
