<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BoardList;

class Card extends Model
{
    //
    protected $table = 'cards';
    protected $fillable =['board_list_id','title','description','due_date','order'];

    public function boardList()
    {
        return $this->belongsTo(BoardList::class,'board_list_id','id');
    }
}
