@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Teacher List</h3>
                      @if (Auth::user()->user_type == 1)
                      <a href="{{ route('admins.teachers.create') }}" class="card-title float-right btn btn-sm btn-primary">Add New Teacher</a>
                      @endif
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>SL No.</th>
                          <th>Full Name</th>
                          <th>Photo</th>
                          <th>Email</th>
                          <th>Status</th>
                          <th>Created By</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($getTeacher as $value )
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                                <td><x-avatar :avatar="$value->avatar" width="48" height="48" class="rounded-circle" />
                                <td>{{$value->email }}</td>
                                <td>
                                  @if ($value->is_delete == 0)
                                  Active
                                @else
                                  <span class="text-danger">Inactive</span>
                                @endif
                                </td>
                                <td>{{$value->created_by_name }}</td>
                                <td class="project-actions text-start">
                                    <a class="btn btn-primary btn-sm" href="{{ route('admins.teachers.show', $value->id) }}"><i class="fas fa-eye"></i></a>
                                    <a class="btn btn-info btn-sm" href="{{ route('admins.teachers.edit',$value->id) }}"><i class="fas fa-pencil-alt"></i></a>
                                    <a class="btn btn-danger btn-sm" href="{{ route('admins.teachers.destroy',$value->id) }}"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                          <tr>
                            <th>SL No.</th>
                            <th>Full Name</th>
                            <th>Photo</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Created By</th>
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
