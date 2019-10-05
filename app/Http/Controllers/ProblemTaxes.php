<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Letter;
use Carbon\Carbon;
use Validator;
use DB;
use App\History;


class ProblemTaxes extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('problems.index');
    }


    public function init(){

        $data = Letter::whereHas('histories',function($query){
            $query->where("is_last",1)
            ->where('status_id', '<>', 1)
            ->where("periode","<=", \DB::raw('NOW()'));
        });
       
	   
        return DataTables::of($data)

        ->addColumn('no',function(){return '';})
        ->addColumn('company',function($data){
            return $data->company->name;
        })
        ->addColumn('bulan',function($data){
            return config('month')[$data->month] . " " . $data->year;
        })
        ->addColumn('npwp',function($data){
            return $data->company->npwp;
        })
        ->addColumn('pokok',function($data){
            return $data->pokok;
        })
        ->addColumn('penalty',function($data){
            return  $data->history_last->max()->penalty;
        })
        ->addColumn('letter_date',function($data){
            return Carbon::parse($data->history_last->first()->letter_date)->format('d-M-Y');
        })
        ->addColumn('periode',function($data){
            return Carbon::parse($data->history_last->first()->periode)->format('d-M-Y');
        })

        ->addColumn('status',function($data){
            return $data->history_last->first()->status->desc;
        })
        ->addColumn('action',function($data){
            $url = '<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
          
             <div class="btn-group" role="group">
              <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Tombol Aksi
              </button>
              <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">';

              if($data->history_last->first()->status_id==2) {
                  $url .= '<a href="' . route('problems.edit',['id'=>$data->id]) . '" class="dropdown-item" >Teguran 1</a>';
              }
              else if($data->history_last->first()->status_id==3) {
                    $url .= '<a href="' . route('problems.edit',['id'=>$data->id]) . '" class="dropdown-item">Teguran 2</a>';
              }
              else if($data->history_last->first()->status_id==4) {
                    $url .= '<a href="' . route('problems.edit',['id'=>$data->id]) . '" class="dropdown-item">Limpahkan</a>';
              }
              $url .=  '<a href="' . route('problems.lunasform',['id'=>$data->id]) .'" class="dropdown-item">Lunas</a>'; 
            $url .= '    </div>
            </div>';
              
            
            
            return $url;
        })
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('problems.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $letter = Letter::findOrfail($id);
        return view('problems.edit',compact('letter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $input = $req->all();
        // dd($input);
        $rules = [
            'letter_date'=>'required',
            'periode'=>'required',
            'pinalty_persen'=>'different:penalty',
        ];
        $messages = [
            'letter_date.required'=>'Tidak boleh kosong',
            'periode.required'=>'tidak boleh kosong',
            'pinalty_persen.different'=>'Denda dalam persen dan denda tidak boleh kosong dua-duanya!'
        ];

        $valid = Validator::make($req->all(),$rules, $messages);

        if($valid->fails()){
            return redirect()->route('problems.edit',['id'=>$id])->withErrors($valid)->withInput();
        }

        DB::beginTransaction();

        $lastHistory = Letter::whereHas('histories',function($query){
            $query->where("is_last",1);
        })->first();

        $letter = Letter::findOrfail($id);
        //dd($letter->history_last->first()->status_id);
        try {
            $last_status = $letter->history_last->first()->status_id;
            History::select()->where("letter_id", $id)->update(['is_last'=>0]);
            
            $history = new History;
            $history->letter_date = Carbon::parse($input['letter_date'])->format('Y-m-d');
            $history->periode = Carbon::parse($input['periode'])->format('Y-m-d');

            if($input['pinalty_persen']!="" || $input['pinalty_persen'] > 0) {
                $history->pinalty_persen =  $input['pinalty_persen'] ;
                $history->penalty =  ($letter->pokok * $input['pinalty_persen']) / 100;
            }
            else {
                $history->pinalty_persen = ($input['penalty'] / $letter->pokok) * 100  ;
                $history->penalty =  $input['penalty'];
            }
            
            $history->status_id = $last_status + 1;
            $history->is_last = 1;
            $history->letter_id = $id;
            $history->duration =  Carbon::parse($input['periode'])->diffInDays(Carbon::parse($input['letter_date']));
            $history->save();
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            return redirect()->route('problems.index')->with('fails',$e->getMessage());
        }
        
        return redirect()->route('problems.index')->with('success','Berhasil mengupdate data!');
    }

    public function lunasform($id){
        $letter = Letter::findOrfail($id);
        return view('problems.lunas',compact('letter'));
    }

    public function lunasexec(Request $req,$id){
        $input = $req->all();

        $valid = Validator::make($input,[
            'letter_date'=>'required',
        ],[
            'letter_date.required'=>'Tanggal Pelunasan tidak boleh kosong! '
        ]);

        if($valid->fails()){
            return redirect()->route('problems.lunasform',['id'=>$id])->withErrors($valid)->withInput();
        }

        DB::beginTransaction();

        try {
            
            History::select()->where("letter_id", $id)->update(['is_last'=>0]);
            $letter = Letter::findOrfail($id);
            $letter->is_paid_off = 'Y';
            $letter->save();
            
            $history = new History;
            $history->letter_date = Carbon::parse($input['letter_date'])->format('Y-m-d');
            $history->periode = Carbon::now()->format('Y-m-d');
            $history->penalty = $letter->history_last->first()->penalty;
            $history->penalty = $letter->history_last->first()->pinalty_persen;
            $history->status_id = 1;
            $history->is_last = 1;
            $history->letter_id = $id;
            $history->duration = 0;
            $history->save();

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            return redirect()->route('problems.index')->with('fails',$e->getMessage());
        }
        
        return redirect()->route('problems.index')->with('success','Berhasil mengupdate data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
