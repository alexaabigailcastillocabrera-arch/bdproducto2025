<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('estados')->insert([
            ['nombre' => 'disponible', 'descripcion' => 'Producto en stock y disponible para la venta'],
            ['nombre' => 'agotado', 'descripcion' => 'Producto temporalmente sin stock'],
            ['nombre' => 'descontinuado', 'descripcion' => 'Producto que ya no se fabrica o distribuye'],
            ['nombre' => 'revision', 'descripcion' => 'Producto en revisión o evaluación de calidad'],
            ['nombre' => 'danado', 'descripcion' => 'Producto defectuoso o no apto para venta'],
        ]);
    }
}
