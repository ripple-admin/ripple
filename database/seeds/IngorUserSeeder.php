<?php

use Illuminate\Database\Seeder;
use Ingor\Models\User;

class IngorUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 3)->create();
    }
}
