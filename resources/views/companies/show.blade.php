@extends('layouts.app')

@section('content')
@foreach($company->letters as $letter)
<div  class="card">
        <div class="card-header">
            <div class="card-header-info">
                <div class="float-right" >
                    <a href="{{route('companies.index')}}" class="button"><i class="material-icons ">list</i></a>
                </div>
                <div class="title" style="width: 20%;">Pajak {{config('month')[$letter->month]}} - {{$letter->year}}</div>
            </div>
        </div>
        <div class="card-body">
          

          <ul class="nav">
            <li>
                <table  style="width:100%;">
                    <tr>
                        <th>Status Terakhir</th> <th>:</th> <td><span class="badge badge-info">{{$letter->history_last->first()->status->desc}}</span></td>
                    </tr>
                    <tr>
                        <th>Tanggal keluar surat  </th> <th>: </th> <td>{{Carbon\Carbon::parse($letter->history_last->first()->letter_date)->format('d-M-Y')}}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Berakhir </th> <th> : </th> <td>{{Carbon\Carbon::parse($letter->history_last->first()->periode)->format('d-M-Y')}}</td>
                    </tr>
                </table>
            </li>
          </ul>

          <div style="border-bottom: 1px solid #afafaf;"></div>
          
          
        </div>
    </div>
    @endforeach
@stop
