<?php

use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(familiaProductoSeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(ClienteSeeder::class);
    }
}
