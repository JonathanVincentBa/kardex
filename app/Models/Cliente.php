<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'codigo',
        'nombre',
        'direccion',
        'dni',
        'fono1',
        'fono2',
        'email',
    ];

    public function contacto_clientes()
    {
        return $this->hasMany(ContactoCliente::class);
    }
    public function control_archivos()
    {
        return $this->hasMany(ControlArchivo::class);
    }
    public function kardexes()
    {
        return $this->hasMany(Kardex::class);
    }
}
