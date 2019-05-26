<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function survey(){
        return $this->belongsTo('App\Survey');
    }
}
