<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_marca', 'descripcion_marca'];

    // Una marca tiene muchos productos
    public function productos()
    {
        return $this->hasMany(Producto::class, 'marca_id');
    }
}
