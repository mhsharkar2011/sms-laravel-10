@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">My Student List (Total: {{ $getRecord->count() }})</h3>
                            </div>
                            {{-- Search And Filtering Form --}}
                            <form action="" method="get">
                                <div class="card-body">
                                    <div class="row">
                                        <x-input-text col="md-3" label="First Name" type="text" name="first_name"
                                            id="first_name" value="{{ Request::get('first_name') }}"
                                            placeholder="First Name" class="form-control" />
                                        <x-input-text col="md-3" label="Last Name" type="text" name="last_name"
                                            id="last_name" value="{{ Request::get('last_name') }}" placeholder="Last Name"
                                            class="form-control" />
                                        <x-input-text col="md-3" label="Email Name" type="text" name="email"
                                            id="email" value="{{ Request::get('email') }}" placeholder="Email"
                                            class="form-control" />
                                        <x-input-text col="md-3" label="Date" type="date" name="date"
                                            id="date" value="{{ Request::get('date') }}" palceholder=""
                                            class="form-control" />
                                        <div class="form-group col-md-3 ">
                                            <div class="row" style="margin-top:32px">
                                                <x-form-button col="" class="btn-primary">Submit</x-form-button>
                                                <x-link-button col="" class="btn-warning ml-2"
                                                    route="{{ route('admins.index') }}" icon="">Reset</x-link-button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            {{-- Search And Filtering Form --}}
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Roll No</th>
                                            <th>Student Photo</th>
                                            <th>Student Name</th>
                                            <th>Class Name</th>
                                            <th>Subject Name</th>
                                            <th>Student Contact No.</th>
                                            <th>Student Email</th>
                                            <th>Admission Date</th>
                                            <th>Teacher Name</th>
                                            <th>Teacher Contact No.</th>
                                            <th>Teacher Email</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRecord as $value)
                                            <tr>
                                                <td>{{ $value->student_roll_number }}</td>
                                                <td><x-avatar :avatar="$value->avatar" width="48" height="48"
                                                        class="rounded-circle" />
                                                <td>{{ $value->student_name }}</td>
                                                <td>{{ $value->class_name }}</td>
                                                <td>
                                                    @if (!empty($value->subject_names))
                                                        @php
                                                            $subjects = explode(',', $value->subject_names);
                                                        @endphp
                                                        @foreach ($subjects as $index => $subject)
                                                            {{ $subject }}{{ $index < count($subjects) - 1 ? ',' : '' }}<br>
                                                        @endforeach
                                                    @else
                                                        <span class="text-danger">No Subjects</span>
                                                    @endif
                                                </td>
                                                @if (!empty($value->student_contact_number))
                                                    <td>{{ $value->student_contact_number }}</td>
                                                @else
                                                    <td class="text-danger">{{ 'NULL' }}</td>
                                                @endif
                                                <td>{{ $value->student_email }}</td>
                                                <td>{{ date('d-m-Y H:i:A', strtotime($value->student_admission_date)) }}
                                                </td>
                                                <td>{{ $value->teacher_name }}</td>
                                                @if (!empty($value->teacher_contact_number))
                                                    <td>{{ $value->teacher_contact_number }}</td>
                                                @else
                                                    <td class="text-danger">{{ 'NULL' }}</td>
                                                @endif
                                                <td>{{ $value->teacher_email }}</td>
                                                @if ($value->status == '0')
                                                    <td><span class="text-success">Active</span></td>
                                                @else
                                                    <td>
                                                        <span class="text-danger">
                                                            Inactive
                                                        </span>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Roll No</th>
                                            <th>Student Photo</th>
                                            <th>Student Name</th>
                                            <th>Class Name</th>
                                            <th>Subject Name</th>
                                            <th>Student Contact No.</th>
                                            <th>Student Email</th>
                                            <th>Admission Date</th>
                                            <th>Teacher Name</th>
                                            <th>Teacher Contact No.</th>
                                            <th>Teacher Email</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
    </div>
@endsection
