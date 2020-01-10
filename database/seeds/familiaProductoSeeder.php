<?php

use Illuminate\Database\Seeder;

class familiaProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        DB::table('familia_productos')->insert([
            'nombre' => 'Productos de almacén',
        ]);
    }
}