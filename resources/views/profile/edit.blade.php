@extends('admin.layouts.app')

@section('content')
    <!-- Main content -->
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <!-- left column -->
                    <div class="col-md-12 mt-4">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Profile Update</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @auth
                                <form action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <div class="form-group">
                                                    <label for="first_name">First Name</label>
                                                    <input type="text" name="first_name" class="form-control"
                                                        value="{{ $user->first_name }}">
                                                    <div class="text-red">{{ $errors->first('first_name') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="form-group">
                                                    <label for="last_name">Last Name</label>
                                                    <input type="text" name="last_name" class="form-control"
                                                        value="{{ $user->last_name }}">
                                                    <div class="text-red">{{ $errors->first('last_name') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2 border rounded-lg text-center">
                                                <div class="form-group"><Label>Profile Photo</Label></div>
                                                <div class="form-group">
                                                    <label for="avatar">
                                                        <x-avatar :avatar="$user->avatar" width="80px" height="80px" class="rounded-circle" />
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="email">Email Address</label>
                                                    <input type="email" name="email" class="form-control"
                                                        value="{{ $user->email }}">
                                                    <div class="text-red">{{ $errors->first('email') }}</div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Date of Birth</label>
                                                    <input type="date" name="dob" class="form-control"
                                                        value="{{ $user->dob }}">
                                                    <div class="text-red">{{ $errors->first('dob') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="admission_number">Admission Number</label>
                                                    <input type="text" name="admission_number" class="form-control"
                                                        value="{{ $user->admission_number }}">
                                                    <div class="text-red">{{ $errors->first('admission_number') }}</div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Roll Number</label>
                                                    <input type="text" name="roll_number" class="form-control"
                                                        value="{{ $user->roll_number }}">
                                                    <div class="text-red">{{ $errors->first('roll_number') }}</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="card-footer text-center">
                                                        <button type="reset" class="btn btn-warning">Clear</button>
                                                        <button type="submit" name="submit"
                                                            class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </form>
                            @endauth
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
