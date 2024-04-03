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
                            <h3 class="card-title">Change Password</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="" method="POST">
                            @csrf
                            <div class="card-body">
                                @include('_message')
                                <div class="form-group">
                                    <label for="name">Old Password</label>
                                    <input type="password" name="old_password" class="form-control" value="{{ old('old_password') }}" required placeholder="Enter Old Passwors">
                                    <div class="text-red">{{ $errors->first('change_password') }}</div>
                                </div>
                                <div class="form-group">
                                    <label for="name">Confirm Password</label>
                                    <input type="password" name="new_password" class="form-control" value="{{ old('new_password') }}" required placeholder="Enter New Password">
                                    <div class="text-red">{{ $errors->first('change_password') }}</div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
