<?php

namespace App\Helpers;

use Illuminate\Http\Response;

class Converter {
    public static function handleResponse($message, $errorMessage, $data){
        $isValid = true;
        
        if($data == null)
        {
            $isValid = false;
        }
        else if(count((is_countable($data) ? $data : [])) == 0)
        {
            $data = array($data);
            $isValid = count($data) > 0;
        }

        return response()->json([
            'status'    => $isValid    ?   Response::HTTP_OK   : 404 ,
            'message'   => $isValid    ?   $message            : $errorMessage,
            'data'      => $data
        ]);

    }
}