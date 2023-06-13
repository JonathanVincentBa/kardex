<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ControlArchivo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'cliente_id',
        'servicio_id',
        'tipo_servicio_id',
        'carpeta',
        'asunto',
        'status'
    ];

    public function clientes()
    {
        return $this->belongsTo(Cliente::class);
    }
}
