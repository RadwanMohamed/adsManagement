<?php

namespace App\Traits;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * displys the json response message
 *
 */
trait ApiResponser
{
    private function successResponse($data,$code)
    {
        return response()->json($data,$code);
    }
    protected  function errorResponse($message,$code)
    {
        return response()->json(["status"=>false,"message"=>"error",'error'=>$message,'code'=>$code],$code);
    }

    protected function showAll( $collection ,$message="", $code =200)
    {
        return $this->successResponse(["status"=>true,"message"=>$message,"data"=>$collection],$code);
    }
    protected function showOne($model ,$message='' , $code =200)
    {
        return $this->successResponse(["status"=>true,"message"=>$message,"data"=>$model],$code);
    }
    protected function showMessage($message , $code =200)
    {
        return $this->successResponse(["status"=>true,"message"=>$message,],$code);
    }
}
