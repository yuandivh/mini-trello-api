<?php

namespace App\Http\Controllers\Api\Card;

use App\Http\Controllers\Controller;
use App\Http\Requests\Card\StoreCardRequest;
use App\Http\Requests\Card\UpdateCardRequest;
use Illuminate\Http\Request;
use App\Models\BoardList;
use App\Models\Card;

class CardController extends Controller
{
    //
    public function index(Request $request, $board_list_id){
        $boardList = BoardList::with('board.workspace')->find($board_list_id);

        if(!$boardList){
            return response()->json([
                "message"=>"Board list not found"
            ],404);
        }

        $this->authorize('view',$boardList);

        $card = $boardList->cards()->get();

        return response()->json([
            "messsage"=>"Card retrieved successfully",
            "data" => $card
        ],200);
    }

    public function show(Request $request, $card_id){
        $card = Card::with('boardList.board.workspace')->find($card_id);
        if(!$card){
            return response()->json([
                "message"=>"Card not found"
            ],404);
        }

        $this->authorize('view',$card);

        return response()->json([
            "message"=>"Card retrieved successfully",
            "data" => $card
        ],200);
    }

    public function store (StoreCardRequest $request,$board_list_id){
        $boardList = BoardList::with('board.workspace')->find($board_list_id);

        if(!$boardList){
            return response()->json([
                "message"=>"Board list not found"
            ],404);
        }

        $this->authorize('createCard',$boardList);

        $card = $boardList->cards()->create([
            "title"=>$request->title
        ]);

        return response()->json([
            "message"=>"Card created successfully",
            "data"=>$card
        ],201);
    }

    public function update(UpdateCardRequest $request, $card_id){
        $card = Card::with('boardList.board.workspace')->find($card_id);

        if(!$card){
            return response()->json([
                "message"=>"Card not found"
            ],404);
        }

        $this->authorize('update',$card);

        $card->update([
            "title"=>$request->title,
            "description"=>$request->description,
            "due_date"=>$request->due_date,
            "order"=>$request->order ?? $card->order,
        ]);

        return response()->json([
            "message"=>"Card updated successfully",
            "data"=>$card
        ],200);
    }

    public function destroy ($card_id){
        $card = Card::with('boardList.board.workspace')->find($card_id);

        if(!$card){
            return response()->json([
                "message"=>"Card not found"
            ],404);
        }

        $this->authorize('delete',$card);

        $card->delete();

        return response()->json([
            "message"=>"Card deleted successfully"
        ],200);
    }




}
