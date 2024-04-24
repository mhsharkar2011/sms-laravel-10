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
                            <h3 class="card-title">New Parent Add</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('admins.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                @include('_message')
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" required placeholder="Enter First Name">
                                    <div class="text-red">{{ $errors->first('first_name') }}</div>
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required placeholder="Enter Last Name">
                                    <div class="text-red">{{ $errors->first('last_name') }}</div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="Enter email">
                                    <div class="text-red">{{ $errors->first('email') }}</div>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                    <div class="text-red">{{ $errors->first('password') }}</div>
                                </div>
                                <div class="form-group">
                                    <label for="user_type">User Type</label>
                                    <select name="user_type" id="" class="form-control">
                                        <option value="4">Parent</option>
                                    </select>
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
