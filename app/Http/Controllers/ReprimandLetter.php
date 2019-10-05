<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Letter;
use Carbon\Carbon;
use DataTables;

class ReprimandLetter extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('teguran.index');
    }

    public function init(){
        
        $data = Letter::whereHas('histories',function($query){
            $query->where('is_last',1)
            ->where("status_id", ">", 2);
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
        ->addColumn('pokok',function($data){
            return $data->history_last->first()->pokok;
        })
        ->addColumn('penalty',function($data){
            return $data->history_last->first()->penalty;
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
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
