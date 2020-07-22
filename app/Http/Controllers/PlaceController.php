<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\place;

class PlaceController extends Controller
{
	public function getDataPlaceIdPlace(Request $request){
		$id = $request->id;
		if($id != null){
			$table = place::all();
			$data=['status'=>'200','data'=>$table];
			echo json_encode($data);
		}
	}

	public function getDataPlaceHomeRandom(Request $request){
		$test = $request->check;
		$id = $request->id;
		if($test == "0"){
			if($id != null){
				$count = place::join('ingredient','place.id_ingredient','=','ingredient.id')->where('ingredient.id_menu','=',$id)->count();
				if($count > 7){
					$table = place::select('place.id','place.name','place.image')->join('ingredient','place.id_ingredient','=','ingredient.id')->where('ingredient.id_menu','=',$id)->get()->random(7);
				}else{
					$table = place::select('place.id','place.name','place.image')->join('ingredient','place.id_ingredient','=','ingredient.id')->where('ingredient.id_menu','=',$id)->orderBy('ingredient.id','desc')->get();
				}
				$data=['status'=>'200','data'=>$table];
				echo json_encode($data);
			}
		}else{
			if($id != null){
				$count = place::join('ingredient','place.id_ingredient','=','ingredient.id')->where('ingredient.id','=',$id)->count();
				if($count > 7){
					$table = place::select('place.id','place.name','place.image')->join('ingredient','place.id_ingredient','=','ingredient.id')->where('ingredient.id','=',$id)->get()->random(7);
				}else{
					$table = place::select('place.id','place.name','place.image')->join('ingredient','place.id_ingredient','=','ingredient.id')->where('ingredient.id','=',$id)->orderBy('ingredient.id','desc')->get();
				}
				$data=['status'=>'200','data'=>$table];
				echo json_encode($data);
			}
		}	
	}

	public function getDataPlaceIdIngredient(Request $request){
		$id = $request->id;
		$table = place::select('place.id','place.name','place.image','place.introduce')->where('place.id_ingredient','=',$id)->orderBy('place.id','desc')->get();
		$data=['status'=>'200','data'=>$table];
				echo json_encode($data);
	}

	public function getDataImageHomeRandom(){
		$count = place::count();
		$table = place::select('place.id','place.image')->orderBy('place.id','desc')->get();
		$data=['status'=>'200','data'=>$table];
		echo json_encode($data);
	}
    
}
