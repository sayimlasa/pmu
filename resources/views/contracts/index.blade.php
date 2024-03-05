@extends('home')
@section('content')
    <div class="container mt-2">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Contract List</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a class="btn btn-success" href="{{route('contract.create')}}">Record
                                    New Contract</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>S/N</th>
                <th>Name</th>
                <th>Starting Date</th>
                <th>Ending Date</th>
                <th>Contract Duration</th>
                <th>Remain Time</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @php($count=1)
            @foreach($contracts as $c)
                <tr>
                    <td>{{$count++}}</td>
                    <td>{{$c->name}}</td>
                    <td>{{$c->startd}}</td>
                    <td>{{$c->endd}}</td>
                    <td>{{$c->duration}}</td>
                    <td>{{$currentTime->diffAsCarbonInterval($c->endd)}}</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('contract.show',$c->id) }}"><i class="fa fa-eye"></i></a>
                        <a class="btn btn-primary" href="{{ route('contract.edit',$c->id) }}"><i class="fa fa-edit"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
@endsection
