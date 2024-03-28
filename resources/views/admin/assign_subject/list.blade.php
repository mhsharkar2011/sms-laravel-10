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
                      <h3 class="card-title">Assign Subject List</h3>
                      <a href="{{ url('assign_subjects/create') }}" class="card-title float-right btn btn-sm btn-primary">New Assign Subject</a>
                    </div>

                    {{-- Search And Filtering --}}
                    <x-search-form />
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>SL No.</th>
                          <th>Class Name</th>
                          <th>Subject Name</th>
                          <th>Status</th>
                          <th>Created By</th>
                          <th>Created At</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($assignSubjects as $value )
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->class_name }}</td>
                                <td>{{ $value->subject_name }}</td>
                                <td>
                                  @if ($value->status == 0)
                                    Active
                                  @else
                                    Inactive
                                  @endif
                                </td>
                                <td>{{ $value->created_by_name }}</td>
                                <td>{{date('d-m-Y H:i:A', strtotime($value->created_at)) }}</td>
                                <td class="project-actions text-start">
                                    <a class="btn btn-info btn-sm" href="{{ url('assign_subjects/edit',$value->id) }}"><i class="fas fa-pencil-alt"></i></a>
                                    <a class="btn btn-danger btn-sm" href="{{ url('assign_subjects/delete',$value->id) }}"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                          <th>SL No.</th>
                          <th>Class Name</th>
                          <th>Subject Name</th>
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
