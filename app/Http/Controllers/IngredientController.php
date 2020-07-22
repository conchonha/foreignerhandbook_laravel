<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ingredient;

class IngredientController extends Controller
{
	public function getData($id){
		$table = ingredient::where('ingredient.id_menu','=',$id)->get();
		if($table){
			$data=['status'=>'200','data'=>$table];
			echo json_encode($data);
		}
	}
    
}
