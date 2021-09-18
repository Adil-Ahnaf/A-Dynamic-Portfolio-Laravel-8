@extends('admin.admin_master')
@section('admin')
 
<div class="row">          
<div class="card card-default col-8">
	<div class="card-header card-header-border-bottom">
		<h2>Profile Information</h2>
	</div>
	<div class="card-body">
		<form class="form-pill" method="POST" action="{{ route('update.profile') }}">
			@csrf
			<div class="form-group">
				<label for="exampleFormControlPassword3">Name</label>
				<input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
				@error('name')
					<span class="text-danger">{{$message}}</span>
				@enderror
			</div>
			<div class="form-group">
				<label for="exampleFormControlPassword3">E-mail</label>
				<input type="text" class="form-control" id="email" name="email" value="{{$user->email}}">
				@error('email')
					<span class="text-danger">{{$message}}</span>
				@enderror
			</div>

			<button class="btn btn-info" type="submit">Update Information</button>
		</form>
	</div>
</div>

<div class="card card-default col-4">
	<div class="card-header card-header-border-bottom">
		<h2>Profile Photo</h2>
	</div>
	<div class="card-body">
		<div class="text-center">
			<center>
				<img src="{{ $user->profile_photo_url }}" style="width:100px; height:100px" alt="user image" class="rounded">
			</center>
		</div>
		<br>
		<form class="form-pill" method="POST" action="{{ route('update.photo') }}" enctype="Multipart/form-data">
			@csrf
			<div class="form-group">
				<label for="new_photo">Select A New Photo</label>
				<input type="file" class="form-control" name="new_photo" id="new_photo">
			</div>
			<button class="btn btn-info" type="submit">Change Photo</button>
			<a href="{{ url('user/delete/'.$user->id) }}"   class="btn btn-danger" onclick="return confirm('Are you sure to delete?')">Remove Photo</a>
		</form>		
	</div>
</div>
</div> 
@endsection