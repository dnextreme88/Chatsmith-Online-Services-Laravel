@extends('layouts.app')

@section('title')
Edit User Settings - Update Profile Image Form
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12 text-center">
			<h3>Update Profile Image</h3>
		</div>
		@if (session('success'))
			<div class="col-md-12 alert alert-success alert-block">
				<button type="button" class="close" data-dismiss="alert">x</button>
				{{ session('success') }}
			</div>
			<!-- Display successfully uploaded image -->
			<div class="col-md-6 mb-1">
				<p>New profile image:</p>
				<img src="/{{ Session::get('new_profile_image') }}" class="img-thumbnail img-responsive mx-auto d-block avatar-thumbnail-medium" />
			</div>
			<!-- Get old image when new image has uploaded -->
			<div class="col-md-6 mb-1">
				<p>Old profile image:</p>
				<img src="/{{ Session::get('old_profile_image') }}" class="img-thumbnail img-responsive mx-auto d-block avatar-thumbnail-medium" />
			</div>
		@endif
		<div class="col-md-12 alert alert-info alert-block">
			<p>Upload a profile image using the form below. Please observe the following guidelines:</p>
			<ol>
				<li>File to be uploaded must be an image.</li>
				<li>Image file size must not exceed more than 2 MB.</li>
				<li>Supported image extensions: <strong>.jpeg, .png, .jpg, .gif</strong></li>
			</ol>
		</div>
		@if (count($errors) > 0)
			<div class="col-md-12 alert alert-danger alert-block">
				<p>Upload Validation Errors</p>
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
				</ul>
			</div>
		@endif
			<div class="col-md-12">
				<img src="{{ asset(auth()->user()->image) }}" class="img-thumbnail img-responsive  mx-auto d-block avatar-thumbnail-small" />
			</div>
		<div class="col-md-12 text-center">
			<form method="post" action="/user/update_profile_image/{{ $user->id }}" enctype="multipart/form-data">
				@csrf
				<!-- User ID (readonly) -->
				<div class="form-group row">
					<label for="user_id" class="col-md-4 col-form-label text-md-right">User ID</label>

					<div class="col-md-6">
						<input id="user_id" readonly class="form-control-plaintext input-lg" type="text" placeholder="{{ $user->id }}">
					</div>
				</div>
				<!-- Upload file -->
				<div class="form-group row">
					<label for="select_file" class="col-md-4 col-form-label text-md-right">Select file to upload</label>

					<div class="col-md-6">
						<input type="file" class="form-control input-lg" id="select_file" name="select_file" />
						<small class="form-text text-muted">Accepted extensions: .jpeg, .png, .jpg, .gif</small>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-4 offset-md-2">
						<a class="btn btn-danger" href="/profile/">Back to Profile</a>
					</div>
					<div class="col-md-6">
						<input type="submit" name="upload" class="btn btn-primary" value="Upload">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
