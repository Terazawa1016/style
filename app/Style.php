<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
  protected $fillable = [
    'user_id','title','age','img','height','status','category','comment'
  ];

  public function Like() {
    return $this->hasMany('App\Like');
  }

  public function User() {
    return $this->belongsTo('App\User');
  }

  public function View() {
    return $this->hasMany('App\View');
  }

}
