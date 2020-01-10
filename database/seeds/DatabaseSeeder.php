<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(user_seeder::class);
        $this->call(TasaIvaSeeder::class);
        $this->call(MonedaSeeder::class);
        $this->call(TipoDocumentoSeeder::class);
        $this->call(TipoComprobanteSeeder::class);
    }
}
