@extends('admin.admin_master')
@section('admin')

<div class="py-12">
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Update Brand</div>
        <div class="card-body">
          <!-- add category form -->
          <form action="{{ url('brand/update/'.$brands->id) }}" method="POST" enctype="Multipart/form-data">
            @csrf
            <div class="form-group">
              <label>Update Brand Name</label>
              <input type="text" class="form-control" name="brand_name" aria-describedby="emailHelp" value="{{ $brands->brand_name }}">
              @error('brand_name')
                <span class="text-danger">{{ $message }}</span>
              @enderror


              <input type="text" name="old_image" value="{{ $brands->brand_image }}">

              <label>Update Brand Image</label>
              <input type="file" class="form-control" name="brand_image" aria-describedby="emailHelp">
              @error('brand_image')
                <span class="text-danger">{{ $message }}</span>
              @enderror


              <div class="form-group">
                <img src="{{ asset($brands->brand_image) }}" style="width: 300px; height: 200px">
              </div>

            </div>
            <button type="submit" class="btn btn-primary">Update Brand</button>
          </form>
        </div>
      </div>
    </div>
  </div>  
</div>

@endsection