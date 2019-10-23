<?php

use Illuminate\Database\Seeder;

class TasaIvaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasas_iva')->insert([
            'nombre' => 'Básica',
            'tasa' => 22
        ]);
        DB::table('tasas_iva')->insert([
            'nombre' => 'Mínimo',
            'tasa' => 10
        ]);
        DB::table('tasas_iva')->insert([
            'nombre' => 'Exento',
            'tasa' => 0
        ]);
    }
}
