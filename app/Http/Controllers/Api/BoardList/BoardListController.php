<?php

namespace App\Http\Controllers\Api\BoardList;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\BoardList;
use App\Http\Requests\BoardList\StoreBoardListRequest;
use App\Http\Requests\BoardList\UpdateBoardListRequest;

class BoardListController extends Controller
{
    //
    public function index(Request $request, $board_id){
        $board = Board::with('workspace')->find($board_id);
        if(!$board){
            return response()->json([
                "message"=>"Board not found"
            ],404);
        }

        $this->authorize('view',$board);

        $boardLists = $board->boardLists()->get();

        return response()->json([
            "message"=>"Board lists retrieved successfully",
            "data"=>$boardLists
        ],200);
    }

    public function show(Request $request, $board_list_id){
        $boardList = BoardList::with('board.workspace')->find($board_list_id);
        if(!$boardList){
            return response()->json([
                "message"=>"Board list not found"
            ],404);
        }
        $this->authorize('view',$boardList);
        return response()->json([
            "message"=>"Board list retrieved successfully",
            "data"=>$boardList
        ],200);
    }

    public function store(StoreBoardListRequest $request, $board_id){
        $board = Board::with('workspace')->find($board_id);
        if (!$board){
            return response()->json([
                "message"=>"Board not found"
            ],404);
        }

        $this->authorize('view',$board);

        $boardList = $board->boardLists()->create([
            "name"=>$request->name
        ]);

        return response()->json([
            "message"=>"Board list created successfully",
            "data"=>$boardList
        ],201);
    }

    public function update(UpdateBoardListRequest $request, $board_list_id){
        $boardList = BoardList::with('board.workspace')->find($board_list_id);
        if(!$boardList){
            return response()->json([
                "message"=>"Board list not found"
            ],404);
        }

        $this->authorize('update',$boardList);

        $boardList->update([
            "name"=>$request->name,
            "order"=>$request->order ?? $boardList->order,
        ]);

        return response()->json([
            "message"=>"Board list updated successfully",
            "data"=>$boardList
        ],200);
    }

    public function destroy(Request $request, $board_list_id){
        $boardList = BoardList::with('board.workspace')->find($board_list_id);

        if(!$boardList){
            return response()->json([
                "message"=>"Board list not found"
            ],404);
        }

        $this->authorize('delete',$boardList);

        $boardList->delete();

        return response()->json([
            "message"=>"Board list deleted successfully",
        ],200);
    }


}
