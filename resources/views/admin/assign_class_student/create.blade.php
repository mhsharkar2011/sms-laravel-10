@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-6 mt-4">
                        <div class="card card-primary">
                            <div class="card-header"><h3 class="card-title">Assign Student</h3></div>
                            <form action="{{ route('admins.assign_class_students.store') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    @include('_message')
                                    <div class="form-group">
                                        <label for="status">Class Name</label>
                                        <select name="class_id" id="" class="form-control">
                                            <option value="">Select Class</option>
                                            @foreach ($classes as $class)
                                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Students Name</label>
                                        @foreach ($students as $student)
                                        <div>
                                            <label for="">
                                            @if (empty($student->student_id))
                                            <input type="checkbox" value="{{ $student->id }}" name="student_id[]"> 
                                            {{ $student->full_name }}
                                            @endif
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" id="" class="form-control">
                                            <option value="0">Active</option>
                                            <option value="1">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="card-footer text-center">
                                        <button type="reset" class="btn btn-warning">Clear</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
