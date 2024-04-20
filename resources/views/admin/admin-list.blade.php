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
                      <h3 class="card-title">User List</h3>
                      <a href="{{ url('admins/create') }}" class="card-title float-right btn btn-sm btn-primary">Add New User</a>
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
                          <th>User Type</th>
                          <th>Status</th>
                          <th>Created By</th>
                          <th>Created Date</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($getUser as $value )
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                                <td><x-avatar :avatar="$value->avatar" width="48" height="48" class="rounded-circle" />
                                <td>{{$value->email }}</td>
                                <td>
                                  @if ($value->user_type == 1)
                                    Admin
                                  @elseif ($value->user_type == 2)
                                    Teacher
                                    @elseif ($value->user_type == 3)
                                    Student
                                    @elseif ($value->user_type == 4)
                                    Parent
                                  @endif
                                </td>
                                <td>
                                  @if ($value->is_delete == 0)
                                  Active
                                @else
                                  <span class="text-danger">Inactive</span>
                                @endif
                                </td>
                                <td>{{ $value->created_by_name }}</td>
                                <td>{{date('d-m-Y H:i:A', strtotime($value->created_at)) }}</td>
                                <td class="project-actions text-nowrap">
                                    <a class="btn btn-primary btn-sm" href="{{ url('admins/profile', $value->id) }}"><i class="far fa-eye"></i></a>
                                    <a class="btn btn-info btn-sm" href="{{ url('profile/edit',$value->id) }}"><i class="fas fa-pen"></i></a>
                                    <a class="btn btn-danger btn-sm" href="{{ url('admins/delete',$value->id) }}"><i class="fas fa-user-minus"></i></a>
                                    <a class="btn btn-warning btn-sm" href="{{ url('admins/restore',$value->id) }}"><i class="fas fa-user-plus"></i></a>
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                          <th>SL No.</th>
                          <th>Name</th>
                          <th>Photo</th>
                          <th>Email</th>
                          <th>User Type</th>
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
