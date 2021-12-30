<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::resource("categories",\App\Http\Controllers\Api\Category\CategoryController::class)->except(['edit','create']);
Route::resource("tags",\App\Http\Controllers\Api\Tag\TagController::class)->except(['edit','create']);
Route::resource("ads",\App\Http\Controllers\Api\Ads\AdsController::class)->except(['edit','create']);
