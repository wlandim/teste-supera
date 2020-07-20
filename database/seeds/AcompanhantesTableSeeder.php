<?php

use Illuminate\Database\Seeder;

class AcompanhantesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Acompanhante::class, 20)->create();
    }
}
