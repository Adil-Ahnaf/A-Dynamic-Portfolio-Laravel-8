@extends('admin.admin_master')
@section('admin')

<div class="row">
  <div class="col-lg-12">
    <div class="card card-default">
      <div class="card-header card-header-border-bottom">
        <h2>Add New Slider</h2>
      </div>
      <div class="card-body">
        <form action="{{ route('store.slider') }}" method="POST" enctype="Multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="exampleFormControlInput1">Slider Title</label>
            <input type="text" name="title" class="form-control">
              @error('title')
                <span class="text-danger">{{ $message }}</span>
              @enderror
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Slider Description</label>
            <textarea class="form-control" name="description" rows="3"></textarea>
              @error('description')
                <span class="text-danger">{{ $message }}</span>
              @enderror
          </div>
          <div class="form-group">
            <label for="exampleFormControlFile1">Slider Image</label>
            <input type="file" class="form-control-file" name="slider_image">
          </div>
          <div class="form-footer pt-4 pt-5 mt-4 border-top">
            <button type="submit" class="btn btn-primary btn-default">Add Slider</button>
          </div>
        </form>
      </div>
    </div>
</div>

@endsection