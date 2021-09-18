@extends('admin.admin_master')
@section('admin')
           
<div class="card card-default">
	<!-- alert success message-->
    @if(session('warning'))
      	<div class="alert alert-warning alert-dismissible fade show" role="alert">
		  <strong>{{ session('warning') }}</strong>
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
    @endif
	<div class="card-header card-header-border-bottom">
		<h2>Update Password</h2>
	</div>
	<div class="card-body">
		<form class="form-pill" method="POST" action="{{ route('update.password') }}">
			@csrf
			<div class="form-group">
				<label for="exampleFormControlPassword3">Current Password</label>
				<input type="password" class="form-control" id="current_password" name="current_password" placeholder="Password">
				@error('current_password')
					<span class="text-danger">{{$message}}</span>
				@enderror
			</div>
			<div class="form-group">
				<label for="exampleFormControlPassword3">New Password</label>
				<input type="password" class="form-control" id="password" name="password" placeholder="Password">
				@error('password')
					<span class="text-danger">{{$message}}</span>
				@enderror
			</div>
			<div class="form-group">
				<label for="exampleFormControlPassword3">Confirm Password</label>
				<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Password">
				@error('password_confirmation')
					<span class="text-danger">{{$message}}</span>
				@enderror
			</div>

			<button class="btn btn-info" type="submit">Save</button>
		</form>
	</div>
</div>

@endsection