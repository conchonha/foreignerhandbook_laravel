<?php

use Illuminate\Database\Seeder;

class seeder_menu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$icon = "https://w7.pngwing.com/pngs/583/387/png-transparent-camera-icon-design-icon-camera-camera-lens-rectangle-photography.png";

        DB::table('Menu')->insert([
        	['name' => 'Destination', 'icons'=> $icon, 'id_table'=> 0],
        ]);
    }
}
