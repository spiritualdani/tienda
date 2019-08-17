<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon; 

class Helper extends Model
{
       //
    public static function getToken()
    {
    	$fecha = Carbon::now()->toDateTimeString();

    	$fecha = str_replace(':', '_', $fecha); 
    	$fecha = str_replace(' ','',$fecha); 

 		return $fecha;
    }


    public static function saveImage($file, $folder, $product_id)
    {	
    	$name = 'img_'.$product_id.'_'.self::getToken().'.'.$file->getClientOriginalExtension();

    	//funcion laravel nos va a situar en la carpeta public 
    	$path = public_path().'/img/'.$folder; 

    	$file -> move($path, $name); 
    
    	return $name; 
    }

    public static function deleteImage($name, $folder)
    {
        // numero de caracteres de una cadena $name    
        if(strlen($name)>0){
            $path = public_path().'/img/'.$folder.'/'.$name;
            if(file_exists($path)){
                unlink($path);
            }

        }

        return true; 
    }
}
