@extends('layouts.app')

@section('content')
    <div  class="card">
        <div class="card-header">
            <div class="card-header-info">
                <div class="float-right" >
                    <a href="{{route('taxes.index')}}" class="button"><i class="material-icons ">list</i></a>
                </div>
                <div class="title" style="width: 10%;">Tambah STPD</div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('taxes.update',['id'=>$letter->id])}}" method="POST" >
                {{method_field('PATCH')}}
                @include('taxes.form',['btnlabel'=>'Simpan'])    
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
        var selectbox = $('#companies').select2({
            ajax: {
                url: "{{route('api.companies.findbytag')}}",
                dataType: 'json',
                delay:250,
                placeholder: "Select items from List",
                allowClear:true,
                data: function (params) {
                    return {
                        q: params.term, // search term
                    };
                },
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {    
                                text: item.name,
                                id: item.id
                            }
                        })
                }   ;
                
                },
                cache: true
            }
         });
         dateformat = 'dd-mm-yyyy';
         $('#periode').datepick({dateFormat: dateformat});
         $('#letter_date').datepick({dateFormat: dateformat});
    }); 
</script>
@stop
