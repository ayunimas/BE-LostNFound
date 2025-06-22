<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LostController;
use App\Http\Controllers\FoundController;
use App\Http\Controllers\IdentityController;
use App\Http\Controllers\PickupController;
use App\Http\Controllers\AuthenticationController;


//membuat endpoint roleList, dan memanggil controller role serta memanggil function(index) 
//yang di gunakan 
Route::get('/role/list',[RoleController::class, 'index'])->middleware(['auth:sanctum']); //roleList

Route::get('/user/list',[UserController::class, 'index']);

Route::get('/item/list',[ItemController::class, 'index']);

Route::get('/categoryItem/list',[CategoryController::class, 'index']);

Route::get('/lost/list',[LostController::class, 'index']);

Route::get('/found/list',[FoundController::class, 'index']);

Route::get('/identity/list',[IdentityController::class, 'index']);

Route::get('/pickup/list',[PickupController::class, 'index']);

Route::post('/login',[AuthenticationController::class, 'login']);