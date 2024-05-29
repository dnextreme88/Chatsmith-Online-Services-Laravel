@extends('layouts.app')

@section('title')
Chatsmith Online Services - Focal Leadform
@endsection

@section('content')
<div class="container">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><i class="fa fa-home"></i> <a href="/">Home</a></li>
			<li class="breadcrumb-item">Focal Leadform</li>
		</ol>
	</div>
	<div class="card">
		<div class="card-header">Focal Leadform</div>

		<div class="card-body">
		@if (session('success'))
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				{{ session('success') }}
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		@endif
		@if($errors->any())
			<div class="alert alert-danger" role="alert">
				<p>Focal Leadform Errors</p>
				<ul>
					@foreach($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		
		@if ($is_active_employee)
			<form action="/leadforms/focal/" method="POST">
				@csrf
				@include('layouts.leadform_template')
				<!-- OOS count -->
				<div class="form-group row">
					<label for="oos_count" class="col-md-4 col-form-label text-md-right">Number of OOS (Yes)</label>

					<div class="col-md-6">
						<input id="oos_count" class="form-control input-lg" type="number" name="oos_count" min="0">
						<small class="form-text text-muted">You may put 0 or you can leave it as blank.</small>
					</div>
				</div>
				<!-- Not OOS count -->
				<div class="form-group row">
					<label for="not_oos_count" class="col-md-4 col-form-label text-md-right">Number of Not OOS (No)</label>

					<div class="col-md-6">
						<input id="not_oos_count" class="form-control input-lg" type="number" name="not_oos_count" min="0">
						<small class="form-text text-muted">You may put 0 or you can leave it as blank.</small>
					</div>
				</div>
				<!-- Discard count -->
				<div class="form-group row">
					<label for="discard_count" class="col-md-4 col-form-label text-md-right">Number of Discarded Images</label>

					<div class="col-md-6">
						<input id="discard_count" class="form-control input-lg" type="number" name="discard_count" min="0">
						<small class="form-text text-muted">You may put 0 or you can leave it as blank.</small>
					</div>
				</div>
				<div class="form-group row mb-0">
					<div class="col-md-6 offset-md-4">
						<input class="btn btn-primary" type="submit" name="submit" value="Submit Leadform">
					</div>
				</div>
			</form>
		@else
			<div class="alert alert-danger">You cannot submit your leadform as you're not an active employee!</div>
		@endif
		</div>
	</div>
</div>
@endsection
