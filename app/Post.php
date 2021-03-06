<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    // protected $fillable = ['user_id','title','content','slug', 'active'];

    public function Comments(){
        return $this->hasMany('App\Comment');
    } 

    public function User(){
        return $this->belongsTo('App\User');
    } 
    
}
