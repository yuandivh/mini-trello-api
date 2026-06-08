<?php

namespace App\Http\Controllers\Api\Workspace;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Workspace\StoreWorkspaceRequest;
use App\Http\Requests\Workspace\UpdateWorkspaceRequest;
use App\Models\Workspace;

class WorkspaceController extends Controller
{
    //
    public function index(Request $request)
    {
        $workspace = $request->user()->workspaces()->with('boards')->get();
        return response()->json([
            'status'=>'success',
            'data'=>$workspace
        ]);
    }

    public function show(Request $request, $workspace_id)
    {
        $workspace = $request->user()->workspaces()->with('boards')->find($workspace_id);
        if(!$workspace){
            return response()->json([
                'status'=>'error',
                'message'=>'Workspace not found'
            ],404);
        }
        return response()->json([
            'status'=>'success',
            'data'=>$workspace
        ]);
    }

    public function store (StoreWorkspaceRequest $request){
        $workspace = $request->user()->workspaces()->create(
            [
                'name'=>$request->name,
                'description'=>$request->description
            ]
        );
        return response()->json([
            "status"=>"Workspace created successfully",
            "data"=>$workspace
        ],201);
    }

    public function update(UpdateWorkspaceRequest $request, $workspace_id){
        $workspace = $request->user()->workspaces()->find($workspace_id);
        if(!$workspace){
            return response()->json([
                'status'=>'error',
                'message'=>'Workspace not found'
            ],404);
        }
        $workspace->update([
            "name"=>$request->name,
            "description"=>$request->description
        ]);
        return response()->json([
            "status" => "Workspace updated successfully",
            "data" => $workspace
        ],200);
    }

    public function destroy(Request $request, $workspace_id){
        $workspace = $request->user()->workspaces()->find($workspace_id);
        if(!$workspace){
            return response()->json([
                'status'=>'error',
                'message'=>'Workspace not found'
            ],404);
        }
        $workspace->delete();
        return response()->json([
            'status'=>'success',
            'message'=>'Workspace deleted successfully'
        ],200);
    }
}
