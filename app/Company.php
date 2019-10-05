<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    function Histories(){
        return $this->hasManyThrough('App\History', 'App\Letter');
    }

    function company_category(){
        return $this->belongsTo('App\CompanyCategories','company_categories_id');
    }

    function letters(){
        return $this->hasMany('App\Letter','company_id');
    }
}
