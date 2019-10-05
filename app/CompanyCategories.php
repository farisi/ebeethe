<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyCategories extends Model
{
    public function companies(){
        return $this->hasMany('App\Company','company_categories_id');
    }
}
