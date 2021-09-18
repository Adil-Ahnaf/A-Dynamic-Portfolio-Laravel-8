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
    <div class="col-8">
      <!-- Add new brand -->
      <div class="card">
          <div class="card-header">Update Contact</div>
          <div class="card-body">
            <!-- add category form -->
            <form action="{{ url('contact/update/'.$contact->id) }}" method="POST">
              @csrf
              <div class="form-group">
                <label>Address</label>
                <textarea class="form-control" name="address" rows="3">{{$contact->address}}</textarea>
                @error('address')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group">
                <label>E-mail</label>
                <input type="text" class="form-control" name="email" value="{{$contact->email}}" aria-describedby="emailHelp">
                @error('email')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group">
                <label>Phone</label>
                <input type="text" class="form-control" name="number" value="{{$contact->number}}" aria-describedby="emailHelp">
                @error('number')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <button type="submit" class="btn btn-primary">Update</button>
            </form>
          </div>
        </div>
    </div>
</div>

@endsection