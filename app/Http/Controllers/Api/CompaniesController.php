<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Company;

class CompaniesController extends Controller
{
    public function index(){
        return Company::all();
    }

    public function findbytag(Request $req){
        
        if($req->has('q')) {
            $company = Company::select()->where("name","like","%" . $req->input("q") . "%")->get();
        }
        else {
            $company = Company::all();     
        }
        return $company;
    }
}
