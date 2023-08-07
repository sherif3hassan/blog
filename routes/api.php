<?php

use Illuminate\Http\Request;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::apiResource('posts', PostController::class);
// guard route apiresource using jwt
// Route::apiResource('users', 'UsersController');
// Verb         Path                       Action Route Name
// GET          /users                     index  users.index
// POST         /users                     store  users.store
// GET          /users/{user}              show   users.show
// PUT|PATCH    /users/{user}              update users.update
// DELETE       /users/{user}              destroy users.destroy
Route::group(['middleware' => ['auth:api']], function () {
    Route::apiResource('posts', PostController::class);
    // Route::put('/posts/{post}', [PostController::class, 'update']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


// Route::post('/posts', [PostController::class, 'store']);
// Route::put('/posts/{id}', [PostController::class, 'update']);
// Route::delete('/posts/{id}', [PostController::class, 'destroy']);
