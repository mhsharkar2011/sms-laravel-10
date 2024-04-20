<!-- resources/views/components/search-form.blade.php -->
<form action="" method="get">
  <div class="card-body">
      <div class="row">
          <div class="form-group col-md-3">
              <label for="class_name">Class Name</label>
              <input type="text" class="form-control" value="{{ Request::get('class_name') }}" name="class_name" placeholder="Class Name">
          </div>
          <div class="form-group col-md-3">
              <label for="subject_name">Subject Name</label>
              <input type="text" class="form-control" value="{{ Request::get('subject_name') }}" name="subject_name" placeholder="Subject Name">
          </div>
          <div class="form-group col-md-3">
              <label for="date">Date</label>
              <input type="date" class="form-control" value="{{ Request::get('date') }}" name="date" placeholder="Date">
          </div>
          <div class="form-group col-md-3">
              <button class="btn btn-primary" style="margin-top: 33px" type="submit">Search</button>
              <a href="{{ route('admins.assign_subjects.index') }}" style="margin-top: 33px" class="btn btn-warning">Clear</a>
          </div>
      </div>
  </div>
</form>
