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
                <h5 class="m-0">Product</h5>
                <a class="btn btn-success btn-sm" style="margin-left: 69%;" href="{{ route('product.create') }}"><i class="fa fa-plus-circle"></i>Add Product</a>
              </div>
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Category</th>
                      <th>Name</th>
                      <th>Code</th>
                      <th>Total Stock</th>
                      <th>Price</th>
                      <th>Image</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($products as $key => $product )
                      <tr class="">
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $product->category_id ?? '' }}</td>
                        <td>{{ $product->name ?? '' }}</td>
                        <td>{{ $product->code ?? '' }}</td>
                        <td>{{ $product->total_stock ?? '' }}</td>
                        <td>{{ $product->price ?? '' }}</td>
                        <td>{{ $product->image ?? '' }}</td>
                        <td>
                          <a title="Edit" id="edit" class="btn btn-sm btn-primary" href="{{ route('product.edit', $product->id)}}">
                              <i class="fa fa-edit"></i>
                          </a>
                          <a title="Delete" id="delete" class="btn btn-sm btn-danger" href="{{ route('product.destroy', $product->id) }}">
                              <i class="fa fa-trash"> </i>
                          </a>
                      </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection