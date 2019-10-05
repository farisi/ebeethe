<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Company;
use Illuminate\Support\Facades\Validator;


class CompaniesController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('companies.index');
    }

    public function init(){
        $companies = Company::select();
        return DataTables::of($companies)
        ->addColumn('no',function(){
            return '';
        })
        ->addColumn('category',function($companies){
            return $companies->company_category->name;
        })
        ->addColumn('action',function($companies){
            return '<a href="' . route('companies.edit',['id'=>$companies->id]) . '" ><i class="material-icons">edit</i></a>'
            .'<a href="' . route('companies.show',['id'=>$companies->id]) .'"><i class="material-icons">search</i></a>'
            .'<a  href="" onclick="event.preventDefault();$(\'#test\').submit()"><i class="material-icons">delete</i></a>'
            .'<form id="test" action="' . route('companies.destroy',['id'=>$companies->id]) . '" method="POST" onsubmit="return confirm(\' Apakah anda yakin ingin menghapus status ini \');">'
            . '<input type="hidden" name="_method" value="DELETE">'
            . csrf_field()
            //. '<button type="submit" class="btn"><i class="material-icons">delete</i></button>'
            .'</form>';
        })
        ->make(true);
    }

    public function create(){
        return view('companies.add');
    }

    public function store(Request $req){
        $input = $req->all();
        
        $rules=[
            'name'=>'required',
            'npwp'=>'required|unique:companies',    
            'address'=>'required',
            'company_categories'=>'required'
        ];
        
        $messages=[
            'name.required'=>'Nama tidak boleh kosong!',
            'npwp.required'=>'NPWP tidak boleh kosong!',
            'npwp.unique'=>'NPWP sudah terdapat pada web applikasi!',    
            'address.required'=>'Alamat tidak boleh kosong!',
            'company_categories.required'=>'Pilihlah salah satu memilih jenis objek pajak!'
        ];
        
        $validate = Validator::make($input,$rules,$messages);

        if($validate->fails() ){
            return redirect()->route('companies.create')
             ->withErrors($validate)
             ->withInput();
        }

        $company = new Company;
        $company->name = $input['name'];
        $company->npwp = $input['npwp'];
        $company->address = $input['address'];
        $company->pic = $input['pic'];
        $company->nopic = $input['nopic'];
        $company->company_categories_id = $input['company_categories'];
        $company->save();

        return redirect()->route('companies.index')->with('status','Sukses menyimpan data');
    }

    public function edit($id){
        $company = Company::findOrfail($id);
        return view('companies.edit',compact('company'));
    }

    public function update(Request $req,$id){
        $input = $req->all();
        
        $rules=[
            'name'=>'required',
            'npwp'=>'required|unique:companies,npwp,' . $id . ",id",
            'address'=>'required',
            'company_categories'=>'required'
        ];
        
        $messages=[
            'name.required'=>'Nama tidak boleh kosong!',
            'npwp.required'=>'NPWP tidak boleh kosong!',
            'npwp.unique'=>'NPWP sudah terdapat pada web applikasi!',
            'address.required'=>'Alamat tidak boleh kosong!',
            'company_categories.required'=>'pilihlah salah satu jenis objek pajak!'
        ];
        
        $validate = Validator::make($input,$rules,$messages);

        if($validate->fails() ){
            return redirect()->route('companies.edit',['id'=>$id])
             ->withErrors($validate)
             ->withInput();
        }

        $company = Company::findOrfail($id);
        $company->name = $input['name'];
        $company->npwp = $input['npwp'];
        $company->address = $input['address'];
        $company->pic = $input['pic'];
        $company->nopic = $input['nopic'];
        $company->company_categories_id = $input['company_categories'];
        $company->save();

        return redirect()->route('companies.index')->with('status','Sukses menyimpan data');
    }

    public function show($id){
        $company = Company::findOrfail($id);
        return view('companies.show',compact('company'));
    }

    public function destroy(){

    }
}
