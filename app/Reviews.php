<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
  public function car(){
      $this->belongsTo('App\Car');
  }
}
