<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kardex extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'control_archivo_id',
        'cliente_id',
        'servicio',
        'tipo_servicio',
        'destinatario',
        'descripcion',
        'enviadoPor',
    ];

    public function clientes()
    {
        return $this->belongsTo(Cliente::class);
    }
}
