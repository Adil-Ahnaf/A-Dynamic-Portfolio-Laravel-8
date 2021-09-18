@extends('admin.admin_master')
@section('admin')
           
<div class="row">    
  <div class="col-8">
      <!-- Add new brand -->
      <div class="card">
        <div class="card-header">Update Service</div>
        <div class="card-body">
          <!-- add category form -->
          <form action="{{ url('service/update/'.$service->id) }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="exampleFormControlInput1">Service Name</label>
              <input type="text" name="name" value="{{$service->name}}" class="form-control">
                @error('name')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Service Description</label>
              <textarea class="form-control" name="description" rows="3">{{ $service->description }}</textarea>
                @error('description')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-footer pt-4 pt-5 mt-4 border-top">
              <button type="submit" class="btn btn-primary btn-default">Update Service</button>
            </div>
          </form>
        </div>
      </div>
  </div>
</div>

@endsection