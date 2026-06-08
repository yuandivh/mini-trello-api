<?php

namespace App\Http\Controllers\Api\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Board;
use App\Http\Requests\Board\StoreBoardRequest;
use App\Http\Requests\Board\UpdateBoardRequest;

class BoardController extends Controller
{
    //
    public function index(Request $request, $workspace_id)
    {
        $workspace = $request->user()->workspaces()->find($workspace_id);

        if(!$workspace){
            return response()->json([
                'message'=>'Workspace not found'
            ],404);
        }
        $boards = $workspace->boards()->get();

        return response()->json([
            'message'=>'Boards retrieved successfully',
            'data'=>$boards
        ],200);

    }

    public function show (Request $request, $board_id)
    {
        $board = Board::where('id',$board_id)
        ->whereHas('workspace',function ($query) use ($request){
            $query->where('user_id',$request->user()->id);
        })->first();

        if (!$board)
        {
            return response()->json([
                'message'=>'Board not found'
            ],404);
        }
        return response()->json([
            'message'=>'Board retrieved successfully',
            'data'=>$board
        ],200);
    }

    public function store(StoreBoardRequest $request, $workspace_id)
    {
        $workspace = $request->user()->workspaces()->find($workspace_id);
        if(!$workspace){
            return response()->json([
                "message"=>"Workspace not found"
            ],404);
        }
        $board = $workspace->boards()->create($request->validated());


        return response()->json([
            "message"=>"Board created successfully",
            "data"=>$board
        ],201);
    }

    public function update(UpdateBoardRequest $request,$board_id)
    {
        $board = Board::where('id',$board_id)
        ->whereHas('workspace',function ($query) use ($request){
            $query->where('user_id',$request->user()->id);
        })->first();

        if(!$board)
        {
            return response()->json([
                "message"=>"Board not found"
            ],404);
        }
        $board->update([
            "name"=>$request->name
        ]);
        return response()->json([
            "message"=>"Board updated successfully",
            "data"=>$board
        ],200);
    }

    public function destroy(Request $request, $board_id)
    {
        $board = Board::where('id',$board_id)
        ->whereHas('workspace',function ($query) use ($request){
            $query->where('user_id',$request->user()->id);
        })->first();

        if(!$board){
            return response()->json([
                "message"=>"Board not found"
            ],404);
        }
        $board->delete();
        return response()->json([
            "message"=>"Board deleted successfully"
        ],200);
    }
}
