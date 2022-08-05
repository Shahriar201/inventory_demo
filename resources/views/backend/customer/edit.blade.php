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
                <h5 class="m-0">Edit Customer</h5>
                <a class="btn btn-success btn-sm" style="margin-left: 60%;" href="{{ route('customer.create') }}"><i class="fa fa-list"></i>Customer List</a>
              </div>
              {{Form::model($customer, ['route' => 'customer.store', $customer->id, 'method' => 'PUT', 'id' => 'basic-form'])}}
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                 {{Form::text('name', null, ['class'=>'form-control', 'id' => 'name', 'placeholder' => 'Enter your name', 'required' => true])}}
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                {{ Form::text('email', null, ['class'=>'form-control', 'id' => 'email', 'placeholder' => 'Enter your email', 'required' => true]) }}
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone">Phone</label>
                                {{ Form::text('phone', null, ['class'=>'form-control', 'id' => 'phone', 'placeholder' => 'Enter your email', 'required' => true]) }}
                            </div>
                            <div class="form-group col-md-6">
                                <label for="address">Address</label>
                                {{ Form::text('address', null, ['class'=>'form-control', 'id' => 'address', 'placeholder' => 'Enter your address', 'required' => true]) }}
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