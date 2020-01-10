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
		DB::table('tipo_comprobantes')->insert([
			'nombre' => 'Factura de venta crédito',
		]);
		DB::table('tipo_comprobantes')->insert([
			'nombre' => 'Nota de crédito de venta',
		]);
		DB::table('tipo_comprobantes')->insert([
			'nombre' => 'Compra al contado',
		]);
		DB::table('tipo_comprobantes')->insert([
			'nombre' => 'Recibo de cobro',
		]);
	}
}
