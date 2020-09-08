<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\user;

class UserController extends Controller
{
    public function getUserByUserName(Request $request){
        $table = user::where("name",$request["name"])->get();
        return $this->respondWithJson($table,$table->count());
    }

    public function getFriend(Request $request){
        $table = user::whereRaw('FIND_IN_SET('.$request["id"].',id_friends)')->get();
        return $this->respondWithJson($table,$table->count());
    }

    public function addFriend(Request $request){
        try {
            $table = user::where('name',$request['name'])->get();
            $id_friends_name = $table[0]->id_friends;
            $id_name = $table[0]->id;

            $table = user::where('name',$request['my_name'])->get();
            $id_friends_my_name = $table[0]->id_friends;
            $id_myname = $table[0]->id;
        
            $table = user::where("name",$request['name'])->update(['id_friends'=>$id_friends_name.','.$id_myname]);
            $table = user::where("name",$request['my_name'])->update(['id_friends'=>$id_friends_my_name.','.$id_name]);
            echo "Successfully";
        } catch (Exception $e) {
             echo "can't make friends right now please try again later";
        }

    }

    public function findUser(Request $request){
        $strSearch=$request->strSearch;
        $id = $request->id;
        $table=user::where('name','like','%'.$strSearch.'%')->whereRaw('NOT FIND_IN_SET('.$id.',id_friends)')->get();
        return $this->respondWithJson($table,$table->count());
    }

    public function updateStatusAcount(Request $request){
        if($request->has("email")){
            $email = $request->email;
            $update = user::where("email",$email)->update(["status"=>1]);
            if($update){
                $table = user::where("email",$email)->get();
                $data=['status'=>'200','data'=>$table[0]];
                    echo json_encode($data);
            }
        }
    }

    public function register(Request $request)
    {
    	if($request->has('name') && $request->has('email') && $request->has('password')){
    		$name = $request->name;
    		$email = $request->email;
    		$password = $request->password;
    		if($name != null && $email != null && $password != null){
    			$table = new user();
    			$table->name = $name;
    			$table->email = $email;
    			$table->password = md5($password);
    			$table->token = Str::Random(60);
                $table->avatar='https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRDsanOS9e9oVDhhABGmoSHdjCkXnhfOyXMgg&usqp=CAU';
                $table->id_hierarchy=1;
                $table->status = 0;
                $table->id_hierarchy = "0";
    			$table->save();
                if($table){
                    echo "Susscess";
                }else{
                    echo "Account already exists";
                }
    			
    		}else{
    			echo "Erro Data";
    		}
    	}else{
    		echo "null send datta";
    	}
    }

    public function getData(){
        $table = user::all();
        return $this->respondWithJson($table,$table->count());
    }

    public function login(Request $request){
        if($request->has('name') && $request->has('password')){
            $name = $request->name;
            $password = $request->password;

            if($name != null && $password != null){
                $table = user::where([['email','=',$name],['password','=',md5($password)]])->get();
                if($table){
                    $data=['status'=>'200','data'=>$table[0]];
                    echo json_encode($data);
                }
            }else{
                echo "Data not null";
            }

        }else{
            echo "No send data";
        }
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
