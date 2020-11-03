<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tree extends Model
{
    use HasFactory;

    public function parent(){
        return $this->belongsTo('App\Models\Tree','parentID');
    }

    public function children(){
        return $this->hasMany('App\Models\Tree','parentID');
    }

}
