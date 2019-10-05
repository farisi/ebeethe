<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\CompanyCategories;
use Validator;

class CategoryCompaniesController extends Controller
{
    public function index(){
        return view('category_companies.index');
    }

    public function init(){
        $comcat = CompanyCategories::select();

        return DataTables::of($comcat)
            ->addColumn('no',function(){
                
            })
            ->addColumn('action',function($comcat){
                return '';
            })
        ->make(true);
    }

    public function create(){
        return view('category_companies.add');
    }

    public function store(Request $req){
        
        $input = $req->all();
        
        $valid = Validator::make([
            'name'=>'required'
        ],[
            'name.required'=>'Jenis objek pajak tidak boleh kosong!'
        ]);

        if($valid->fails()){
            return redirect()->route('company_categories.create')->withErrors($valid)->withInput();
        }

        $cc = new CompanyCategory;
        $cc->name = $input['name'];
        $cc->save();

        return redirect()->route('company_categories.index')->with('success','Berhasil menyimpan data!');
    }

    public function edit($id){
        return view('category_companies.edit');
    }

    public function update(Request $req, $id){
        $input = $req->all();
        
        $valid = Validator::make([
            'name'=>'required'
        ],[
            'name.required'=>'Jenis objek pajak tidak boleh kosong!'
        ]);

        if($valid->fails()){
            return redirect()->route('company_categories.create')->withErrors($valid)->withInput();
        }

        $cc = CompanyCategory::findOrfail($id);
        $cc->name = $input['name'];
        $cc->save();

        return redirect()->route('company_categories.index')->with('success','Berhasil menyimpan data!');
    }

    public function destroy($id){

    }
}
