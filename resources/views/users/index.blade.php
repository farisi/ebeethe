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

            <div class="card">
                <div class="card-header">
                    <h2>
                        Daftar
                        <small>dari user</small>
                    </h2>

                    <a href="{{route('users.create')}}" 
                    class="btn bg-red btn-circle waves-effect waves-circle waves-float pull-right">
                            <i class="material-icons">add</i>
                        </a>
                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table id="users"
                            class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Group</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/r-2.2.2/sl-1.3.0/datatables.min.css"/>
@endsection
@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/r-2.2.2/sl-1.3.0/datatables.min.js"></script>
<script>
$(document).ready(function() {
    var table = $('#users').DataTable({
        "columnDefs": [{
            "targets": [0, 3],
            "orderable": false
        }],
        "bLengthChange": false,
        "order": [
            [1, "ASC"]
        ],
        processing: true,
        serverSide: true,
        bFilter: false,
        ajax: {
            url: "{{route('users.index')}}",
            data: function(d) {

            }
        },
        columns: [{
                data: 'no',
                name: 'no',
                className: 'th-td-center'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'email',
                data: 'email'
            },
            {
                data: 'group',
                name: 'group'
            },
            {
                data: 'action',
                name: 'action',
                className: 'th-td-center'
            }
        ],
        drawCallback: function() {

        }
    });


    table.on('order.dt search.dt', function() {
        table.column(0).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();

    $.fn.dataTableExt.afnFiltering.push(
        function(oSettings, aData, iDataIndex) {
            return true;
        }
    );

});

$(document).on('click', '.btn-delete', function(e) {
    e.preventDefault();
    var href = $(this).attr('href');
    swal({
            title: "Anda Yakin?",
            text: "Sistem akan menghapus data ini!",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yakin, hapus saja!",
            cancelButtonText: "Tidak, batalkan!",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: href,
                    type: "DELETE",
                    data: {
                        _token: '{{csrf_token()}}'
                    },
                    success: function(xhr, ajaxOptions, thrownError) {
                        if (xhr == "success") {
                        var msg = JSON.parse(xhr);
                        swal(msg.title, msg.body, msg.icon);
                        $('#users').DataTable().ajax.reload();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        swal("Error!", "Data gagal Dihapus !", "error");
                    }
                });
            }
        });
});
</script>
@endsection