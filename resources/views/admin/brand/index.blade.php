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
      <div class="card pagination">
        <div class="card-header">All Brand</div>
          <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Brand Name</th>
                <th scope="col">Brand Image</th>
                <th scope="col">Created At</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <!-- @php($i=1) -->
              @foreach($brands as $brand)
              <tr>
                <th scope="row">{{ $brands->firstItem()+$loop->index }}</th>
                <td>{{ $brand->brand_name }}</td>
                <td> <img src="{{ asset($brand->brand_image) }}" style="height: 40px; width: 70px"></td>
                <td>{{ $brand->created_at->diffForHumans() }}</td>
                <td>
                  <a href="{{ url('brand/edit/'.$brand->id) }}" class="btn btn-info btn-sm">Edit</a>
                  <a href="{{ url('brand/delete/'.$brand->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete?')">Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <nav aria-label="Page navigation example">
          <ul class="pagination">
            {{ $brands->links() }}
          </ul>
        </nav>      
        </div>
      </div>


    <div class="col-4">
      <!-- Add new brand -->
      <div class="card">
          <div class="card-header">Add Brand</div>
          <div class="card-body">
            <!-- add category form -->
            <form action="{{ route('store.brand') }}" method="POST" enctype="Multipart/form-data">
              @csrf
              <div class="form-group">
                <label>Brand Name</label>
                <input type="text" class="form-control" name="brand_name" aria-describedby="emailHelp">
                @error('brand_name')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group">
                <label>Brand Image</label>
                <input type="file" class="form-control" name="brand_image" aria-describedby="emailHelp">
                @error('brand_image')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <button type="submit" class="btn btn-primary">Add Brand</button>
            </form>
          </div>
        </div>
    </div>
</div>

@endsection