<?php

use Illuminate\Database\Seeder;

class seeder_ingredient extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Ingredient')->insert([
        	['name'=> 'Nature', 'id_menu'=> 1,]
        ]);

    }
}
