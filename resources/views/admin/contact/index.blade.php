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
        <div class="card-header">All Contact</div>
          <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Address</th>
                <th scope="col">E-mail</th>
                <th scope="col">Phone</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <!-- @php($i=1) -->
              @foreach($contacts as $contact)
              <tr>
                <th scope="row">{{ $i++ }}</th>
                <td>{{ $contact->address }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->number }}</td>
                <td>
                  <a href="{{ url('contact/edit/'.$contact->id) }}" class="btn btn-info btn-sm">Edit</a>
                  <a href="{{ url('contact/delete/'.$contact->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete?')">Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <nav aria-label="Page navigation example">
          <ul class="pagination">
          </ul>
        </nav>      
        </div>
      </div>


    <div class="col-4">
      <!-- Add new brand -->
      <div class="card">
          <div class="card-header">Add Contact</div>
          <div class="card-body">
            <!-- add category form -->
            <form action="{{ route('store.contact') }}" method="POST">
              @csrf
              <div class="form-group">
                <label>Address</label>
                <textarea class="form-control" name="address" rows="3"></textarea>
                @error('address')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group">
                <label>E-mail</label>
                <input type="text" class="form-control" name="email" aria-describedby="emailHelp">
                @error('email')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group">
                <label>Phone</label>
                <input type="text" class="form-control" name="number" aria-describedby="emailHelp">
                @error('number')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <button type="submit" class="btn btn-primary">Add</button>
            </form>
          </div>
        </div>
    </div>
</div>

@endsection