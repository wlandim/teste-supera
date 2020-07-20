<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([UsersTableSeeder::class]);
        $this->call([PacientesTableSeeder::class]);
        $this->call([AcompanhantesTableSeeder::class]);
        $this->call([ObitosTableSeeder::class]);
    }
}
