<?php

use Illuminate\Database\Seeder;

class user_seeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->insert([
			'name' => 'Administrador',
			'email' => 'dios',
			'password' => bcrypt('mil@nes@'),
		]);
		DB::table('preferencias')->insert([
			'usuario_id' => 1,
			'estilo' => 'css/style_dark.css'
		]);
		DB::table('users')->insert([
			'name' => 'Usuario_1',
			'email' => 'usuario1',
			'password' => bcrypt('usuario1'),
		]);
		DB::table('preferencias')->insert([
			'usuario_id' => 2,
		]);
	}
}
