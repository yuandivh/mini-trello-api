<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Board;

class Workspace extends Model
{
    //
    protected $fillable = ['name','user_id', 'description'];
    protected $table = 'workspaces';

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function boards()
    {
        return $this->hasMany(Board::class,'workspace_id','id');
    }
}
