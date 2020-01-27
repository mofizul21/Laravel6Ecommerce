@extends('admin.layouts.master')

@section('title')
All Orders
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
        <h1 class="h3 mb-2 text-gray-800">Manage Orders</h1>
        <p class="mb-4">It is easy to manage your categories from here. Here have sorting, paginating and searching
            option
            with DataTable JS</p>

        <div class="row">
            <div class="col-md-7">
                @include('admin.partials.message')
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Orders</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Oder ID.</th>
                                <th>Orderer Name</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Oder ID.</th>
                                <th>Orderer Name</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td>#LE{{$order->id}}</td>
                                <td>{{$order->name}}</td>
                                <td>{{$order->phone_no}}</td>
                                <td>
                                    <p>
                                        @if ($order->is_seen_by_admin)
                                        <button class="btn btn-info btn-sm">Seen</button>
                                        @else
                                        <button class="btn btn-success btn-sm">Unseen</button>
                                        @endif
                                    </p>
                                    <p>
                                        @if ($order->is_completed)
                                        <button class="btn btn-info btn-sm">Completed</button>
                                        @else
                                        <button class="btn btn-warning btn-sm">Uncompleted</button>
                                        @endif
                                    </p>
                                    <p>
                                        @if ($order->is_paid)
                                        <button class="btn btn-info btn-sm">Paid</button>
                                        @else
                                        <button class="btn btn-dark btn-sm">Unpaid</button>
                                        @endif
                                    </p>
                                </td>
                                <td>
                                    <a href="{{route('admin.order.show', $order->id)}}" class="btn btn-success">View</a>
                                    <a data-toggle="modal" href="#deleteModal{{$order->id}}"
                                        class="btn btn-danger">Delete</a>

                                    <div class="modal fade" id="deleteModal{{$order->id}}" data-backdrop="static">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Are you sure to
                                                        delete?</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Once delete, it can't be recover.</p>
                                                    <form action="{{URL::to('admin/order/delete/'.$order->id)}}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary">Go
                                                            Proceed</button>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
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