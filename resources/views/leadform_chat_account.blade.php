@extends('layouts.app')

@section('title')
Chatsmith Online Services - Chat Account Leadform
@endsection

@section('content')
<div class="container">
	<x-custom.breadcrumbs :nav_links="[]">Chat Account Leadform</x-custom.breadcrumbs>

	<div class="card">
		<x-custom.card-header-title>{{ __('Chat Account Leadform for Live Chat, Smart Alto, and PersistIQ') }}</x-card-header-title>

		<div class="card-body">
		@if (session('success'))
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				{{ session('success') }}
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		@endif
		@if($errors->any())
			<div class="alert alert-danger" role="alert">
				<p>Chat Account Leadform Errors</p>
				<ul>
					@foreach($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		
		@if ($is_active_employee)
			<form action="/leadforms/chat_account/" method="POST">
				@csrf
				@include('layouts.leadform_template')
				<!-- Chat account tool -->
				<div class="form-group row">
					<label for="chat_account_tool" class="col-md-4 col-form-label text-md-right">Chat Account Tool Used</label>

					<div class="col-md-6">
						<select id="chat_account_tool" class="form-control input-lg" name="chat_account_tool">
						@foreach ($chat_account_tool_choices as $chat_account_tool)
							<option value="{{ $chat_account_tool }}">{{ $chat_account_tool }}</option>
						@endforeach
						</select>
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
