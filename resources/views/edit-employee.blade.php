@extends('adminlte::page')
@section('title', 'Employee Management')

@section('content_header')
    <div class="row">
        <div class="col-9">
            <h1>Employee</h1>
        </div>
    </div>
@stop
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-danger">
                        <div class="card-header">
                            <div class="d-flex">
                                <h3 class="card-title">Update Employee</h3>

                                <div class="ml-auto">
                                    <a href="{{ url('employee') }}">
                                        <button class="btn btn-dark btn-xs"><span class="fa fa-list"></span> Employee
                                            Lists
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('employee.update', $employee->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="Name">Name</label>
                                            <input type="text" name="name" class="form-control" value="{{ $employee->name }}" placeholder="Name"
                                                   id="Name">
                                        </div>
                                        <div>
                                            @if ($errors->has('name'))
                                                <div class="text-danger">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="Mobile">Mobile</label>
                                            <input type="text" name="mobile" class="form-control" value="{{ $employee->mobile }}" placeholder="Mobile"
                                                   id="Mobile">
                                        </div>
                                        <div>
                                            @if ($errors->has('mobile'))
                                                <div class="text-danger">
                                                    <strong>{{ $errors->first('mobile') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="Email">Email</label>
                                            <input type="text" name="email" class="form-control" value="{{ $employee->email }}" placeholder="Email"
                                                   id="Email">
                                        </div>
                                        <div>
                                            @if ($errors->has('email'))
                                                <div class="text-danger">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="formFile" class="form-label">Choose Image</label>
                                        <input class="form-control" name="image" type="file" id="formFile">
                                        <img src="{{ asset('/image/') }}/{{$employee->image}}" width="200px">
                                    </div>
                                    <div>
                                        @if ($errors->has('image'))
                                            <div class="text-danger">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>


                                <div class="button mt-2">
                                    <button class="btn btn-primary">Edit Employee</button>
                                </div>

                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@stop
@section('plugins.Sweetalert2', true)
@section('js')
    <script>

    </script>
@stop
