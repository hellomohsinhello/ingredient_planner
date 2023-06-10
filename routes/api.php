<?php

use App\Http\Controllers as Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


//// suppliers
//Route::apiResource('suppliers', Controllers\SupplierController::class);
//
////ingredients
//Route::apiResource('ingredients', Controllers\IngredientController::class);
//
////recipes
//Route::apiResource('recipes', Controllers\RecipeController::class);
//
// // boxes
//Route::apiResource('boxes', Controllers\BoxController::class);

// list ingredients
Route::get('ingredients', [Controllers\IngredientController::class, 'index']);

// Create an ingredient
Route::post('ingredients', [Controllers\IngredientController::class, 'store']);

// Create a recipe
Route::post('recipes', [Controllers\RecipeController::class, 'store']);

// List recipes
Route::get('recipes', [Controllers\RecipeController::class, 'index']);

// Create a box
Route::post('boxes', [Controllers\BoxController::class, 'store']);

// View the ingredients required to be ordered by the company
Route::get('ingredients/order', [Controllers\IngredientController::class, 'order']);
