<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'pnombre',
        'pdescripcion',
        'preciocompra',
        'preciounitario',
        'cantidad_ingresada',
        'stock',
        'modelos_id',
        'marcas_id',
        'categorias_id',
        'unidadmedidas_id',
        'estados_id',
    ];

    // Un producto pertenece a un modelo
    public function modelo()
    {
        return $this->belongsTo(Modelo::class, 'modelos_id');
    }

    // Un producto pertenece a una marca
    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marcas_id');
    }

    // Un producto pertenece a una categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categorias_id');
    }

    // Un producto pertenece a una unidad de medida
    public function unidadmedida()
    {
        return $this->belongsTo(UnidadMedida::class, 'unidadmedidas_id');
    }

    // Un producto pertenece a un estado (por ejemplo: activo, inactivo)
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estados_id');
    }
}
