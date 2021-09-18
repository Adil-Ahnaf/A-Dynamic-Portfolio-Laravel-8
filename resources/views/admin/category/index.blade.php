<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Category
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
          <div class="row">
            
            <div class="col-md-8">
              <!-- alert success message-->
              @if(session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif
              <!-- end success message-->
              <div class="card">
                <div class="card-header">All Category</div>
                  <table class="table">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">User Id</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- @php($i=1) -->
                      @foreach($categories as $category)
                      <tr>
                        <th scope="row">{{ $categories->firstItem()+$loop->index }}</th>
                        <td>{{ $category->category_name }}</td>
                        <td>{{ $category->user->name }}</td>
                        <td>{{ $category->created_at->diffForHumans() }}</td>
                        <td>
                          <a href="{{ url('category/edit/'.$category->id) }}" class="btn btn-info btn-sm">Edit</a>
                          <a href="{{ url('category/softDelete/'.$category->id) }}" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  {{ $categories->links() }}
              </div>   
            </div>

            <div class="col-md-4">
              <div class="card">
                <div class="card-header">Add Category</div>
                <div class="card-body">
                  <!-- add category form -->
                  <form action="{{ route('store.category') }}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label>Category Name</label>
                      <input type="text" class="form-control" name="category_name" aria-describedby="emailHelp">
                      @error('category_name')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Add Category</button>
                  </form>
                </div>
              </div>
            </div>
            
          </div>
        </div>    
    </div>


    <!-- trash cat -->
    <div class="py-12">
        <div class="container">
          <div class="row">
            
            <div class="col-md-8">
              <div class="card">
                <div class="card-header">Trash List</div>
                  <table class="table">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">User Id</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- @php($i=1) -->
                      @foreach($trashcat as $category)
                      <tr>
                        <th scope="row">{{ $categories->firstItem()+$loop->index }}</th>
                        <td>{{ $category->category_name }}</td>
                        <td>{{ $category->user->name }}</td>
                        <td>{{ $category->created_at->diffForHumans() }}</td>
                        <td>
                          <a href="{{ url('category/restore/'.$category->id) }}" class="btn btn-info btn-sm">Restore</a>
                          <a href="{{ url('category/remove/'.$category->id) }}" class="btn btn-danger btn-sm">Remove</a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  {{ $trashcat->links() }}
              </div>   
            </div>            
          </div>
        </div>    
    </div>
    <!-- end trash cat -->
</x-app-layout>
