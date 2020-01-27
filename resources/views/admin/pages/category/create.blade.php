@extends('admin.layouts.master')

@section('title')
    Add Category
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
            <h1 class="h3 mb-0 text-gray-800">Create Category</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            
            <!-- Category Create -->
            <div class="col-md-12 mb-4">

                <div class="row">
                    <div class="col-md-7">
                        @include('admin.partials.message')
                    </div>
                </div>
                
                <form class="user" action="{{route('admin.category.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Category Name:</label>
                                <input type="text" name="name" class="form-control" placeholder="Name">
                            </div>
                            
                            <div class="form-group">
                                <label for="">Category Images:</label>
                                <input type="file" name="image" class="form-control"> 
                            </div>
                            <div class="form-group">
                                <label for="">Parent Category:</label>
                                <select name="parent_id" id="" class="form-control">
                                    <option value="">-- Select Parent Category --</option>
                                    @foreach ($main_categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Description:</label>
                                <textarea name="description" class="form-control" rows="6" placeholder="Description"></textarea>
                            </div>

                            <input type="submit" class="btn btn-primary btn-user btn-block" value="Add Category">
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