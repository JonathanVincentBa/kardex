<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class ControlArchivo extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'cliente_id',
        'tipo_servicio_id',
        'carpeta',
        'asunto',
        'status'
    ];

    public function clientes()
    {
        return $this->belongsTo(Cliente::class);
    }
    public function kardexes()
    {
        return $this->hasMany(Kardex::class);
    }
}
