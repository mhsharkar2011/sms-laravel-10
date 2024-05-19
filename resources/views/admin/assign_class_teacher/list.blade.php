@extends('admin.layouts.app')

@section('content')
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Assign Subject List</h3>
                <a href="{{ route('admins.assign_class_teachers.create') }}" class="card-title float-right btn btn-sm btn-primary">New Assign Teachers</a>
              </div>
              {{-- Search And Filtering Form--}}
              <form action="" method="get">
                <div class="card-body">
                  <div class="row">
                    <x-input-text col="md-3" label="Class Name" type="text" name="class_name" id="class_name" value="{{ Request::get('class_name') }}" placeholder="Class Name" class="form-control" />
                    <x-input-text col="md-3" label="Subject Name" type="text" name="subject_name" id="subject_name" value="{{ Request::get('teacher_name') }}" placeholder="Teacher Name" class="form-control" />
                    <x-input-text col="md-3" label="Date" type="date" name="date" id="date" value="{{ Request::get('date') }}" palceholder="" class="form-control" />
                    <div class="form-group col-md-3 ">
                      <div class="row" style="margin-top:32px">
                        <x-form-button col="" class="btn-primary">Submit</x-form-button>
                        <x-link-button col="" class="btn-warning ml-2"  route="{{ route('admins.assign_class_teachers.index') }}" icon="">Reset</x-link-button>
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
                            <th>SL No.</th>
                            <th>Class Name</th>
                            <th>Teacher Name</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assignTeachers as $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->class_name }}</td>
                                <td>{{ $value->teacher_name }}</td>
                                <td>
                                    @if ($value->status == 0)
                                        Active
                                    @else
                                        Inactive
                                    @endif
                                </td>
                                <td>{{ $value->created_by_name }}</td>
                                <td>{{ date('d-m-Y H:i:A', strtotime($value->created_at)) }}</td>
                                <td class="project-actions text-start">
                                    {{-- <a class="btn btn-info btn-sm" href="{{ route('admins.assign_subjects.show',$value->id) }}"><i class="fas fa-eye"></i></a> --}}
                                    <a class="btn btn-info btn-sm"
                                        href="{{ route('admins.assign_class_teachers.edit', $value->id) }}"><i
                                            class="fas fa-pencil-alt"></i></a>
                                    <a class="btn btn-danger btn-sm"
                                        href="{{ url('admins/assign_calss_teachers', $value->id) }}"><i
                                            class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>SL No.</th>
                            <th>Class Name</th>
                            <th>Teacher Name</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
