<?php

use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('clientes')->insert([
			'nombre' => 'ZALAYETA S.A.',
			'empresa' => 1,
			'rut' => '827311221933',
			'mail' => 'contacto@jojovo.com.es',
			'direccion' => 'Libertad 2391',            
			'telefono' => '23039314',            
		]);
		DB::table('clientes')->insert([
			'nombre' => 'Andrés',
			'apellido' => 'Suárez',		
			'tipo_documento' => 1,
			'mail' => 'andsuarez22@peretch.com',
			'direccion' => '21 de Septiembre 551 Apto. 205',            
			'telefono' => '099523412',
			'genero' => 'm',
		]);
		DB::table('clientes')->insert([
			'nombre' => 'Sofía',
			'apellido' => 'Henderson',		
			'tipo_documento' => 1,
			'mail' => 'andsuarez22@peretch.com',
			'direccion' => 'Rambla Gandhi 292. Apto. 1301',            
			'telefono' => '097612221',
			'genero' => 'f',
		]);
		DB::table('clientes')->insert([
			'nombre' => 'Cartagena S.R.L.',
			'empresa' => 1,
			'rut' => '210984000312',
			'mail' => 'contacto@cartagena.uy',
			'direccion' => 'Av. Italia 2588',
			'telefono' => '25078293',
		]);
		DB::table('clientes')->insert([
			'nombre' => 'AMV',
			'empresa' => 1,
			'rut' => '782323123234',
			'mail' => 'msantos@AMV.com.uy',
			'direccion' => 'Lorenzo Carneli 221',
			'telefono' => '24185542',
		]);
	}
}
