<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Company;
use Illuminate\Support\Facades\Validator;
use App\Letter;
use Carbon\Carbon;
//Illuminate\Support\Facades\DB;
use DB;
use App\History;

class TaxesController extends Controller
{
    //
    public function __contruct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('taxes.index');
    }

    public function init() {

        $data = Letter::whereHas('histories',function($query){
            $query->where('status_id',2)
            ->where("is_last",1);
        });
            

        return DataTables::of($data)
            ->addColumn('no', function(){
                return '';
            })
            ->addColumn('company',function($data){
                return $data->company->name;
            })
            ->addColumn('npwp',function($data){
                return $data->company->npwp;
            })
            ->addColumn('bulan',function($data){
                return config('month')[$data->month] . " " . $data->year;
            })
            ->addColumn('pokok',function($data){
                return $data->pokok;
            })
            ->addColumn('penalty',function($data){
                return $data->history_last->max()->penalty;
            })
            ->addColumn('letter_date',function($data){
                return Carbon::parse($data->history_last->first()->letter_date)->format('d-M-Y');
            })
            ->addColumn('periode',function($data){
                return Carbon::parse($data->history_last->first()->periode)->format('d-M-Y');
            })
            ->addColumn('action',function($data){
                if($data->histories->max()->status_id==2) {
                return '<a href="' . route('taxes.edit',['id'=>$data->id]) . '" ><i class="material-icons">edit</i></a>'
            .'<a  href="" onclick="event.preventDefault();$(\'#test\').submit()"><i class="material-icons">delete</i></a>'
            .'<form id="test" action="' . route('taxes.destroy',['id'=>$data->id]) . '" method="POST" onsubmit="return confirm(\' Apakah anda yakin ingin menghapus status ini \');">'
            . '<input type="hidden" name="_method" value="DELETE">'
            . csrf_field()
            //. '<button type="submit" class="btn"><i class="material-icons">delete</i></button>'
            .'</form>';
                }
                return '';
            })
              ->make(true);
    }

    public function create(){
        $companies = Company::all();
        return view('taxes.add',compact('companies'));
    }

    public function store(Request $req){

        $input = $req->all();
        // dd($input);
        $rules = [
            'company_id'=>'required',
            'pokok'=>'required|numeric',
            'letter_date'=>'required',
            'periode'=>'required',
            'pinalty_persen'=>'different:penalty',
            'month'=>'required'
        ];
        $messages = [
            'company_id.required'=>'Tidak boleh kosong!',
            'pokok.required'=>'Tidak boleh kosong!',
            'pokok.numeric'=>'Harus diisikan dengan angka!',
            'letter_date.required'=>'Tidak boleh kosong',
            'periode.required'=>'tidak boleh kosong',
            'month.required'=>'Tidak boleh kosong!',
            'pinalty_persen.different'=>'Denda dalam persen dan denda tidak boleh kosong dua-duanya!'
        ];

        $valid = Validator::make($req->all(),$rules, $messages);

        if($valid->fails()){
            return redirect()->route('taxes.create')->withErrors($valid)->withInput();
        }

        DB::beginTransaction();

        try {
            
            $letter = new Letter;
            $letter->company_id = $input['company_id'];
            $letter->desc = $input['desc'];
            $letter->pokok = $input['pokok'];
            $letter->year = Carbon::now()->format('Y');
            $letter->month = $input['month'];
            $letter->save();

             $history = new History;
             $history->letter_date = Carbon::parse($input['letter_date'])->format('Y-m-d');
             $history->periode = Carbon::parse($input['periode'])->format('Y-m-d');


             if($input['pinalty_persen']!="" || $input['pinalty_persen'] > 0) {
                $history->pinalty_persen =  $input['pinalty_persen'] ;
                $history->penalty =  ($input['pokok'] * $input['pinalty_persen']) / 100;
            }
            else {
                $history->pinalty_persen = ($input['penalty'] / $input['pokok']) * 100  ;
                $history->penalty =  $input['penalty'];
            }
             
             $history->status_id = 2;
             $history->is_last = 1;
             $history->letter_id = $letter->id;
             $history->duration =  Carbon::parse($input['periode'])->diffInDays(Carbon::parse($input['letter_date']));
             $history->save();

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            //dd($e);
            return redirect()->route('taxes.index')->with('fails',$e->getMessage());
        }

        return redirect()->route('taxes.index')->with('success','Berhasil menyimpan data !');

    }

    public function edit($id){  

        $letter = Letter::findOrfail($id);
        return view('taxes.edit',compact('letter'));
    }

    public function update(Request $req, $id){
        $input = $req->all();
        // dd($input);
        $rules = [
            'company_id'=>'required',
            'pokok'=>'required|numeric',
            'letter_date'=>'required',
            'periode'=>'required',
            'pinalty_persen'=>'different:penalty',
            'month'=>'required'
        ];
        $messages = [
            'company_id.required'=>'Tidak boleh kosong!',
            'pokok.required'=>'Tidak boleh kosong!',
            'pokok.numeric'=>'Harus diisikan dengan angka!',
            'letter_date.required'=>'Tidak boleh kosong',
            'periode.required'=>'tidak boleh kosong',
            'month.required'=>'Tidak boleh kosong!',
            'pinalty_persen.different'=>'Denda dalam persen dan denda tidak boleh kosong dua-duanya!'
        ];

        $valid = Validator::make($req->all(),$rules, $messages);

        if($valid->fails()){
            return redirect()->route('taxes.create')->withErrors($valid)->withInput();
        }

        $letter = Letter::findOrFails($id);

        DB::beginTransaction();

        try {
            
            $letter = new Letter;
            $letter->company_id = $input['company_id'];
            $letter->desc = $input['desc'];
            $letter->pokok = $input['pokok'];
            $letter->year = Carbon::now()->format('Y');
            $letter->month = $input['month'];
            $letter->save();

            $history = Letter::whereHas('histories',function($query){
                $query->where("is_last",1)->where('status_id',2);
            })->first();

             $history->letter_date = Carbon::parse($input['letter_date'])->format('Y-m-d');
             $history->periode = Carbon::parse($input['periode'])->format('Y-m-d');

            //  $history->pinalty_persen = $input['penalty'] != "" ? ($input['penalty'] / $input['pokok']) * 100 : $input['pinalty_persen'] ;
            //  $history->penalty = $input['pinalty_persen'] != "" ? ($input['pokok'] * $input['pinalty_persen']) / 100  :  $input['penalty'];
             
             if($input['pinalty_persen']!="" || $input['pinalty_persen'] > 0) {
                $history->pinalty_persen =  $input['pinalty_persen'] ;
                $history->penalty =  ($input['pokok'] * $input['pinalty_persen']) / 100;
            }
            else {
                $history->pinalty_persen = ($input['penalty'] / $input['pokok']) * 100  ;
                $history->penalty =  $input['penalty'];
            }


             $history->status_id = 2;
             $history->is_last = 1;
             $history->letter_id = $letter->id;
             $history->duration =  Carbon::parse($input['periode'])->diffInDays(Carbon::parse($input['letter_date']));
             $history->save();

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            //dd($e);
            return redirect()->route('taxes.index')->with('fails',$e->getMessage());
        }

        return redirect()->route('taxes.index')->with('success','Berhasil memperbaharui data!');
    }

    public function view($id){

    }

    public function destroy($id){

    }
}
