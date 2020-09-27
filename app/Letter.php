<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    //
    public function histories() {
        return $this->hasMany(History::class, "letter_id");
    }

    public function company(){
        return $this->belongsTo('App\Company');
    }

    public function history_last(){
        return $this->histories()->where('is_last',1);
    }

    public function history_stpd(){
        return $this->histories()->where('status_id',2);
    }

    public function history_teguran1(){
        return $this->histories()->where('status_id',3);
    }

    public function history_teguran2(){
        return $this->histories()->where('status_id',4);
    }
}
