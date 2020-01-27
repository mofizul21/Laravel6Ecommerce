@extends('admin.layouts.master')

@section('title')
    All Sliders
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
        <h1 class="h3 mb-2 text-gray-800">Manage Sliders</h1>
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
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="m-0 font-weight-bold text-primary">All Sliders</h6>
                    </div>
                    <div class="col-md-6">
                        <h6 class="m-0 font-weight-bold text-primary float-right"><a href="#addSlider" data-toggle="modal" class="btn btn-info">Add New Slider</a></h6>
                    </div>
                </div>

                <div class="modal fade" id="addSlider" data-backdrop="static">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Add a New Slider</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                
                                <form action="{{route('admin.slider.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Title: <small class="text-danger">(required)</small></label>
                                        <input type="text" class="form-control" name="title" placeholder="Slider Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Image: <small class="text-danger">(required)</small></label>
                                        <input type="file" class="form-control" name="image" id="image">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Button Text: <small class="text-info">(optional)</small></label>
                                        <input type="text" class="form-control" name="button_text" id="button_text" placeholder="Slider Button Text">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Button Link: <small class="text-info">(optional)</small></label>
                                        <input type="url" class="form-control" name="button_link" id="button_link" placeholder="Slider Button Link">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Slider Priority: <small class="text-danger">(required)</small></label>
                                        <input type="number" class="form-control" name="priority" id="priority" placeholder="Slider Priority; e.g: 10">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add 
                                        Slider
                                    </button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div> <!-- end .modal -->

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Slider Title</th>
                                <th>Slider Image</th>
                                <th>Slider Priority</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>SL.</th>
                                <th>Slider Title</th>
                                <th>Slider Image</th>
                                <th>Slider Priority</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($sliders as $slider)
                            <tr>
                                <td>{{$loop->index + 1}}</td>
                                <td>{{$slider->title}}</td>
                                <td><img src="{{asset('public/images/sliders/'.$slider->image)}}" alt="" height="50"></td>
                                <td>{{$slider->priority}}</td>
                                <td>
                                    <a data-toggle="modal" href="#updateSlider{{$slider->id}}" class="btn btn-success">Edit</a>
                                    <a data-toggle="modal" href="#deleteModal{{$slider->id}}" class="btn btn-danger">Delete</a>

                                    <!-- delete .modal -->
                                    <div class="modal fade" id="deleteModal{{$slider->id}}" data-backdrop="static">
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
                                                    <form action="{{route('admin.slider.delete', $slider->id)}}" method="POST">
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

                                    <!-- update .modal -->
                                    <div class="modal fade" id="updateSlider{{$slider->id}}" data-backdrop="static">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Update Slider</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                    
                                                    <form action="{{route('admin.slider.update', $slider->id)}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="">Title: <small class="text-danger">(required)</small></label>
                                                            <input type="text" class="form-control" name="title" value="{{$slider->title}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Image: <small class="text-danger">(required)</small></label>
                                                            <input type="file" class="form-control" name="image" id="image">
                                                            <p>Old Image:</p>
                                                            <img src="{{asset('public/images/sliders/'.$slider->image)}}" alt="" height="50">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Button Text: <small class="text-info">(optional)</small></label>
                                                            <input type="text" class="form-control" name="button_text" id="button_text"
                                                                value="{{$slider->button_text}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Button Link: <small class="text-info">(optional)</small></label>
                                                            <input type="url" class="form-control" name="button_link" id="button_link"
                                                                value="{{$slider->button_link}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Slider Priority: <small class="text-danger">(required)</small></label>
                                                            <input type="number" class="form-control" name="priority" id="priority"
                                                                value="{{$slider->priority}}">
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Update
                                                            Slider
                                                        </button>
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
