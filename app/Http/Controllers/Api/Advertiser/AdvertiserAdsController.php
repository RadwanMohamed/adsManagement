<?php

namespace App\Http\Controllers\Api\Advertiser;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdvertiserAdsController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $advertiser)
    {
        $ads = $advertiser->ads;
        return $this->showAll($ads);
    }
}
