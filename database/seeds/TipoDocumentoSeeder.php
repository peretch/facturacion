<?php

use Illuminate\Database\Seeder;

class TipoDocumentoSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('tipos_documento')->insert([
			'tipo_documento' => 'CI',
		]);
		DB::table('tipos_documento')->insert([
			'tipo_documento' => 'Pasaporte',
		]);		
	}
}
