@extends('backend.layouts.master')

@section('title', 'File Upload')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">File Upload</h1>
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
                <h5 class="m-0">File Upload</h5>
                <a class="btn btn-success btn-sm" style="margin-left: 69%;" href="{{ route('fileUpload.index') }}"><i class="fa fa-list"></i>File List</a>
              </div>
              {{Form::open(['route' => 'fileUpload.store', 'method' => 'POST', 'id' => 'basic-form'])}}
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">File Name</label>
                                 {{Form::text('name', null, ['class'=>'form-control', 'id' => 'name', 'placeholder' => 'Enter your name', 'required' => true])}}
                            </div>
                            <div class="form-group col-md-6">
                                <label for="category_id">Category</label>
                                {{ Form::select('category_id', [], null, ['class'=>'form-control', 'id' => 'category_id', 'placeholder' => 'Select Category', 'required' => true]) }}
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone">File</label>
                                {{ Form::text('phone', null, ['class'=>'form-control', 'id' => 'phone', 'placeholder' => 'Enter your email', 'required' => true]) }}
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