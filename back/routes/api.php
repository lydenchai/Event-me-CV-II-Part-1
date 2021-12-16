<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MyeventController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\JoinController;
use App\Http\Controllers\CategoryController;

// Get user
Route::get('/user', [UserController::class, 'index']);

// PUBLIC ROUTE
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

// Category
Route::get('/category', [CategoryController::class, 'index']);
Route::get('/category/{id}', [CategoryController::class, 'show']);
Route::get('/category/search/{id}', [CategoryController::class ,'search']);

Route::post('/category', [CategoryController::class, 'store']);
Route::put('/category/{id}', [CategoryController::class, 'update']);
Route::delete('/category/{id}', [CategoryController::class, 'destroy']);

// My event
Route::get('/myevents', [MyeventController::class, 'index']);
Route::get('/myevents/{id}', [MyeventController::class, 'show']);
Route::post('/myevents', [MyeventController::class, 'store']);
Route::delete('/myevents/{id}', [MyeventController::class, 'destroy']);
Route::put('/myevents/{id}', [MyeventController::class, 'update']);
Route::get('/myevents/search/{title}', [MyeventController::class, 'search']);
Route::get('/myevents/searchCity/{city}', [MyeventController::class, 'searchCity']);

// Country
Route::get('countries', [CountryController::class, 'getCountries']);

// Join 
Route::get('/joins', [JoinController::class, 'getJoins']);
Route::post('/joins', [JoinController::class, 'store']);
Route::delete('/joins/{id}', [JoinController::class, 'delete']);