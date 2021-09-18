@extends('admin.admin_master')
@section('admin')

<div class="row">
  <div class="col-lg-12">
    <div class="card card-default">
      <div class="card-header card-header-border-bottom">
        <h2>Update About</h2>
      </div>
      <div class="card-body">
        <form action="{{ url('about/update/'.$about->id) }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="exampleFormControlInput1">Title</label>
            <input type="text" name="title" value="{{ $about->title }}" class="form-control">
              @error('title')
                <span class="text-danger">{{ $message }}</span>
              @enderror
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Short Description</label>
            <textarea class="form-control" name="short_des" rows="3">{{ $about->short_des }}</textarea>
              @error('short_des')
                <span class="text-danger">{{ $message }}</span>
              @enderror
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Long Description</label>
            <textarea class="form-control" name="long_des" rows="8">{{ $about->long_des }}</textarea>
              @error('long_des')
                <span class="text-danger">{{ $message }}</span>
              @enderror
          </div>
          <div class="form-footer pt-4 pt-5 mt-4 border-top">
            <button type="submit" class="btn btn-primary btn-default">Update About</button>
          </div>
        </form>
      </div>
    </div>
</div>

@endsection