<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    //
    public function letter(){
        return $this->belongsTo('App\History', "letter_id");
    }

    public function status(){
        return $this->belongsTo('App\Status','status_id');
    }
}
