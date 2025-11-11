<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_modelo', 'descripcion_modelo'];

    // Un modelo tiene muchos productos
    public function productos()
    {
        return $this->hasMany(Producto::class, 'modelo_id');
    }
}
