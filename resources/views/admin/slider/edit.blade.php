@extends('admin.admin_master')
@section('admin')

<div class="row">
  <div class="col-lg-12">
    <div class="card card-default">
      <div class="card-header card-header-border-bottom">
        <h2>Update Slider</h2>
      </div>
      <div class="card-body">
        <form action="{{ url('slider/update/'.$slider->id) }}" method="POST" enctype="Multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="exampleFormControlInput1">Slider Title</label>
            <input type="text" name="title" class="form-control" value="{{$slider->title}}">
              @error('title')
                <span class="text-danger">{{ $message }}</span>
              @enderror
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Slider Description</label>
            <textarea class="form-control" name="description" rows="3"> <?php echo ($slider->description); ?></textarea>
              @error('description')
                <span class="text-danger">{{ $message }}</span>
              @enderror
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Slider Current Image</label><br>
            <img src="{{ asset($slider->slider_image) }}" style="width: 300px; height: 200px">
            <input type="hidden" name="old_image" value="{{ $slider->slider_image }}">
          </div>
          <div class="form-group">
            <label for="exampleFormControlFile1">Change Image</label>
            <input type="file" class="form-control-file" name="new_image">
          </div>
          <div class="form-footer pt-4 pt-5 mt-4 border-top">
            <button type="submit" class="btn btn-primary btn-default">Update</button>
          </div>
        </form>
      </div>
    </div>
</div>

 <script>
  function myFunction() {
    var x = document.getElementById("myTextarea").value;
    document.getElementById("demo").innerHTML = x;
  }
</script>

@endsection