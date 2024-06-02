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
                      <h3 class="card-title">Student List (Total: {{ $getRecord->count() }})</h3>
                      <a href="{{ route('admins.students.create') }}" class="card-title float-right btn btn-sm btn-primary">Add New Student</a>
                    </div>
                  {{-- Search And Filtering Form--}}
                  <form action="" method="get">
                    <div class="card-body">
                      <div class="row">
                        <x-input-text col="md-3" label="First Name" type="text" name="first_name" id="first_name" value="{{ Request::get('first_name') }}" placeholder="First Name" class="form-control" />
                        <x-input-text col="md-3" label="Last Name" type="text" name="last_name" id="last_name" value="{{ Request::get('last_name') }}" placeholder="Last Name" class="form-control" />
                        <x-input-text col="md-3" label="Email Name" type="text" name="email" id="email" value="{{ Request::get('email') }}" placeholder="Email" class="form-control" />
                        <x-input-text col="md-3" label="Date" type="date" name="date" id="date" value="{{ Request::get('date') }}" palceholder="" class="form-control" />
                        <div class="form-group col-md-3 ">
                          <div class="row" style="margin-top:32px">
                            <x-form-button col="" class="btn-primary">Submit</x-form-button>
                            <x-link-button col="" class="btn-warning ml-2"  route="{{ route('admins.students.index') }}" icon="">Reset</x-link-button>
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
                          <th>Roll No.</th>
                          <th>Photo</th>
                          <th>Full Name</th>
                          <th>Parent Name</th>
                          <th>Email</th>
                          <th>Admission No.</th>
                          <th>Class</th>
                          <th>Gender</th>
                          <th>Date Of Birth</th>
                          <th>Religion</th>
                          <th>Contact No.</th>
                          <th>Admission Date</th>
                          <th>Blood Group</th>
                          <th>Height</th>
                          <th>Weight</th>
                          <th>Status</th>
                          <th>Created By</th>
                          <th>Created Date</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($getRecord as $value )
                            <tr>
                                <td>{{ $value->roll_number }}</td>
                                <td><x-avatar :avatar="$value->avatar" width="48" height="48" class="rounded-circle" />
                                <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                                <td>{{$value->parent_name }}</td>
                                <td>{{$value->email }}</td>
                                <td>{{$value->admission_number }}</td>
                                <td>{{$value->class_name }}</td>
                                <td>{{$value->gender }}</td>
                                <td>{{$value->dob }}</td>
                                <td>{{$value->religion }}</td>
                                <td>{{$value->contact_number }}</td>
                                <td>{{$value->admission_date }}</td>
                                <td>{{$value->blood_group }}</td>
                                <td>{{$value->height }}</td>
                                <td>{{$value->weight }}</td>
                                <td>
                                  @if ($value->status == 0)
                                  <span class="text-success">Active</span>
                                @else
                                  <span class="text-danger">Inactive</span>
                                @endif
                                </td>
                                <td>{{ $value->created_by_name }}</td>
                                <td>{{date('d-m-Y H:i:A', strtotime($value->created_at)) }}</td>
                                <td class="project-actions text-nowrap">
                                  <x-action-button :userId="$value->id"/>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                          <th>Roll No.</th>
                          <th>Photo</th>
                          <th>Full Name</th>
                          <th>Parent Name</th>
                          <th>Email</th>
                          <th>Admission No.</th>
                          <th>Class</th>
                          <th>Gender</th>
                          <th>Date Of Birth</th>
                          <th>Religion</th>
                          <th>Contact No.</th>
                          <th>Admission Date</th>
                          <th>Blood Group</th>
                          <th>Height</th>
                          <th>Weight</th>
                          <th>Status</th>
                          <th>Created By</th>
                          <th>Created Date</th>
                          <th>Action</th>
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
