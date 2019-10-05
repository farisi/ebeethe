<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Letter;

class TaxesController extends Controller
{
    //
    public function findnotif(){
        return Letter::whereHas('histories',function($query){
            $query->where("is_last",1)
            ->where('status_id', '<>', 1)
            ->where('is_readed',0)
            ->where("periode","<=", \DB::raw('NOW()'));
        })->count();
    }
}
