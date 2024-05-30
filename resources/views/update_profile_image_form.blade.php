@extends('layouts.app')

@section('title')
Edit User Settings - Update Profile Image Form
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><i class="fa fa-home"></i> <a href="/">Home</a></li>
				<li class="breadcrumb-item"><a href="{{ route('profile') }}">Profile</a></li>
				<li class="breadcrumb-item"><a href="/profile/{{ $user->id }}/edit/">Settings</a></li>
				<li class="breadcrumb-item">Update Profile Image</li>
			</ol>
		</div>
		<div class="col-md-12 text-center">
			<h3>Update Profile Image</h3>
		</div>
		@if (session('success'))
			<div class="col-md-12 alert alert-success alert-dismissible fade show" role="alert">
				{{ session('success') }}
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
						<input type="submit" name="removeImage" class="btn btn-danger" value="Remove Profile Image">
					</div>
					<div class="col-md-6">
						<input type="submit" name="uploadImage" class="btn btn-primary" value="Upload Image">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
