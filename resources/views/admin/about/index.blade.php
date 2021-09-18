@extends('admin.admin_master')
@section('admin')
           
<div class="row">
    <div class="col-12">
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
        <div class="card-header">All About
           <a href="{{ route('add.about') }}" class="float-right btn btn-success btn-sm">Add About</a>
        </div>

          <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col" style="width: 5%">ID</th>
                <th scope="col" style="width: 15%">Title</th>
                <th scope="col" style="width: 35%">Short Description</th>
                <th scope="col" style="width: 35%">Long Description</th>
                <th scope="col" style="width: 10%">Action</th>
              </tr>
            </thead>
            <tbody>
              <!-- @php($i=1) -->
              @foreach($abouts as $about)
              <tr>
                <th scope="row">{{ $i++ }}</th>
                <td>{{ $about->title }}</td>
                <td>{{ $about->short_des }}</td>
                <td>{{ $about->long_des }}</td>
                <td>
                  <a href="{{ url('about/edit/'.$about->id) }}" class="btn btn-info btn-sm">Edit</a>
                  <a href="{{ url('about/delete/'.$about->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete?')">Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
</div>

@endsection