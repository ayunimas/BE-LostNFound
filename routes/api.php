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

Route::group(["middleware" => "jwt.verify"], function () {
    //membuat endpoint roleList, dan memanggil controller role serta memanggil function(index)
    //yang di gunakan
    Route::get("/role/list", [RoleController::class, "index"]); //roleList

    Route::get("/user/list", [UserController::class, "index"]);

    Route::get("/item/list", [ItemController::class, "index"]);

    Route::group(["prefix" => "lost"], function () {
        Route::get("list", [LostController::class, "index"]);
        Route::post("/", [LostController::class, "store"]);
        Route::get("/{id}", [LostController::class, "show"]);
        Route::put("/{id}", [LostController::class, "update"]);
    });

    Route::group(["prefix" => "categories"], function () {
        Route::get("list", [CategoryController::class, "index"]);
        Route::post("/", [CategoryController::class, "store"]);
        Route::put("{id}", [CategoryController::class, "update"]);
        Route::delete("{id}", [CategoryController::class, "destroy"]);
        Route::get("{id}", [CategoryController::class, "show"]);
    });

    Route::group(["prefix" => "found"], function () {
        Route::get("list", [FoundController::class, "index"]);
        Route::post("/store", [FoundController::class, "store"]);
        Route::get("/{id}", [FoundController::class, "show"]);
        Route::put("/{id}", [FoundController::class, "update"]);
    });

    Route::group(["prefix" => "identity"], function () {
        Route::get("list", [IdentityController::class, "index"]);
        Route::post("store", [IdentityController::class, "store"]);
        Route::get("{id}", [IdentityController::class, "show"]);
        Route::delete("{id}", [IdentityController::class, "destory"]);
        Route::post("{id}/update", [IdentityController::class, "update"]);
    });

    Route::group(["prefix" => "pickup"], function () {
        Route::get("list", [PickupController::class, "index"]);
        Route::post("store", [PickupController::class, "store"]);
        Route::get("{id}", [PickupController::class, "show"]);
        Route::put("{id}", [PickupController::class, "update"]);
        Route::put("{id}/status", [PickupController::class, "updateStatus"]);
    });
});

Route::group(
    [
        "prefix" => "auth",
    ],
    function ($router) {
        Route::post("register", [AuthenticationController::class, "register"]);
        Route::post("login", [AuthenticationController::class, "login"]);
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
        );
    }
);
