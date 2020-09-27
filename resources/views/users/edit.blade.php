@extends('layouts.backend.template')
@section('main')

<div class="container-fluid">
    
    <div class="block-header">
        <h2>Tambah User Baru</h2>
    </div>    


    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        INPUT
                        <small>perbaharui user</small>
                    </h2>
                    <a href="{{route('users.index')}}" 
                    class="btn bg-red btn-circle waves-effect waves-circle waves-float pull-right">
                            <i class="material-icons">arrow_back</i>
                        </a>
                </div>

                <div class="body">
                    <form action="{{route('users.update',['user'=>$data])}}" method="POST" >
                        @csrf
                        @method('PATCH')
                        @include ('backend.users.form', ['formMode' => 'Update'])
                    </form>
                </div>
            </div>

        </div>
    </div>


</div>
@endsection

@push('scripts')



@endpush