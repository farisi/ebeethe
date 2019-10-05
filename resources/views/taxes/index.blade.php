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
                    <a href="{{route('taxes.create')}}" class="button"><i class="material-icons ">add</i></a>
                </div>
                <div class="title" style="width: 10%;">Daftar STPD</div>
            </div>
        </div>
        <div class="card-body">
            <table class="table" id="history-table">
                <thead>
                <th>No</th><th>Object Pajak</th><th>NPWP</th><th>Pajak Bulan</th><th>Pokok</th><th>Denda</th><th>Tanggal Surat</th><th>Berakhir Sampai</th><th>Aksi</th>
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
        var table = $('#history-table').DataTable({
            "columnDefs": [
                {
                    "targets": [ 0, 8],
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
                url: "{{ route('taxes.init') }}",
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
                    data:'company',
                    name:'company'
                },
                {
                    data:'npwp',
                    name:'npwp'
                },
                {
                    data:'bulan',
                    name:'bulan'
                },
                
                {
                    data:'pokok',
                    name:'pokok'
                },
                {
                    data:'penalty',
                    name:'penalty'
                },
                {
                    data:'letter_date',
                    name:'letter_date'
                },
                {
                    data:'periode',
                    name:'periode'
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
    });
</script>
@endsection
