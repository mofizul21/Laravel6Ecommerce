@extends('admin.layouts.master')

@section('title')
    All Divisions
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
        <h1 class="h3 mb-2 text-gray-800">Manage Divisions</h1>
        <p class="mb-4">It is easy to manage your brands from here. Here have sorting, paginating and searching option
            with DataTable JS</p>

        <div class="row">
            <div class="col-md-7">
                @include('admin.partials.message')
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Divisions</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Name</th>
                                <th>Priority</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>SL.</th>
                                <th>Name</th>
                                <th>Priority</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($divisions as $division)
                            <tr>
                                <td>{{$division->id}}</td>
                                <td>{{$division->name}}</td>
                                <td>{{$division->priority}}</td>
                                <td>
                                    <a href="{{URL::to('admin/divisions/edit/'.$division->id)}}" class="btn btn-success">Edit</a>
                                    <a data-toggle="modal" href="#deleteModal{{$division->id}}" class="btn btn-danger">Delete</a>

                                    <div class="modal fade" id="deleteModal{{$division->id}}" data-backdrop="static">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Are you sure to delete?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Once delete, it can't be recover.</p>
                                                    <form action="{{URL::to('admin/divisions/delete/'.$division->id)}}" method="POST">
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