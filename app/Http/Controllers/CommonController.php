<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Letter;
use Carbon\Carbon;
use DataTables;
use App\Exports\TestExport;
use Excel;

class CommonController extends Controller
{
    public function index(){
        return view('commons.index');
    }

    public function create(){
        
        return Excel::download(new TestExport, 'user.xlsx');
    }
}