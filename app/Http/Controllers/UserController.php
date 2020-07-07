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
    			$table->password = Hash::make($password);
    			$table->token = Str::Random(60);
    			$table->save();
    			echo "Sussces";
    		}else{
    			echo "datta null";
    		}
    	}else{
    		echo "null send datta";
    	}
    }

    public function getData(){
        $table = user::all();
        echo json_encode($table);
    }
}
