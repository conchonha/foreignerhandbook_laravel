<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    //
     public function validBase64($string)
	{

		if (strpos($string, 'base64') !== false) {
		    return true;
		}

		return false;
    }
    public function addPostImage(Request $request){
           if ($request->avatarUrl) {
            // //delete old image.
            // $image_path_old = $user->avatarUrl;  
            // if(file_exists($image_path_old)) {
            //     @unlink($image_path_old);
            // }
            if (!file_exists(public_path('images'))) {
                mkdir(public_path('images'), 0777, true);
            }
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $uniqueid   = substr(str_shuffle($str_result), 0, 8);
            if( $this->validBase64($request->avatarUrl) ) {
                $data2 = $request->avatarUrl;
                if(isset($data2)){
                    $uniqueid = $uniqueid;
                    $folderpath=public_path().'/images/user';
                
                    list($type, $data2) = explode(';', $data2);
                    list(, $data2)      = explode(',', $data2);
                    $data2              = base64_decode($data2);
                    
                    $quickrfq_dir       = $folderpath.'/';
                    $file               = $quickrfq_dir . $uniqueid . '.png';
                    $filename           = $uniqueid . '.png';
                    file_put_contents($file, $data2);
                }
            } else{
                $file_exte = $request->avatarUrl->getClientOriginalExtension();
                $filename = date("Ymdhis") . '.' .$file_exte;        
                $request->avatarUrl->move('images/user', $filename);
            }
        }else{
            // $editUser['avatarUrl'] = $user->avatarUrl;
            $editUser['avatarUrl'] = 'Khong có ảnh';
        }
        if($filename){
            $editUser['avatarUrl'] = 'http://192.168.43.144:8080/foreignerhandbook_laravel/public/images/user/'.$filename;
        }
        // $user->update($editUser);
        return $this->respondData($editUser['avatarUrl']);
    }
      protected function respondData($data)
    {
        return response()->json([
          //  'statusCode' => 200,
         //   'errorMessage' => '',
            'path'=>$data,
          //  'total'=>count((array)$data),
        ]);
    }
}
