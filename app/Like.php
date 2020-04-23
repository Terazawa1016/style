<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
  protected $fillable = [
  'user_id', 'style_id', 'count'
  ];

  public function Style()
  {
    return $this->belongsMany('App\Style');
  }
}
