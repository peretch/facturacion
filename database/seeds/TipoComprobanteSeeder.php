<?php

use Illuminate\Database\Seeder;

class TipoComprobanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_comprobantes')->insert([
			'nombre' => 'Venta al contado',
		]);
    	DB::table('tipo_comprobantes')->insert([
			'nombre' => 'Devolución al contado',
		]);
    }
}
