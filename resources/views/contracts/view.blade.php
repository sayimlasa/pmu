@extends('home')
@section('content')
    <div class="container mt-2">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Contract Details</h1>
                    </div><!-- /.col -->
                    
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <p>Name Contract</p>
                <p>{{$contracts->name}}</p>
        <table class="table table-bordered">
            <tr>
                <td>Name Contract</td>
                <td>{{$contracts->name}}</td>  
            </tr>
            <tr>
                <td>Starting  Contract</td>
                <td>{{$contracts->startd}}</td>  
            </tr>
            <tr>
                <td>Ending Contract</td>
                <td>{{$contracts->endd}}</td>  
            </tr>
            <tr>
                <td>Contract Document</td>
                <td>{{$contracts->document}}</td>  
            </tr>
            
        </table>
@endsection
