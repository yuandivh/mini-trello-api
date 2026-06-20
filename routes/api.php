<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Workspace\WorkspaceController;
use App\Http\Controllers\Api\Board\BoardController;
use App\Http\Controllers\Api\BoardList\BoardListController;
use App\Http\Controllers\Api\Card\CardController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');

    // Workspace API
    Route::get('/workspaces',[WorkspaceController::class,'index']);
    Route::get('/workspaces/{workspace_id}',[WorkspaceController::class,'show']);
    Route::post('/workspaces',[WorkspaceController::class,'store']);
    Route::put('/workspaces/{workspace_id}',[WorkspaceController::class,'update']);
    Route::delete('/workspaces/{workspace_id}',[WorkspaceController::class,'destroy']);

    // Board API
    Route::get('/workspaces/{workspace_id}/boards',[BoardController::class,'index']);
    Route::get('/boards/{board_id}',[BoardController::class,'show']);
    Route::post('/workspaces/{workspace_id}/boards',[BoardController::class,'store']);
    Route::put('/boards/{board_id}',[BoardController::class,'update']);
    Route::delete('/boards/{board_id}',[BoardController::class,'destroy']);

    // Board list API
    Route::get('/boards/{board_id}/lists',[BoardListController::class,'index']);
    Route::get('/lists/{board_list_id}',[BoardListController::class,'show']);
    Route::post('/boards/{board_id}/lists',[BoardListController::class,'store']);
    Route::put('/lists/{board_list_id}',[BoardListController::class,'update']);
    Route::delete('/lists/{board_list_id}',[BoardListController::class,'destroy']);

    // Card API
    Route::get('/lists/{board_list_id}/card',[CardController::class,'index']);
    Route::get('/card/{card_id}',[CardController::class,'show']);
    Route::post('/lists/{board_list_id}/card',[CardController::class,'store']);
    Route::put('/card/{card_id}',[CardController::class,'update']);
    Route::delete('/card/{card_id}',[CardController::class,'destroy']);

});
