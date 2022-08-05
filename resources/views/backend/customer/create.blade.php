@extends('backend.layouts.master')

@section('title', 'Customers List')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Customer</h1>
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
                <h5 class="m-0">Customer</h5>
                <a class="btn btn-success btn-sm" style="margin-left: 69%;" href="{{ route('customer.create') }}"><i class="fa fa-list"></i>Customer List</a>
              </div>
              {{Form::open(['route' => 'customer.store', 'method' => 'POST', 'id' => 'basic-form'])}}
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                {{-- <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                 --}}
                                 {{Form::text('name', null, ['class'=>'form-control', 'id' => 'name', 'placeholder' => 'Enter name', 'required' => true])}}
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="form-group mb-0">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                                <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of service</a>.</label>
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