@extends('layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        <h2>
            Daftar
            <small>dari user</small>
        </h2>

        <a href="{{route('users.index')}}" 
        class="btn bg-red btn-circle waves-effect waves-circle waves-float pull-right">
                <i class="material-icons">list</i>
            </a>
    </div>

    <div class="card-body">
         
        <form action="{{route('users.store')}}" method="POST" >
            @csrf
            @include ('users.form', ['formMode' => 'create'])
        </form>
    </div>
</div>

@endsection

@push('scripts')



@endpush