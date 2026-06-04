<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Board;
use App\Models\Card;

class BoardList extends Model
{
    //
    protected $table = 'board_lists';
    protected $fillable = ['board_id','name','order'];

    public function board()
    {
        return $this->belongsTo(Board::class,'board_id','id');
    }

    public function cards()
    {
        return $this->hasMany(Card::class,'board_list_id','id');
    }
}
