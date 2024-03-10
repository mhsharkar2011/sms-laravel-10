@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Subject Create</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-8">
                        <div class="card-body">
                            <p class="login-box-msg">Subject Create</p>
                            @include('_message')
                            <form action="{{ route('subject.store') }}" method="post">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" required name="name"
                                        placeholder="Type Subject Name Here">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                </div>
                                <!-- /.col -->
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </section>
    </div>
@endsection
