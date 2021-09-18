@extends('admin.admin_master')
@section('admin')

<div class="row">
  
  <div class="col-md-8">
     <div class="card-group">
      @foreach($images as $multi)
       <div class="col-md-3 mt-4">
         <div class="card">
           <img src="{{ asset($multi->image) }}" alt="">
         </div>
       </div>
      @endforeach
     </div>
  </div>

  <div class="col-md-4">
    <div class="card">
      <div class="card-header">Multi Image</div>
      <div class="card-body">
        <!-- add category form -->
        <form action="{{ route('store.image') }}" method="POST" enctype="Multipart/form-data">
          @csrf
          <div class="form-group">
            <label>Multi Image</label>
            <input type="file" name="images[]" class="form-control" multiple="" aria-describedby="emailHelp">
            @error('images')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>

          <button type="submit" class="btn btn-primary">Add Image</button>
        </form>
      </div>
    </div>
  </div>
  
</div>
@endsection