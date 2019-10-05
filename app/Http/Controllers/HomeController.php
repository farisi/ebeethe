<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\Category;
use App\CompanyCategories;
use App\Letter;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $category = new Category;
        $data = collect([]);
        $label = collect([]);
        $cc = CompanyCategories::all();
        foreach($cc as $c){
            $label->push($c->name);
            $data->push($c->companies->count());
        }
        $category->labels($label);
        $category->dataset('My dataset', 'pie',$data)->options([
            'color' => '#ff0000',
            'backgroundColor'=>['#ff22ff','#ffee89','#f35f9f','#4aef3f','#aaeeff'],
            'displayAxes'=>false,
            'doughnut'=>20,
            'displayLegend'=>false,
        ]);

        $data = Letter::selectRaw('month as bulan, count(month) as month')
        ->groupBy('month')
		->groupBy('year')
        ->orderBy('month')
        ->whereHas('history_last',function($query){
            $query->where("status_id","<>", 1);
        })
        ->get()
		->map(function($item){
            //dd($item);
            return ['month'=>$item->bulan,'jumlah'=>$item->month];
        });
        
		$mydata=[];
		
			for($i=1; $i <=12; $i++) {
				$k=0;
				foreach($data as $value=>$lable) {		
					if($i == $lable['month']){
						$k++;
					}
				}
				if($k>0){
					array_push($mydata,$lable['jumlah']);
				}
				else {
					array_push($mydata,0);
				}
			}
			
		$mydata;
		//dd($mydata);
        $bar = new Category;
        $lable = collect(config('month'));
        $bar->labels(['jan','feb','mar','apr','mei','jun','jul','agt','sept','okt','nov','des']);
        $bar->dataset('Jumlah Tunggakan ' . Carbon::now()->format('Y'),'bar',$mydata)->options([
            'backgroundColor'=>['#ff22ff','#ffee89','#3fAfff','#4aef3f','#aaeeff','#aa00FF','#ff223F','#9999ee','#F39A83','#2244AA','#AABB44','#44BBAA'],
        ]);

        return view('home',compact('category', 'bar'));
    }
}
