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
        <div class="card-header">All Slider
           <a href="{{ route('add.slider') }}" class="float-right btn btn-success btn-sm">Add Slider</a>
        </div>

          <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Slider Title</th>
                <th scope="col" style="width: 50%">Slider Description</th>
                <th scope="col">Slider Image</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <!-- @php($i=1) -->
              @foreach($sliders as $slider)
              <tr>
                <th scope="row">{{ $i++ }}</th>
                <td>{{ $slider->title }}</td>
                <td>{{ $slider->description }}</td>
                <td> <img src="{{ asset($slider->slider_image) }}" style="height: 80px; width: 150px"></td>
                <td>
                  <a href="{{ url('slider/edit/'.$slider->id) }}" class="btn btn-info btn-sm">Edit</a>
                  <a href="{{ url('slider/delete/'.$slider->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete?')">Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
</div>

@endsection