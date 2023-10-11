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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// http://127.0.0.1:8000/api/posts
Route::get('/posts', function () {
    return response()->json(
        [
            'posts' => [
                [
                    'id' => 1,
                    'name' => 'Mina',
                ],
                [
                    'id' => 2,
                    'name' => 'Emad',
                ]
            ]
        ],
        200,
        // $headers
    );
})->scopeBindings();
