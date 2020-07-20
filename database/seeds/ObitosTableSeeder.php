<?php

use Illuminate\Database\Seeder;

class ObitosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Obito::class, 20)->create();
    }
}
