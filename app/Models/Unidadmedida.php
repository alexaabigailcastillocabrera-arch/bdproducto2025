<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidadmedida extends Model
{
    use HasFactory;

    protected $table = 'unidadmedidas'; //nombre real de la tabla
    protected $fillable = ['nombre_unidad'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
