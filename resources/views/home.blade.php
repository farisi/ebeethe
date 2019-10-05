@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body hasil">
                    
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card  text-danger  mb-3">
                <div class="card-header">
                    {!! $category->container() !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">        
                <div class="card-body">
                    {!! $bar->container() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
<script>
</script>
{!! $category->script() !!}
{!! $bar->script() !!}
@endsection

@section('styles')

@endsection