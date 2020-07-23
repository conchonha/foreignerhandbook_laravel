<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\evaluate;
use App\user;

class EvaluateController extends Controller
{
    function postLikePlace(Request $request){
    	$id_user = $request->id_user;
    	$id_place = $request->id_place;
    	$comment = $request->comment;
    	$rating = $request->rating;
    	$like = $request->like;

    	$count = evaluate::where('evaluate.id_place','=',$id_place)->count();
    	if($count > 0){
    		$table = evaluate::where('evaluate.id_place','=',$id_place)->get();
    		$numberLike = $table[0]->like;
    		$table = evaluate::where('evaluate.id_place','=',$id_place)->update(['comment'=>$comment,'rating'=>$rating,'like'=>$like]);
    		echo "success";
    	}else{
    		$table = new evaluate();
    		$table->id_user=$id_user;
    		$table->id_place=$id_place;
    		$table->comment=$comment;
    		$table->rating=$rating;
    		$table->like=$like;
    		$table->save();
    		echo "success";
    	}
    }
    
}
