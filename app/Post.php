<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id', 'comment'];
    
    public function user(){
      return $this->belongsTo('App\User');
    }
    
    public function scopePosts($query, $follow_user_id, $user_id){
        return $query->whereIn('user_id', $follow_user_id)->orWhere('user_id', $user_id)->latest();
    }
    
    public function scopeSearch($query, $user_id, $search){
        return $query->where('user_id', '!=', $user_id)->where('comment','LIKE', "%{$search}%")->latest();
    }
}
