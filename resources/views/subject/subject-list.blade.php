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
                      <h3 class="card-title">Subject List</h3>
                      <a href="{{ url('admins/subjects/create') }}" class="card-title float-right btn btn-sm btn-primary">New Subject Add</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>SL No.</th>
                          <th>Name</th>
                          <th>Status</th>
                          <th>Created By</th>
                          <th>Created At</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($getSubject as $subject )
                            <tr>
                                <td>{{ $subject->id }}</td>
                                <td>{{ $subject->name }}</td>
                                <td>
                                  @if ($subject->status == 0)
                                    Active
                                  @else
                                    Inactive
                                  @endif
                                </td>
                                <td>{{$subject->created_by_name }}</td>
                                <td>{{$subject->created_at }}</td>
                                <td class="project-actions text-start">
                                    <a class="btn btn-info btn-sm" href="{{ route('admins.subjects.edit',$subject->id) }}"><i class="fas fa-pencil-alt"></i></a>
                                    <a class="btn btn-danger btn-sm" href="{{ route('admins.subjects.delete',$subject->id) }}"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>SL No.</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th>Created At</th>
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
