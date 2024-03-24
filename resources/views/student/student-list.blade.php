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
                      <h3 class="card-title">Student List</h3>
                      <a href="{{ url('admins/create') }}" class="card-title float-right btn btn-sm btn-primary">Add New Student</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>SL No.</th>
                          <th>Name</th>
                          <th>Photo</th>
                          <th>Email</th>
                          <th>Created At</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($getStudent as $value )
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->name }}</td>
                                <td><x-avatar :avatar="$value->avatar" width="48" height="48" class="rounded-circle" />
                                <td>{{$value->email }}</td>
                                <td>{{$value->created_at }}</td>
                                <td>Status</td>
                                <td class="project-actions text-start">
                                    <a class="btn btn-primary btn-sm" href="{{ url('admins/profile', $value->id) }}"><i class="fas fa-eye"></i></a>
                                    <a class="btn btn-info btn-sm" href="{{ url('admins/profile/edit',$value->id) }}"><i class="fas fa-pencil-alt"></i></a>
                                    <a class="btn btn-danger btn-sm" href="{{ url('admins/delete',$value->id) }}"><i class="fas fa-trash"></i></a>
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
                            <th>Created At</th>
                            <th>Status</th>
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
