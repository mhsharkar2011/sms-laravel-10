@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title btn btn-flat">User List</h3>
                                <a href="{{ url('admins/create') }}" class="card-title float-right btn btn-sm btn-primary">New User</a>
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
                                            <th>Attendance Progress</th>
                                            <th>Created At</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    @foreach ($getAdmin as $user )
                                    <tbody>
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td><x-avatar :user="$user->avatar" width="48" height="48" class="rounded-circle" />
                                            <td>{{$user->email }}</td>
                                            <td>Attendance Process</td>
                                            <td>{{$user->created_at }}</td>
                                            <td>Status</td>
                                            <td class="project-actions text-start">
                                                <a class="btn btn-primary btn-sm" href="{{ url('admins/profile', $user->id) }}"><i class="fas fa-eye"></i></a>
                                                <a class="btn btn-info btn-sm" href="{{ url('admins/profile/edit',$user->id) }}"><i class="fas fa-pencil-alt"></i></a>
                                                <a class="btn btn-danger btn-sm" href="{{ url('admins/delete',$user->id) }}"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                    <tfoot>
                                        <tr>
                                            <th>Roll No.</th>
                                            <th>Name</th>
                                            <th>Photo</th>
                                            <th>Attendance Progress</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
