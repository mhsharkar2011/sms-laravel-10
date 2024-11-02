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
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="first_name">First Name</label>
                                                    <input type="text" name="first_name" class="form-control"
                                                        value="{{ $user->first_name }}">
                                                    <div class="text-red">{{ $errors->first('first_name') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="last_name">Last Name</label>
                                                    <input type="text" name="last_name" class="form-control"
                                                        value="{{ $user->last_name }}">
                                                    <div class="text-red">{{ $errors->first('last_name') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4  text-center">
                                                <div class="form-group"><Label>Profile Photo</Label></div>
                                                <div class="form-group">
                                                    <label for="avatar">
                                                        <x-avatar :avatar="$user->avatar" width="160px" height="160px" class="rounded-circle" />
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" name="avatar" class="custom-file-input">
                                                            <label class="custom-file-label" for="avatar">Choose file</label>
                                                        </div>
                                                    </div>                
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group" style="margin-top: -177px">
                                                    <label for="email">Email Address</label>
                                                    <input type="email" name="email" class="form-control"
                                                        value="{{ $user->email }}">
                                                    <div class="text-red">{{ $errors->first('email') }}</div>
                                                </div>
                                            </div>
                                                <div class="col-sm-4">
                                                <div class="form-group" style="margin-top: -177px">
                                                    <label for="dob">Date of Birth</label>
                                                    <input type="date" name="dob" class="form-control"
                                                        value="{{ $user->dob }}">
                                                    <div class="text-red">{{ $errors->first('dob') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group" style="margin-top: -85px">
                                                    <label for="admission_date">Admission Date</label>
                                                    <input type="date" name="admission_date" class="form-control"
                                                        value="{{ $user->admission_date }}">
                                                    <div class="text-red">{{ $errors->first('admission_date') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group" style="margin-top: -85px">
                                                    <label for="admission_number">Admission Number</label>
                                                    <input type="number" name="admission_number" class="form-control"
                                                        value="{{ $user->admission_number }}">
                                                    <div class="text-red">{{ $errors->first('admission_number') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="roll_number">Roll Number</label>
                                                    <input type="number" name="roll_number" class="form-control"
                                                        value="{{ $user->roll_number }}">
                                                    <div class="text-red">{{ $errors->first('roll_number') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="contact_number">Contact Number</label>
                                                    <input type="text" name="contact_number" class="form-control"
                                                        value="{{ $user->contact_number }}">
                                                    <div class="text-red">{{ $errors->first('contact_number') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="gender">Status</label>
                                                    <select name="gender" id="gender" class="form-control">
                                                        <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                                        <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                                        <option value="Other" {{ $user->gender == 'Other' ? 'selected' : '' }}>Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="religion">Religion</label>
                                                    <select name="religion" id="religion" class="form-control">
                                                        <option value="Islam" {{ $user->religion == 'Islam' ? 'selected' : '' }}>Islam</option>
                                                        <option value="Hindu" {{ $user->religion == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                                        <option value="Boddu" {{ $user->religion == 'Boddu' ? 'selected' : '' }}>Boddu</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="blood_group">Blood Group</label>
                                                    <select name="blood_group" id="blood_group" class="form-control">
                                                        <option value="AB+" {{ $user->blood_group == 'AB+' ? 'selected' : '' }}>AB+</option>
                                                        <option value="B-" {{ $user->blood_group == 'B-' ? 'selected' : '' }}>B-</option>
                                                        <option value="B+" {{ $user->blood_group == 'B+' ? 'selected' : '' }}>B+</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="section">Section</label>
                                                    <select name="section" id="section" class="form-control">
                                                        <option value="A" {{ $user->section == 'A' ? 'selected' : '' }}>A</option>
                                                        <option value="B" {{ $user->section == 'B' ? 'selected' : '' }}>B</option>
                                                        <option value="C" {{ $user->section == 'C' ? 'selected' : '' }}>C</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="height">Height</label>
                                                    <input type="number" name="height" class="form-control"
                                                        value="{{ $user->height }}">
                                                    <div class="text-red">{{ $errors->first('height') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="weight">Weight</label>
                                                    <input type="number" name="weight" class="form-control"
                                                        value="{{ $user->weight }}">
                                                    <div class="text-red">{{ $errors->first('weight') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="status">Class Name</label>
                                                    <select name="class_id" id="" class="form-control">
                                                        @foreach ($getClass as $class )
                                                        <option {{ ($user->class_id == $class->id) ? 'selected' : ''  }} value="{{ $class->id }}">{{ $class->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="status">Status</label>
                                                    <select name="status" id="status" class="form-control">
                                                        <option value="0" {{ $user->status == '0' ? 'selected' : '' }}>Active</option>
                                                        <option value="1" {{ $user->status == '1' ? 'selected' : '' }}>Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div class="card-footer text-center">
                                                        <button type="reset" class="btn btn-warning">Clear</button>
                                                        <button type="submit" name="submit"
                                                            class="btn btn-primary">Save</button>
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
