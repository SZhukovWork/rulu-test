<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::post("/create");
Route::get("/get",[UserController::class, "getAll"]);
Route::get("/get/{id}", [UserController::class, "getById"])->where('id', '[0-9]+');
Route::patch("/update/{id}",[UserController::class, "update"])->where('id', '[0-9]+');
Route::post("/create",[UserController::class, "create"]);
Route::delete("/delete/{id}",[UserController::class, "delete"])->where('id', '[0-9]+');
