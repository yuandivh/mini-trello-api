<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Workspace;
use App\Models\BoardList;


class Board extends Model
{
    //
    protected $table = 'boards';
    protected $fillable = ['workspace_id','name'];

    public function workspace()
    {
        return $this->belongsTo(Workspace::class,'workspace_id','id');
    }

    public function boardLists()
    {
        return $this->hasMany(BoardList::class,'board_id','id');
    }

}
