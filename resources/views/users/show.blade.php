@extends('layouts.backend.template')
@section('main')

<div class="container-fluid">

    <div class="block-header">
        <h2>USER</h2>
    </div>


    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Detail
                        <small>dari user</small>
                    </h2>

                    <a href="{{route('users.index')}}" 
                    class="btn bg-red btn-circle waves-effect waves-circle waves-float pull-right">
                            <i class="material-icons">arrow_back</i>
                        </a>
                </div>

                <div class="body">

                    <dl class="row">
                        <dt class="col-sm-3">Nama</dt>
                        <dd class="col-sm-9">{{$user->name}}</dd>

                        <dt class="col-sm-3">Email</dt>
                        <dd class="col-sm-9">{{$user->email}}</dd>

                        <dt class="col-sm-3">Level</dt>
                        <dd class="col-sm-9">{{$user->role->name}}</dd>

                        <dt class="col-sm-3">Instansi</dt>
                        <dd class="col-sm-9">{{$user->instansiWilayah->instansi->nama}}</dd>

                        <dt class="col-sm-3">Wilayah</dt>
                        <dd class="col-sm-9">{{$user->wilayah->nama}}</dd>
                    </dl>
                </div>
            </div>


            <div class="card">
                <div class="header">
                    <h2>
                        Histori
                        <small>dari Pekerjaan</small>
                    </h2>
                </div>

                <div class="body">
                    <table class="table table-striped">
                        <thead>
                            <th>No</th><th>Element</th><th>Variable</th><th>Bidang</th><th>Jumlah Inputan</th>
                        </thead>
                        <tbody>
                            
                            @foreach($data as $dt) 
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$dt['element']}}</td>
                                    <td>{{$dt['variable']}}</td>
                                    <td>{{$dt['bidang']}}</td>
                                    <td>{{$dt['jumlah']}}</td>
                                </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>


</div>

<style>
th.th-td-center,
td.th-td-center {
    text-align: center;
}

td.td-left {
    text-align: left;
}

td.td-right {
    text-align: right;
}

th.th-center {
    text-align: center;
}
</style>

@endsection


@push('scripts')

@endpush