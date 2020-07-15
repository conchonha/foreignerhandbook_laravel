<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\menu;

class MenuController extends Controller
{
    function getDataMenuTop(){
    	$table = menu::where('id_table','=',0)->get();
    	$data=['status'=>'200',"data"=>$table];
    	echo json_encode($data);
    }

    function getDataMenuBottom(){
    	$table = menu::where('id_table','=',1)->get();
    	$data=['status'=>'200','data'=>$table];
    	echo json_encode($data);
    }
}
