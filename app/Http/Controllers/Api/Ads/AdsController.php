<?php

namespace App\Http\Controllers\Api\Ads;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdsResquest;
use App\Models\Ads;
use Illuminate\Http\Request;

class AdsController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdsResquest $resquest)
    {
        $ads = Ads::select('*');
        if ($resquest->has("category_id"))
            $ads = $ads->where("category_id",$resquest->category_id);
        if ($resquest->has("tag_id"))
            $ads = $ads->whereHas("tags",function($q) use($resquest){
               return $q->where("tag_id",$resquest->tag_id);
            });
        if ($resquest->has("advertiser_id"))
            $ads = $ads->where("advertiser_id",$resquest->advertiser_id);
        $ads = $ads->get();
        return  $this->showAll($ads);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdsResquest $request)
    {
        $ads= Ads::create($request->validated());
        $ads->tags()->sync($request->tags);
        return $this->showOne($ads);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ads = Ads::where("id",$id)->with(["tags","advertiser","category"])->first();
        if (!$ads)
            return  $this->errorResponse("there is no data related to this indicator",404);
        return  $this->showOne($ads);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ads = Ads::find($id);
        if (!$ads)
            return  $this->errorResponse("there is no data related to this indicator",404);
        if ($request->has("title"))
            $ads->title = $request->title;
        if ($request->has("description"))
            $ads->description = $request->description;
        if ($request->has("advertiser_id"))
            $ads->advertiser_id = $request->advertiser_id;
        if ($request->has("start_date"))
            $ads->start_date = $request->start_date;
        if ($request->has("type"))
            $ads->type = $request->type;
        if ($request->has("category_id"))
            $ads->category_id = $request->category_id;
        if ($request->has("tags"))
            $ads->tags()->sync($request->tags);
        $ads->save();
        return  $this->showOne($ads);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ads = Ads::find($id);
        if (!$ads)
            return  $this->errorResponse("there is no data related to this indicator",404);
        $ads->delete();
        return $this->showMessage("the process completed successfully");
    }
}
