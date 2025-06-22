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

Route::group(["middleware" => "auth:api"], function () {
    //membuat endpoint roleList, dan memanggil controller role serta memanggil function(index)
    //yang di gunakan
    Route::get("/role/list", [RoleController::class, "index"]); //roleList

    Route::get("/user/list", [UserController::class, "index"]);

    Route::get("/item/list", [ItemController::class, "index"]);

    Route::get("/categoryItem/list", [CategoryController::class, "index"]);

    Route::get("/lost/list", [LostController::class, "index"]);

    Route::get("/found/list", [FoundController::class, "index"]);

    Route::get("/identity/list", [IdentityController::class, "index"]);

    Route::get("/pickup/list", [PickupController::class, "index"]);
});

Route::group(
    [
        "prefix" => "auth",
    ],
    function ($router) {
        Route::post("login", [AuthenticationController::class, "login"]);
        Route::post("logout", [AuthenticationController::class, "logout"]);
        Route::post("refresh", [AuthenticationController::class, "refresh"]);
        Route::post("me", [AuthenticationController::class, "me"]);
    }
);
