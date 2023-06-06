<?php

namespace App\Trait;

trait Response{
    public function success($msg, $status_code, $data){
        return response()->json([
            'message' => $msg,
            'status_code' => $status_code,
            'data'  => $data,
        ]);      
    }

    public function error($msg, $status_code, $data){
        return response()->json([
            'message' => $msg,
            'status_code' => $status_code,
            'data'  => $data,
        ]);      
    }
}

?>