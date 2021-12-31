<?php

namespace App\Http\Controllers\Api\Advertiser;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdvertiserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advertisers = User::all();
        return  $this->showAll($advertisers);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $advertiser = User::where("id",$id)->with("ads")->first();
        if (!$advertiser)
            return $this->errorResponse("there is no data related to this indicator",404);
        return  $this->showOne($advertiser);
    }


}
