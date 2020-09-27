<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;
use App\Letter;
use App\Company;
use App\Status;
use PDF;

class ReportsController extends Controller
{
    public function index(){
        $companies = Company::all();
        $statuses = Status::all();
        return view('reports.index',compact('companies','statuses'));
    }

    public function init(Request $req) {

        $data = Letter::with("history_last");
            

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
            ->addColumn('status',function($data){
                return $data->history_last->first()->status->desc;
            })
            ->filter(function($query) use ($req){
                if($req->has('npwp') && strlen($req->input("npwp")) > 0) {
                    $query->whereHas("company",function($sql) use ($req){
                        $sql->where("npwp", $req->input("npwp"));
                    });
                }
                if($req->has("year") && $req->input("year") > 0) {
                    $query->where("year", $req->input('year'));
                }
                if($req->has("status") && $req->input("status") > 0) {
                    $query->whereHas("history_last", function($sql) use ($req){
                        $sql->where("status_id", $req->input("status"));
                    });
                }
                if($req->has("bulan") && $req->input("bulan") > 0){
                    $query->where("month", $req->input("bulan"));
                }

            })
              ->make(true);
    }
    public function showpdf(Request $req){
        
        $letters=Letter::whereHas("history_last",function($query) use($req){
           if($req->has("status") && $req->input("status") > 0){
               $query->where("status_id", $req->input("status"));
           }
        });

        if($req->has("npwp") && $req->input("npwp")!= ""){
            $letters->whereHas("company",function($sql) use($req) {
            
                $sql->where("npwp", $req->input("npwp"));
            });
        }

        if($req->has("bulan") && $req->input("bulan") > 0){
            $letters->where("month", $req->input("bulan"));
        }

        if($req->has("year")){
            $letters->where("year", $req->input("year"));
        }

        $letters = $letters->get();
        
        $pdf = PDF::loadView('reports.pdf', compact('letters'));
        //return $pdf->stream('reports.pdf');
        return view('reports.pdf', compact('letters'));
    }
}
