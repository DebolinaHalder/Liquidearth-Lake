@extends('layouts.app')

@section('content')

    <div class="container container-table">			<!-- Main div to hold all Data -->

        <!-- Login Form -->
        <div class="row vertical-center-row">

            <h2 class="text-left">Upload file</h2>
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach()
                </div>
            @endif
            <form action="{{ route('file.upload.post') }}" method="POST" enctype="multipart/form-data">
                
                <div class="row">
    
                    <div class="col-md-6">
                        <input type="file" name="file" class="form-control">
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <!-- <div class="col-md-6"> -->
                    &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-success">Upload</button>
                    
    
                </div>
            </form>
        </div>
    </div>

@endsection