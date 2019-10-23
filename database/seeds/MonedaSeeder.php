<?php

use Illuminate\Database\Seeder;

class MonedaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('monedas')->insert([
            'nombre' => 'Pesos UY',
            'simbolo' => '$',
            'redondeo' => 0
        ]);

        DB::table('monedas')->insert([
            'nombre' => 'Dólares',
            'simbolo' => 'U$S',
            'redondeo' => 2            
        ]);
    }
}
