<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CompanyCategories;
class CompanyCategoriesController extends Controller
{
    public function findbytag(Request $req){
        
        if($req->has('q')) {
            $company = CompanyCategories::select()->where("name","like","%" . $req->input("q") . "%")->get();
        }
        else {
            $company = CompanyCategories::all();     
        }
        return $company;
    }
}
