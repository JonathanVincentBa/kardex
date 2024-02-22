<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class ContactoCliente extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'cliente_id',
        'nombre',
        'fono',
        'extension',
        'celular',
        'email'
    ];

    public function clientes()
    {
        return $this->belongsTo(Cliente::class);
    }
}
