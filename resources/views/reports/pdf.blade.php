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
                    <th rowspan="2">No</th><th rowspan="2">Object Pajak</th><th rowspan="2">NPWP</th><th rowspan="2">Pajak Bulan</th><th rowspan="2">Pokok</th><th rowspan="2">Denda</th><th rowspan="2">Tanggal Tagihan</th><th colspan="4" style="text-align: center">Status</th>
                    <tr>
                        <th>STPD</th><th>Teguran I</th><th>Teguran II</th><th>Lunas</th>
                    </tr>
                </tr>
            </thead>
            <tbody>
                @foreach($letters as $letter)
                    <tr>
                        <td>{{$loop->iteration}}</td><td>{{$letter->company->name}}</td><td>{{$letter->company->npwp}}</td><td>{{config('month')[$letter->month]}} - {{$letter->year}}</td>
                        <td>{{$letter->pokok}}</td><td>{{$letter->history_last->first()->penalty}}</td>
                        <td>{{Carbon\Carbon::parse($letter->history_last->first()->letter_date)->format('d-M-Y')}}</td>
                        <td></td><td></td><td></td><td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>