@extends('layouts.app')
@section('content')
@if(Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Selamat!</strong> {{Session::get(('success'))}}.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@elseif(Session::has('fails'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Selamat!</strong> {{Session::get(('success'))}}.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<div  class="card">
        <div class="card-header">
            <div class="card-header-info">
                <div class="float-right" >
                    <a id='test' href="{{route('taxes.create')}}" class="button"><i class="material-icons ">add</i></a>
                </div>
                <div class="title" style="width: 20%;">Daftar Umum</div>
            </div>
        </div>
        <div class="card-body">
            
        </div>
    </div>
@endsection

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/r-2.2.2/sl-1.3.0/datatables.min.css"/>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(document).ready(function(){

        $('#test').on('click',function(e){
            e.preventDefault();
            Swal.fire({
                title: 'Error!',
                text: 'Do you want to continue',
                icon: 'error',
                target:'body',
                input:'tel',
                confirmButtonText: 'Cool'
            })
        });
        
        
    });
</script>
@endsection