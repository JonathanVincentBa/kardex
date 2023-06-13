<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactoCliente extends Model
{
    use HasFactory;
    use SoftDeletes;

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
