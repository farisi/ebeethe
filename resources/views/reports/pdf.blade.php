<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{asset('css/all.css')}}" rel="stylesheet" />
    </head>
    <body>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th><th>Object Pajak</th><th>NPWP</th><th>Pajak Bulan</th><th>Pokok</th><th>Denda</th><th>Tanggal Tagihan</th><th>Berakhir Sampai</th><th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($letters as $letter)
                    <tr>
                        <td>{{$loop->iteration}}</td><td>{{$letter->company->name}}</td><td>{{$letter->company->npwp}}</td><td>{{config('month')[$letter->month]}} - {{$letter->year}}</td>
                        <td>{{$letter->pokok}}</td><td>{{$letter->history_last->first()->penalty}}</td>
                        <td>{{$letter->history_last->first()->letter_date}}</td><td>{{$letter->history_last->first()->periode}}</td><td>{{$letter->history_last->first()->status->desc}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>