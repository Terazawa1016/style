<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
  protected $fillable = [
  'user_id', 'style_id', 'count', 'today'
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
