@extends('admin.layouts.app')

@section('content')
    <!-- Main content -->
    <div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <!-- left column -->
                <div class="col-md-6 mt-4">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Assign Classes </h3>
                        </div>
                            <div class="card-body">
                                @include('_message')
                                <div class="form-group">
                                    <label for="status">Class Name</label>
                                </div>
                                
                                <div class="form-group">
                                    <label for="status">Subject Name</label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    </div>
@endsection
