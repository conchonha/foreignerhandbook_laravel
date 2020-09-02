<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\event;

class EvenController extends Controller
{
   public function getDataEventRanDom(){
   		 $table = event::select('event.id','event.name','event.image','event.created_at','event.updated_at')->orderBy('event.id','desc')->take(7)->get();
    
   		return $this->respondWithJson($table,$table->count());
	}

   public function getDataEventIdEvent(Request $request){
        $id = $request->id;
        $table = event::where('id',$id)->get();
        return $this->respondWithJson($table,$table->count());
    }

    public function getListEvent(){
        $table = event::select('event.id','event.name','event.image','event.updated_at')->orderBy('id','desc')->get();
        return $this->respondWithJson($table,$table->count());
    }

	public function respondWithJson($data,$total)
    {
        return response()->json([
            'message' => 'Successfully',
            'statuscode' => '200',
            'total' => $total,
            'data' => $data,
        ]);
    }
}
