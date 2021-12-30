<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryResquest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return  $this->showAll($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryResquest  $request)
    {
        $category = Category::create($request->validated());
        return  $this->showOne($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        if (!$category)
            return  $this->errorResponse("there is no data related to this indicator",404);
        return $this->showOne($category);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryResquest $request, $id)
    {
        $category = Category::find($id);
        if (!$category)
            return  $this->errorResponse("there is no data related to this indicator",404);
        if ($request->has("title"))
            $category->title = $request->title;
        if ($request->has("description"))
            $category->description = $request->description;
        if ($category->isClean())
            return  $this->errorResponse("you must edit some data to complete update process",422);
        $category->save();
        return  $this->showOne($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category)
            return  $this->errorResponse("there is no data related to this indicator",404);
        $category->delete();
        return $this->showMessage("the process completed successfully");
    }
}
