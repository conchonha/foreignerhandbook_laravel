<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\event;

class EvenController extends Controller
{
    function getDataEventRanDom(){
    $table = event::select('event.id','event.name','event.image')->orderBy('event.id','desc')->take(7)->get();
    $data=['status'=>'200','data'=>$table];
    echo json_encode($data);
	}
}
