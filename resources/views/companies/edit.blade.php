@extends('layouts.app')

@section('content')
<form action="{{route('companies.update',['id'=>$company->id])}}" method="POST" >
    {{method_field('Patch')}}
    <div  class="card">
        <div class="card-header">
            <div class="card-header-info">
                <div class="float-right" >
                    <a href="{{route('companies.index')}}" class="button"><i class="material-icons ">list</i></a>
                </div>
                <div class="title" style="width: 20%;">Ubah Objek Pajak</div>
            </div>
        </div>
        <div class="card-body">
            
                @include('companies.form',['btnlabel'=>'Simpan'])    
            
        </div>
    </div>
    </form>
@stop
@section('styles')
<link href="{{asset('css/select2-material.css')}}" rel="stylesheet" type="text/css" />
@stop
@section('scripts')
<script src="{{asset('js/select2.full.min.js')}}"></script>
<script>
    $(document).ready(function(){
        var selectbox = $('#company_categories').select2({
            ajax: {
                url: "{{route('api.company_categories.findbytag')}}",
                dataType: 'json',
                delay:250,
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
            },
            placeholder: "Pilih Jenis Objek Pajak",
            allowClear:true,
         });
    });
</script>
@endsection