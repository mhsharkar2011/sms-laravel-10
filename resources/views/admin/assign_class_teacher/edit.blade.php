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
                            <h3 class="card-title">Edit Assign Subject</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('admins.assign_subjects.update', $assignSubject->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                @include('_message')
                                <div class="form-group">
                                    <label for="status">Class Name</label>
                                    <select name="class_id" id="" class="form-control">
                                        <option value="">Select Class</option>
                                        @foreach ($getClass as $class )
                                        <option {{ ($assignSubject->class_id == $class->id) ? 'selected' : ''  }} value="{{ $class->id }}">{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status">Subject Name</label>
                                        @foreach ($getSubject as $subject )
                                            @php
                                            $checked = "";
                                            @endphp
                                            
                                            @foreach ($getAssignSubjectId as $assignSubject)
                                                @if ($assignSubject->subject_id == $subject->id)
                                                @php
                                                $checked = "checked";
                                                @endphp
                                                @endif
                                            @endforeach
                                        <div>
                                            <label for="">
                                                <input {{ $checked }} type="checkbox" value="{{ $subject->id }}" name="subject_id[]"> {{ $subject->name }}
                                            </label>
                                        </div>
                                        @endforeach
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="" class="form-control">
                                        <option {{ ($assignSubject->status == 0) ? 'selected' : ''  }} value="0">Active</option>
                                        <option {{ ($assignSubject->status == 1) ? 'selected' : ''  }} value="1">Inactive</option>
                                    </select>
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
