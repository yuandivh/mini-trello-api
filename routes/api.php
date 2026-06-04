<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Workspace\WorkspaceController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');

    Route::get('/workspaces',[WorkspaceController::class,'index']);
    Route::get('/workspaces/{workspace_id}',[WorkspaceController::class,'show']);
    Route::post('/workspaces',[WorkspaceController::class,'store']);
    Route::put('/workspaces/{workspace_id}',[WorkspaceController::class,'update']);
    Route::delete('/workspaces/{workspace_id}',[WorkspaceController::class,'destroy']);
});
