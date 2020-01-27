@extends('admin.layouts.master')

@section('content')
<!-- Main Content -->
<div id="content">

    <!-- Topbar -->
    @include('admin.partials.topbar')
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Manage Products</h1>
        <p class="mb-4">It is easy to manage your products from here. Here have sorting, paginating and searching option
            with DataTable JS</p>

        <div class="row">
            <div class="col-md-7">
                @include('admin.partials.message')
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Products</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>SL.</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td><a href="{{URL::to('/products/'.$product->slug)}}" target="_blank">{{$product->title}}</a></td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->quantity}}</td>
                                <td>
                                    <a href="{{URL::to('admin/product/edit/'.$product->id)}}" class="btn btn-success">Edit</a>
                                    <a data-toggle="modal" href="#deleteModal{{$product->id}}" class="btn btn-danger">Delete</a>

                                    <div class="modal fade" id="deleteModal{{$product->id}}" data-backdrop="static">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Are you sure to delete?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>It'll delete all images under the product. Once delete, it can't be recovered.</p>
                                                    <form action="{{URL::to('admin/product/delete/'.$product->id)}}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary">Go Proceed</button>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end .modal -->

                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                    
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    

</div>
<!-- End of Main Content -->
@endsection