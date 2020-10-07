<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = ['title','content','slug','active'];

    public function Comments(){
        return $this->hasMany('App\Comment');
    } 
    
}
