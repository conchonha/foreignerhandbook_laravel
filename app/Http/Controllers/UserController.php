<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\user;

class UserController extends Controller
{
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
        $table = user::all()->t;
        echo json_encode($table);
    }

    public function login(Request $request){
        if($request->has('name') && $request->has('password')){
            $name = $request->name;
            $password = $request->password;

            if($name != null && $password != null){

                $table = user::where([['name','=',$name],['password','=',md5($password)]])->get();
                if($table){
                    echo json_encode($table[0]);
                }else{
                    echo "Account already exists";
                }

            }else{
                echo "Data not null";
            }

        }else{
            echo "No send data";
        }
    }

}
