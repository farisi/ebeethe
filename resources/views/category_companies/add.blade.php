@extends('layouts.app')

@section('content')
<form action="{{route('company_categories.store')}}" method="POST" >
    <div  class="card">
        <div class="card-header">
            <div class="card-header-info">
                <div class="float-right" >
                    <a href="{{route('company_categories.index')}}" class="button"><i class="material-icons ">list</i></a>
                </div>
                <div class="title" style="width: 20%;">Tambah Jenis Objek Pajak</div>
            </div>
        </div>
        <div class="card-body">
            
                @include('category_companies.form',['btnlabel'=>'Simpan'])    
            
        </div>
    </div>
    </form>
@stop
