@extends('admin.layouts.app')

@section('content')
    <!-- Main content -->
    <div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <!-- left column -->
                <div class="col-md-6 mt-4">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">New User Add</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('admins.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                @include('_message')
                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required placeholder="Enter Name">
                                    <div class="text-red">{{ $errors->first('name') }}</div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="Enter email">
                                    <div class="text-red">{{ $errors->first('email') }}</div>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" required placeholder="Password">
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer text-center">
                                    <button type="reset" class="btn btn-warning">Clear</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    </div>
@endsection