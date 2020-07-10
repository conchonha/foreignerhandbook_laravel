<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\menu;

class MenuController extends Controller
{
    function getDataMenuTop(){
    	$table = menu::where('id_table','=',0)->get();
    	echo json_encode($table);
    }
}
