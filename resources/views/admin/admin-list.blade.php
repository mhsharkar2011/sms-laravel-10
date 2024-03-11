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
                                <a href="{{ url('admins/create') }}" class="card-title float-right btn btn-sm btn-primary">Admin List</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Roll No.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
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
                                            <td>Edit</td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                    <tfoot>
                                        <tr>
                                            <th>Roll No.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
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
