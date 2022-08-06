@extends('backend.layouts.master')

@section('title', 'Product List')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-2"></div>
          <div class="col-lg-8">
            <div class="card">
              <div class="card-header d-flex">
                <h5 class="m-0">Edit Product</h5>
                <a class="btn btn-success btn-sm" style="margin-left: 60%;" href="{{ route('customer.index') }}"><i class="fa fa-list"></i>Product List</a>
              </div>
              {{Form::model($product, ['route' => ['customer.update', $product->id], 'method' => 'PUT', 'id' => 'basic-form', 'files'=>true])}}
                <div class="card-body">
                    <div class="form-group">
                      <div class="row">
                        <div class="form-group col-md-6">
                            <label for="category_id">Category</label>
                            {{Form::select('category_id', $category, null, ['class' => 'form-control', 'id'=>'category_id', 'placeholder' => 'Select Category', 'required' => true])}}
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name">Name</label>
                             {{Form::text('name', null, ['class'=>'form-control', 'id' => 'name', 'placeholder' => 'Enter name', 'required' => true])}}
                        </div>
                        {{-- <div class="form-group col-md-6">
                            <label for="total_stock">Total Stock</label>
                            {{ Form::text('total_stock', null, ['class'=>'form-control', 'id' => 'total_stock', 'placeholder' => 'Enter total item', 'required' => true]) }}
                        </div> --}}
                        <div class="form-group col-md-6">
                            <label for="price">Price</label>
                            {{ Form::text('price', null, ['class'=>'form-control', 'id' => 'price', 'placeholder' => 'Enter product price', 'required' => true]) }}
                        </div>
                        <div class="form-group col-md-6">
                            <label for="image">Image</label>
                            {{ Form::file('image', ['class'=>'form-control', 'id' => 'image', 'required' => true]) }}
                            {{-- <input type="file" name="image" class="form-control" id="image" required> --}}
                        </div>
                        <div class="form-group col-md-6">
                          <img id="showImage" src="{{ (!empty($product->image))?url('public/uploads/product_images/'.$product->image):url('uploads/no_image.jpg') }}"
                          style="width: 150px; height: 160px; border: 1px solid #000; object-fit: cover;">
                        </div>
                    </div>
                </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
             {{Form::close()}}
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection