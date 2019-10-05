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
                    <a href="{{route('status.create')}}" class="button"><i class="material-icons ">add</i></a>
                </div>
                <div class="title" style="width: 10%;">Daftar Status</div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="status-table">
                <thead>
                <th>No</th><th>Status</th><th>Aksi</th>
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
        var table = $('#status-table').DataTable({
            "columnDefs": [
                {
                    "targets": [ 0, 2],
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
                url: "{{ route('status.initdata') }}",
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
                    data:'desc',
                    name:'desc'
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
