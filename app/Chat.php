<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
  protected $fillable = [
    'user_id','style_id', 'message',
  ];

  public function User()
  {
    return $this->belongsTo('App\User');
  }

  public function Style()
  {
    return $this->belongsTo('App\Style');
  }
}
