@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">Edit User Settings</div>

					<div class="card-body">
						<form action="/profile/{{ $user->id }}" method="POST">
							@csrf
							@method('PUT')
							<!-- User email -->
							<div class="form-group row">
								<label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

								<div class="col-md-6">
									<input id="email" class="form-control input-lg" type="email" name="email" placeholder="Email address" value="{{ $user->email }}"><br />
								</div>
							</div>
							<!-- User's current password -->
							<div class="form-group row">
								<input id="user_password" name="user_password" type="hidden" value="{{ $user->password}}">
								<label for="current_password" class="col-md-4 col-form-label text-md-right">Current Password</label>

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
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	@if($errors->any())
		<div>
			<ul>
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
@endsection