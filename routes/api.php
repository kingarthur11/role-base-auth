<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserAuthAPIController;
use App\Http\Controllers\API\UserbrtAPIController;
use App\Http\Controllers\API\PermisionAPIController;
use App\Http\Controllers\API\PostAPIController;
use App\Http\Controllers\API\CommentAPIController;

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

Route::middleware(['auth:api', 'role:SuperAdmin' ])->group(function () {
    Route::get('/admin/dashboard', function () {
        return auth()->user()->roles;
        // return response()->json(['message' => 'Welcome to the admin dashboard']);
    });
    Route::get('/admin/users', function () {
        return auth()->user()->roles;
        // return response()->json(['message' => 'Here are the users']);
    });
});

// Route::middleware(['middleware' => ['role:SuperAdmin', 'auth:api']])->group(function () {

// });    

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return auth()->user()->roles;
//     return auth()->user()->roles->contains('name', 'SuperAdmin');
//     return $request->user();
// });


Route::controller(UserAuthAPIController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');

});

Route::middleware(['auth:api', 'role:SuperAdmin' ])->group(function () {
    Route::post('admin/add_permisions', [PermisionAPIController::class, 'storeRole']);
    Route::post('admin/add_roles', [PermisionAPIController::class, 'storePermission']);
    Route::post('admin/add_assign_permission', [PermisionAPIController::class, 'assignPermissionToRole']);
    Route::post('admin/add_assign_roles', [PermisionAPIController::class, 'assignRolesToUsers']);
});

Route::middleware(['auth:api', 'role:SuperAdmin,Admin,User' ])->group(function () {
    Route::post('/post/create', [PostAPIController::class, 'store']);
    Route::get('/post/{id}', [PostAPIController::class, 'show']);
    Route::get('/post', [PostAPIController::class, 'index']);
    Route::put('/post/{id}', [PostAPIController::class, 'update']);
    Route::delete('/post/{id}', [PostAPIController::class, 'destroy']);

    Route::post('/comments/create', [CommentAPIController::class, 'store']);
    Route::get('/comments/{id}', [CommentAPIController::class, 'show']);
    Route::get('/comments', [CommentAPIController::class, 'index']);
    Route::put('/comments/{id}', [CommentAPIController::class, 'update']);
    Route::delete('/comments/{id}', [CommentAPIController::class, 'destroy']);
});


Route::get( '/unauthenticated', [UserAuthAPIController::class, 'unauthenticated']);

