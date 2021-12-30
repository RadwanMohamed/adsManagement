<?php

namespace App\Http\Controllers\Api\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagResquest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        return $this->showAll($tags);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagResquest $request)
    {
        $tag = Tag::create($request->validated());
        return $this->showOne($tag);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::find($id);
        if (!$tag)
            return $this->errorResponse("there is no data related to this indicator", 404);
        return $this->showOne($tag);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tag = Tag::find($id);
        if (!$tag)
            return $this->errorResponse("there is no data related to this indicator", 404);
        if ($request->has("title"))
            $tag->title = $request->title;
        if ($request->has("description"))
            $tag->description = $request->description;
        if ($tag->isClean())
            return $this->errorResponse("you must edit some data to complete update process", 422);
        $tag->save();
        return $this->showOne($tag);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        if (!$tag)
            return $this->errorResponse("there is no data related to this indicator", 404);
        $tag->delete();
        return $this->showMessage("the process completed successfully");
    }
}
