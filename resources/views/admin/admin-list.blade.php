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
                                <h3 class="card-title btn btn-flat">Admin List</h3>
                                <a href="{{ url('admins/create') }}" class="card-title float-right btn btn-sm btn-primary">Add Admin</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Roll No.</th>
                                            <th>Name</th>
                                            <th>Photo</th>
                                            <th>Attendance Progress</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    @foreach ($admins as $admin )
                                    <tbody>
                                        <tr>
                                            <td>{{ $admin->id }}</td>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{$admin->email }}</td>
                                            <td>{{$admin->created_at }}</td>
                                            <td>{{$admin->updated_at }}</td>
                                            <td class="project-actions text-start">
                                                <a class="btn btn-primary btn-sm" href="{{ url('admins/profile') }}"><i class="fas fa-folder"></i> View</a>
                                                <a class="btn btn-info btn-sm" href=""><i class="fas fa-pencil-alt"></i> Edit</a>
                                               

                                                <form action="{{ route('admins.destroy', $admin->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn btn-danger btn-sm" href="#"><i class="fas fa-trash"></i> Delete</a>
                                                </form>
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
