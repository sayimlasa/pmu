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
                            <li class="breadcrumb-item"><a class="btn btn-success" href=" ">Record New Contract</a></li>


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
            <tr>
                <th>S/N</th>
                <th>Name</th>
                <th>Starting Date</th>
                <th>Ending Date</th>
                <th>Contract Duration</th>
                <th>Action</th>
            </tr>


        </table>

@endsection
