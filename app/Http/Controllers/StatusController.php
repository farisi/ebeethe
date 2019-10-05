<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Status;
use DataTables;
use Carbon\Carbon;

class StatusController extends Controller
{
    //
    public function __contruct(){
        $this->middleware('auth');
    }

    public function index(){
        // $statuses = Status::findOrfail(1);
        // $created = new Carbon('2019-09-07');
        // $now = Carbon::now();
        // $difference = ($created->diff($now)->days < 1)
        //     ? 'today'
        //     : $created->diffForHumans($now);

        // dd($created->diff($now)->days);
        return view('status.index');
    }

    public function initdata(Request $req){
        
        $statuses = Status::query();
        
        return DataTables::of($statuses)
        ->addColumn('no',function(){
            return '';
        })
        ->addColumn('action',function($statuses){
            return '<a href="' . route('status.edit',['id'=>$statuses->id]) . '" ><i class="material-icons">edit</i></a>'
            .'<a  href="" onclick="event.preventDefault();$(\'#test\').submit()"><i class="material-icons">delete</i></a>'
            .'<form id="test" action="' . route('status.destroy',['id'=>$statuses->id]) . '" method="POST" onsubmit="return confirm(\' Apakah anda yakin ingin menghapus status ini \');">'
            . '<input type="hidden" name="_method" value="DELETE">'
            . csrf_field()
            //. '<button type="submit" class="btn"><i class="material-icons">delete</i></button>'
            .'</form>';
        })
        ->make(true);
    }

    public function create(){
        return view('status.add',array());
    }

    public function store(Request $req){

        $input = $req->all();
        $validator = Validator::make($input, [
            'desc' => 'required',
            
        ],[
            'desc.required'=>'Tidak boleh kosong!'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('status.create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $status = new Status;
        $status->desc = $input['desc'];
        $status->save();

        return redirect()->route('status.index')->with('status','Berhasil Menyimpan status!');

    }

    public function edit($id){
        $status = Status::findOrfail($id);
        return view('status.edit',compact('status'));
    }

    public function update($id){
        $input = $req->all();
        $validator = Validator::make($input, [
            'desc' => 'required',
            
        ],[
            'desc.required'=>'Tidak boleh kosong!'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('status.edit',['id'=>$id])
                        ->withErrors($validator)
                        ->withInput();
        }

        $status = Status::findOrfail($id);
        $status->desc = $input['desc'];
        $status->save();

        return redirect()->route('status.index')->with('status','Berhasil Menyimpan status!');
    }

    public function view($id){

    }

    public function destroy($id){

    }
}
