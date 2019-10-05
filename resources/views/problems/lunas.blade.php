@extends('layouts.app')

@section('content')
    <div  class="card">
        <div class="card-header">
            <div class="card-header-info">
                <div class="float-right" >
                    <a href="{{route('problems.index')}}" class="button"><i class="material-icons ">list</i></a>
                </div>
                <div class="title" style="width: 20%;">Form Pelunasan</div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('problems.lunasexec',['id'=>$letter->id])}}" method="POST" >
                {{method_field('PATCH')}}
                @csrf
                <div class="form-group  {{$errors->has('letter_date') ? 'has-danger' : ''}}">
                        <label for="letter_date" class="bmd-label-floating">Tanggal Pelunasan</label>
                        <input type="text" class="form-control datepicker" id="letter_date" name="letter_date" placeholder="{{$errors->has('letter_date') ? $errors->first('letter_date') : ''}}">
                        @if($errors->has('letter_date'))
                         <span class="material-icons form-control-feedback">clear</span>
                       @endif
                      </div>
                
                <div class="form-group">
                    <input type="submit" value="{{__('Lunas')}}" class="button-success" />
                </div>
            </form>
        </div>
    </div>
    
@stop
@section('styles')
<link href="{{asset('css/select2-material.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/jquery.datepick.css')}}" rel="stylesheet" >
@stop
@section('scripts')
<script src="{{asset('js/jquery.plugin.min.js')}}"></script>
<script src="{{asset('js/select2.full.min.js')}}"></script>
<script src="{{asset('js/jquery.datepick.min.js')}}"></script>

<script>
    $(document).ready(function(){
         dateformat = 'dd-mm-yyyy';
         $('#periode').datepick({dateFormat: dateformat});
         $('#letter_date').datepick({dateFormat: dateformat});
    }); 
</script>
@stop
