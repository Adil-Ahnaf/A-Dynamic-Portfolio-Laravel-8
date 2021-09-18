@extends('admin.admin_master')
@section('admin')
           
<div class="row">
    <div class="col-8">
      <!-- alert success message-->
        @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
      <!-- Show all brand -->
      <div class="card">
        <div class="card-header">All Service
           {{-- <a href="{{ route('add.service') }}" class="float-right btn btn-success btn-sm">Add Service</a> --}}
        </div>

          <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Service Name</th>
                <th scope="col" style="width: 50%">Service Description</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <!-- @php($i=1) -->
              @foreach($services as $service)
              <tr>
                <th scope="row">{{ $i++ }}</th>
                <td>{{ $service->name }}</td>
                <td>{{ $service->description }}</td>
                <td>
                  <a href="{{ url('service/edit/'.$service->id) }}" class="btn btn-info btn-sm">Edit</a>
                  <a href="{{ url('service/delete/'.$service->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete?')">Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      
    <div class="col-4">
      <!-- Add new brand -->
      <div class="card">
        <div class="card-header">Add New Service</div>
          <div class="card-body">
            <!-- add category form -->
            <form action="{{ route('store.service') }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="exampleFormControlInput1">Service Name</label>
                <input type="text" name="name" class="form-control">
                  @error('name')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Service Description</label>
                <textarea class="form-control" name="description" rows="3"></textarea>
                  @error('description')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>
              <div class="form-footer pt-4 pt-5 mt-4 border-top">
                <button type="submit" class="btn btn-primary btn-default">Add Service</button>
              </div>
            </form>
          </div>
        </div>
    </div>
</div>

@endsection