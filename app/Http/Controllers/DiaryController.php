<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\postsuser;

class DiaryController extends Controller
{
    //
     public function validBase64($string)
	{

		if (strpos($string, 'base64') !== false) {
		    return true;
		}

		return false;
    }
    public function add(Request $request, $id){
     //	$newpostuser[id] = (String) (string) Uuid::generate(4);
     	$newpostuser['id_user'] = $id;
     	$newpostuser['content'] = $request->input('content');
        $newpostuser['image'] = $request->input('image');
    	// $filename = '';
     //    if ($request->image) {
     //         //Kiem tra folder ton tai hong khi ban tao duong dan de luu file
     //        if (!file_exists(public_path('images'))) {
     //            mkdir(public_path('images'), 0777, true);
     //        }
     //        // String of all alphanumeric character và generate
     //        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
     //        $uniqueid   = substr(str_shuffle($str_result), 0, 8);
     //        if( $this->validBase64($request->image) ) {
     //            $data2 = $request->image;
     //            if(isset($data2)){
     //                $uniqueid = $uniqueid;
     //                $folderpath=public_path().'/images/user';
                
     //                list($type, $data2) = explode(';', $data2);
     //                list(, $data2)      = explode(',', $data2);
     //                $data2              = base64_decode($data2);
                    
     //                $quickrfq_dir       = $folderpath.'/';
     //                $file               = $quickrfq_dir . $uniqueid . '.png';
     //                $filename           = $uniqueid . '.png';
     //                file_put_contents($file, $data2);
     //            }
     //        } else{
     //            //tra ve ten cua file
     //            $file_exte = $request->image->getClientOriginalExtension();
     //            $filename = date("Ymdhis") . '.' .$file_exte;        
     //            $request->image->move('images/user', $filename);
     //        }
     //    }
     //    if($filename){
     //        $newpostuser['image'] = 'http://192.168.43.144:8080/foreignerhandbook_laravel/public/images/user/'.$filename;
     //    }
        if($newpostuser){
        	$data = postsuser::create($newpostuser);
        }
        return $this->respondData($data);

    }
     protected function respondData($data)
    {
        return response()->json([
            'statusCode' => 200,
            'errorMessage' => '',
            'data'=>$data,
            'total'=>count((array)$data),
        ], 200);
    }
}
