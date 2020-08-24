<?php

use Illuminate\Database\Seeder;

class LocalGovernmentAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\LocalGovernmentArea::class, 30)->create();
    }
}
