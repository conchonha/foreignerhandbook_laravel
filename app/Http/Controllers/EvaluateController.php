<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\evaluate;
use App\user;

class EvaluateController extends Controller
{
    function getDataEvaluateIdPlace(Request $request){
        $id = $request->id;

        $evaluate = evaluate::select('evaluates.id','evaluates.id_user','evaluates.id_place','evaluates.comment','evaluates.rating','evaluates.like','evaluates.created_at','evaluates.updated_at','acount.name','acount.avatar')->join('acount','acount.id','=','evaluates.id_user')->where('evaluates.id_place',$id)->get();

        return $this->respondWithJson($evaluate,$evaluate->count());
    }
    function postLikePlace(Request $request){
    	$id_user = $request->id_user;
    	$id_place = $request->id_place;
    	$comment = $request->comment;
    	$rating = $request->rating;
    	$like = $request->like;

    	$count = evaluate::where([['evaluates.id_place',$id_place],['evaluates.id_user',$id_user]])->count();
    	if($count > 0){
    		$table = evaluate::where([['evaluates.id_place',$id_place],['evaluates.id_user',$id_user]])->get();
    		$numberLike = $table[0]->like;
    		$table = evaluate::where([['evaluates.id_place',$id_place],['evaluates.id_user',$id_user]])->update(['comment'=>$comment,'rating'=>$rating,'like'=>$numberLike ==0 ? 1 : 0]);
            $likemoi = $numberLike ==0 ? 1 : 0;
    		echo $likemoi;
    	}else{
    		$table = new evaluate();
    		$table->id_user=$id_user;
    		$table->id_place=$id_place;
    		$table->comment=$comment;
    		$table->rating=$rating;
    		$table->like=$like;
    		$table->save();
    		echo $like;
    	}
    }

    public function respondWithJson($data,$total)
    {
        return response()->json([
            'message' => 'Successfully',
            'statuscode' => '200',
            'totalEvaluate' => $total,
            'dataEvaluate' => $data,
        ]);
    }
    
}
