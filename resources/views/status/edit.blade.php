@extends('layouts.app')
@section('content')
<form action="{{route('status.store')}}" method="POST" >
    {{method_field('Patch')}}
    <div  class="card">
        <div class="card-header">
            <div class="card-header-info">
                <div class="float-right" >
                    <a href="{{route('status.index')}}" class="button"><i class="material-icons ">list</i></a>
                </div>
                <div class="title" style="width: 10%;">Tambah STPD</div>
            </div>
        </div>
        <div class="card-body">
            
                @include('status.form',['btnlabel'=>'Simpan'])    
            
        </div>
    </div>
    </form>
@stop