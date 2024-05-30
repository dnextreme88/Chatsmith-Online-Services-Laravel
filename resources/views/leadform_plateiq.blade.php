@extends('layouts.app')

@section('title')
Chatsmith Online Services - PlateIQ Leadform
@endsection

@section('content')
<div class="container">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><i class="fa fa-home"></i> <a href="/">Home</a></li>
			<li class="breadcrumb-item">PlateIQ Leadform</li>
		</ol>
	</div>
	<div class="card">
		<div class="card-header">PlateIQ Leadform</div>

		<div class="card-body">
		@if (session('success'))
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				{{ session('success') }}
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		@endif
		@if($errors->any())
			<div class="alert alert-danger" role="alert">
				<p>PlateIQ Leadform Errors</p>
				<ul>
					@foreach($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		@if ($is_active_employee)
			<form action="/leadforms/plateiq/" method="POST">
				@csrf
				@include('layouts.leadform_template')
				<!-- Plate IQ tool -->
				<div class="form-group row">
					<label for="plateiq_tool" class="col-md-4 col-form-label text-md-right">Plate IQ Tool Used</label>

					<div class="col-md-6">
						<select id="plateiq_tool" class="form-control input-lg" name="plateiq_tool">
						@foreach ($plateiq_tool_choices as $plateiq_tool)
							<option value="{{ $plateiq_tool }}">{{ $plateiq_tool }}</option>
						@endforeach
						</select>
					</div>
				</div>
				<!-- Number of edits -->
				<div class="form-group row">
					<label for="no_of_edits" class="col-md-4 col-form-label text-md-right">Number of Edits</label>

					<div class="col-md-6">
						<input id="no_of_edits" class="form-control input-lg" type="number" name="no_of_edits" min="0">
						<small class="form-text text-muted">You may put 0 or you can leave it as blank.</small>
					</div>
				</div>
				<!-- Number of invoices completed -->
				<div class="form-group row">
					<label for="no_of_invoices_completed" class="col-md-4 col-form-label text-md-right">Number of Invoices Completed</label>

					<div class="col-md-6">
						<input id="no_of_invoices_completed" class="form-control input-lg" type="number" name="no_of_invoices_completed" min="0">
						<small class="form-text text-muted">You may put 0 or you can leave it as blank.</small>
					</div>
				</div>
				<!-- Number of invoices sent to manager -->
				<div class="form-group row">
					<label for="no_of_invoices_sent_to_manager" class="col-md-4 col-form-label text-md-right">Number of Invoices Sent to Manager</label>

					<div class="col-md-6">
						<input id="no_of_invoices_sent_to_manager" class="form-control input-lg" type="number" name="no_of_invoices_sent_to_manager" min="0">
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
