<?php

namespace App\Http\Controllers\Api\Ads;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Ads;
use Illuminate\Http\Request;

class AdsAdvertiserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Ads  $ad)
    {
        $adv = $ad->advertiser;
        return  $this->showOne($adv);
    }
}
