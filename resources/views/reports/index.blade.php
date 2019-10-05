@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-body">
        <form class="form" id="myform">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>NPWP</label>
                        <input type="text" id="npwp" name="npwp" class="form-control" />
                    </div>
                    <div class="form-group">
                        <lable>Bulan</lable>
                        <select id="bulan" name="bulan" class="form-control">
                            <option value="" selected>Silahkan pilih Bulan</option>
                            @foreach(config('month') as $value=>$label)
                            <option value="{{$value}}">{{$label}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    
                    <div class="form-group">
                            <label>Status </label>
                            <select id="status" name="status" class="form-control">
                                <option value="" selected>Silahkan pilih status</option>
                                @foreach($statuses as $st)
                                <option value="{{$st->id}}">{{$st->desc}}</option>
                                @endforeach
                            </select>
                        </div>
                    <div class="form-group">
                        <label>Tahun</label>
                        <input type="number" name="year" id="year" class="form-control" min="2016" value="{{Carbon\Carbon::now()->format('Y')}}"/>
                    </div>
                </div>
            </div>
            
            
            <div class="form-group">
               <button>Cari</button>
            </div>
        </form>
    </div>
</div>
<div  class="card">
        <div class="card-header">
            <div class="card-header-info">
                <div class="float-right" >
                    <a href="{{route('reports.showpdf')}}" target="__blank" id="cetakpdf"><i class="material-icons">picture_as_pdf</i></a>
                </div>
                <div class="title" style="width: 20%;">Laporan</div>
            </div>
        </div>
        <div class="card-body">
            <table class="table" id="history-table">
                <thead>
                    <tr>
                            <th>No</th><th>Object Pajak</th><th>NPWP</th><th>Pajak Bulan</th><th>Pokok</th><th>Denda</th><th>Tanggal Surat</th><th>Berakhir Sampai</th><th>Status</th>
                    </tr>

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
                url: "{{ route('reports.init') }}",
                data: function (d) {

                    d.year = $('#year').val();
                    d.status = $('#status').val();
                    d.bulan = $('#bulan').val();
                    d.npwp = $('#npwp').val();
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
                    data:'status',
                    name:'status'
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

        $('#myform').submit(function(e){
            e.preventDefault();
            

            url = $('#cetakpdf').attr('href');
            url += "?" + $(this).serialize();
            $('#cetakpdf').attr('href', url + $(this).serialize());
            table.draw();
        });
    });
</script>
@endsection
