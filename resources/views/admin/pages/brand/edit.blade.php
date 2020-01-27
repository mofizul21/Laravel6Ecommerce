@extends('admin.layouts.master')

@section('title')
    Edit Brand
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
            <h1 class="h3 mb-0 text-gray-800">Update Brand</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            
            <!-- Brand Create -->
            <div class="col-md-12 mb-4">

                <div class="row">
                    <div class="col-md-7">
                        @include('admin.partials.message')
                    </div>
                </div>
                
                <form class="user" action="{{route('admin.brands.update', $brands->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Brand Name:</label>
                                <input type="text" name="name" class="form-control" value="{{$brands->name}}">
                            </div>
                            
                            <div class="form-group">
                                <label for="">Brand Image:</label>
                                <br>
                                <img src="{{asset('public/images/brands/'.$brands->image)}}" alt="" height="70">
                                <br>
                                <input type="file" name="image" class="form-control"> 
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Description:</label>
                                <textarea name="description" class="form-control" rows="6">{{$brands->description}}</textarea>
                            </div>

                            <input type="submit" class="btn btn-primary btn-user btn-block" value="Update Brand">
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