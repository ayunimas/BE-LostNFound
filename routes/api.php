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

Route::group(["middleware" => ["jwt.verify", "checkRole:satpam"]], function () {
    //membuat endpoint roleList, dan memanggil controller role serta memanggil function(index)
    //yang di gunakan
    Route::get("/role/list", [RoleController::class, "index"]); //enpoint role list
    Route::get("/user/list", [UserController::class, "index"]); //endpoint user list
    //Route::get("/item/list", [ItemController::class, "index"]);
    Route::group(["prefix" => "categories"], function () {
        Route::get("list", [CategoryController::class, "index"]); //endpoint category item list
        Route::post("/store", [CategoryController::class, "store"]); //endpoint create category item
        Route::put("{id}", [CategoryController::class, "update"]); //enspoint update category item
        Route::delete("{id}", [CategoryController::class, "destroy"]); //endpoint delete category item
        Route::get("{id}", [CategoryController::class, "show"]); //endpoint show detail category item
    });

    Route::group(["prefix" => "pickup"], function () {
        Route::get("list", [PickupController::class, "index"]); //endpoint pickup list
        Route::post("store", [PickupController::class, "store"]); //endpoint create pickup req
        Route::get("{id}", [PickupController::class, "show"]); //endpoint show detail pickupreq
        //Route::put("{id}", [PickupController::class, "update"]); 
        Route::put("{id}/status", [PickupController::class, "updateStatus"]); //enpoint updateStatus
    });
});

Route::group(["middleware" => "jwt.verify"], function () {

    Route::group(["prefix" => "lost"], function () {
        Route::get("list", [LostController::class, "index"]); //endpoint lost list
        Route::post("/store", [LostController::class, "store"]); //endpoint create lost
        Route::get("/{id}", [LostController::class, "show"]); //endpoint show detail lost
        //Route::put("/{id}", [LostController::class, "update"]);
    });

    Route::group(["prefix" => "found"], function () {
        Route::get("list", [FoundController::class, "index"]); //endpoint found list
        Route::post("/store", [FoundController::class, "store"]); //endpoint create found
        Route::get("/{id}", [FoundController::class, "show"]); //endpoint show detail found
        //Route::put("/{id}", [FoundController::class, "update"]);
    });

    /*Route::group(["prefix" => "identity"], function () {
        Route::get("list", [IdentityController::class, "index"]);
        Route::post("store", [IdentityController::class, "store"]);
        Route::get("{id}", [IdentityController::class, "show"]);
        Route::delete("{id}", [IdentityController::class, "destory"]);
        Route::post("{id}/update", [IdentityController::class, "update"]);
    });*/
    
});

Route::group(
    [
        "prefix" => "auth",
    ],
    function ($router) {
        Route::post("register", [AuthenticationController::class, "register"]); //endpoint register
        Route::post("login", [AuthenticationController::class, "login"]); //endpoint login
        Route::post("logout", [
            AuthenticationController::class,
            "logout",
        ])->middleware("jwt.verify");
        Route::post("refresh", [
            AuthenticationController::class,
            "refresh",
        ])->middleware("jwt.verify");
        Route::post("me", [AuthenticationController::class, "me"])->middleware(
            "jwt.verify"
        ); //endpoint logout
    }
);
