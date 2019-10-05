@extends('layouts.app')
@section('content')
@if(Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
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
                    <a href="{{route('companies.create')}}" class="button"><i class="material-icons ">add</i></a>
                </div>
                <div class="title" style="width: 20%;">Daftar Objek Pajak</div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="companies-table">
                <thead>
                    <th>No</th><th>Nama</th><th>NPWP</th><th>Alamat</th><th>Jenis</th><th>PIC</th><th>No PIC</th><th>Aksi</th>
                </thead>
            </table>
        </div>
    </div>
@endsection
@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/r-2.2.2/sl-1.3.0/datatables.min.css"/>
@endsection
@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/r-2.2.2/sl-1.3.0/datatables.min.js"></script>
<script>
    $(document).ready(function(){
        var table = $('#companies-table').DataTable({
            "columnDefs": [
                {
                    "targets": [ 0, 5],
                    "orderable": false
                },
            ],
            "bLengthChange" : false,
            "order":[[ 1, "ASC" ]],
            "language": {
                "url": "{{asset('js/indonesia.json')}}"
            },
            processing: true,
            serverSide: true,
            bFilter: false,
            ajax: {
                url: "{{ route('companies.init') }}",
                data: function (d) {

                    d.tujuan = $('#tujuan_filter').val();
                    d.sasaran = $('#sasaran_filter').val();
                }
            },

            columns: [{
                    data: 'no',
                    name: 'no'
                },
                {
                    data:'name',
                    name:'name'
                },
                {
                    data:'npwp',
                    name:'npwp'
                },
                {
                    data:'address',
                    name:'address'
                },
                {
                    data:'category',
                    name:'category'
                },
                {
                    data:'pic',
                    name:'pic'
                },
                {
                    data:'nopic',
                    name:'nopic'
                },
                {
                    data: 'action',
                    name: 'action'
                }

            ],
            drawCallback: function () {
                //linkMethod.initialize();
            }

        });

        table.on('order.dt search.dt', function () {
            table.column(0).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

        $.fn.dataTableExt.afnFiltering.push(
            function (oSettings, aData, iDataIndex) {
                return true;
            }
        );

        function confirmSubmit()
        {
                var agree=confirm("Are you sure you wish to delete this file?");
                if (agree)
                    $('#test').submit();
                else
                    return false ; 
        };
    });
</script>
@endsection
