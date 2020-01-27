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
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Create Product</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

      <!-- Product Create -->
      <div class="col-md-12 mb-4">

        <div class="row">
          <div class="col-md-7">
            @include('admin.partials.message')
          </div>
        </div>

        <form class="user" action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Title:</label>
                <input type="text" name="title" class="form-control" placeholder="Title">
              </div>

              <div class="form-group">
                <label for="">Images:</label>
                <input type="file" name="product_image[]" class="form-control"> <br>
                <input type="file" name="product_image[]" class="form-control"> <br>
                <input type="file" name="product_image[]" class="form-control"> <br>
                <input type="file" name="product_image[]" class="form-control"> <br>
                <input type="file" name="product_image[]" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Category:</label>
                <select class="form-control" name="category_id">
                  <option value="">-- Select a Category --</option>
                  @foreach (App\Category::orderBy('name', 'ASC')->where('parent_id', NULL)->get() as
                  $parent)
                    <option value="{{$parent->id}}">{{$parent->name}}</option>

                    @foreach (App\Category::orderBy('name', 'ASC')->where('parent_id',
                    $parent->id)->get() as $child)
                      <option value="{{$child->id}}">---> {{$child->name}}</option>
                    @endforeach
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="">Brand:</label>
                <select class="form-control" name="brand_id">
                  <option value="">-- Select a Brand --</option>
                  @foreach (App\Brand::orderBy('name', 'ASC')->get() as $brand)
                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Price:</label>
                <input type="number" name="price" class="form-control" placeholder="Price">
              </div>
              <div class="form-group">
                <label for="">Quantity:</label>
                <input type="number" name="quantity" class="form-control" placeholder="Quantity">
              </div>
              <div class="form-group">
                <label for="">Description:</label>
                <textarea name="description" class="form-control" rows="8" placeholder="Description"></textarea>
              </div>

              <input type="submit" class="btn btn-primary btn-user btn-block" value="Add Product">
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