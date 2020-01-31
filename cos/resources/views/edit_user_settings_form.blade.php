@extends('layouts.app')

@section('title')
Edit User Settings
@endsection

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">Edit User Settings</div>

					<div class="card-body">
					@if (session('success'))
						<div class="alert alert-success alert-block" role="alert">
			                <button type="button" class="close" data-dismiss="alert">x</button>
			                {{ session('success') }}
						</div>
					@endif
						<form action="/profile/{{ $user->id }}" method="POST">
							@csrf
							@method('PUT')
							<!-- User ID (readonly) -->
							<div class="form-group row">
								<label for="user_id" class="col-md-4 col-form-label text-md-right">User ID</label>

								<div class="col-md-6">
									<input id="user_id" readonly class="form-control-plaintext input-lg" type="text" placeholder="{{ $user->id }}">
								</div>
							</div>
							<!-- Username (readonly) -->
							<div class="form-group row">
								<label for="username" class="col-md-4 col-form-label text-md-right">Username</label>

								<div class="col-md-6">
									<input id="username" readonly class="form-control-plaintext input-lg" type="text" placeholder="{{ $user->username }}">
								</div>
							</div>
							<!-- User email -->
							<div class="form-group row">
								<label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

								<div class="col-md-6">
									<input id="email" class="form-control input-lg" type="email" name="email" placeholder="Email address" value="{{ $user->email }}">
								</div>
							</div>
							<!-- Upload user profile image -->
							<div class="form-group row">
								<label for="email" class="col-md-4 col-form-label text-md-right">Upload User Image</label>

								<div class="col-md-6">
									<a href="/user/uploadfile/">Click here to update profile image</a>
								</div>
							</div>
							<!-- User's current password -->
							<div class="form-group row">
								<input id="user_password" name="user_password" type="hidden" value="{{ $user->password}}">
								<label for="current_password" class="col-md-4 col-form-label text-md-right">Enter current password</label>

								<div class="col-md-6">
									<input id="current_password" class="form-control input-lg" type="password" name="current_password">
								</div>
							</div>
							<!-- Change password -->
							<div class="form-group row">
								<label for="change_password" class="col-md-4 col-form-label text-md-right">Change Password</label>

								<div class="col-md-6">
									<input id="change_password" class="form-control input-lg" type="password" name="change_password">
								</div>
							</div>
							<!-- Confirm change password -->
							<div class="form-group row">
								<label for="change_password_confirm" class="col-md-4 col-form-label text-md-right">Confirm Change Password</label>

								<div class="col-md-6">
									<input id="change_password_confirm" class="form-control input-lg" type="password" name="change_password_confirm">
								</div>
							</div>
							<div class="form-group row mb-0">
								<div class="col-md-4 offset-md-2">
									<a class="btn btn-danger" href="/profile/">Go back</a>
								</div>
								<div class="col-md-4 offset-md-2">
									<input class="btn btn-primary" type="submit" name="submit" value="Edit settings">
								</div>
							</div>
						</form><br />
					@if($errors->any())
						<div class="alert alert-danger" role="alert">
							<p>Update Settings Errors</p>
							<ul>
								@foreach($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection