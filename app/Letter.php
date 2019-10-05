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
}
