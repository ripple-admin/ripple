<?php

use Illuminate\Database\Seeder;

class IngorDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(IngorUserSeeder::class);
    }
}
