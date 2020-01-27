@extends('admin.layouts.master')

@section('title')
    Add Division
@endsection

@section('content')
<!-- Main Content -->
<div id="content">

    <!-- Topbar -->
    @include('admin.partials.topbar')
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Create Division</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            
            <!-- Division Create -->
            <div class="col-md-12 mb-4">

                <div class="row">
                    <div class="col-md-7">
                        @include('admin.partials.message')
                    </div>
                </div>
                
                <form class="user" action="{{route('admin.divisions.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Division Name:</label>
                                <input type="text" name="name" class="form-control" placeholder="Name">
                            </div>

                            <div class="form-group">
                                <label for="">Priority:</label>
                                <input type="text" name="priority" class="form-control" placeholder="Priority">
                            </div>

                            <input type="submit" class="btn btn-primary btn-user btn-lg" value="Add Division">
                        </div>
                    </div>

                </form>
            </div>


        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
@endsection