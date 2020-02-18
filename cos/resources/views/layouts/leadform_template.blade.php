<!-- Employee (Foreign key) -->
<div class="form-group row">
	<label for="employee_id" class="col-md-4 col-form-label text-md-right">Employee</label>

	<div class="col-md-6">
		<select id="employee_id" class="form-control" name="employee_id">
		@foreach ($employees as $employee)
			@if ($employee->id == $user->employee->id)
				<option value="{{ $employee->id }}" selected>{{ $employee->first_name }}</option>
			@else
				<option value="{{ $employee->id }}">{{ $employee->first_name }}</option>
			@endif
		@endforeach
		</select>
	</div>
</div>
<!-- Account used -->
<div class="form-group row">
	<label for="account_used" class="col-md-4 col-form-label text-md-right">Account Used</label>

	<div class="col-md-6">
		<input id="account_used" class="form-control input-lg" type="text" name="account_used" value="{{ $user->email }}">
		<small class="form-text text-muted">Change this value depending on what leadform you are using.</small>
	</div>
</div>
<!-- Time range -->
<div class="form-group row">
	<label for="time_range" class="col-md-4 col-form-label text-md-right">Time range</label>

	<div class="col-md-6">
		<select id="time_range" class="form-control" name="time_range">
		@foreach ($time_range_choices as $time_range)
			<option value="{{ $time_range }}">{{ $time_range }}</option>
		@endforeach
		</select>
	</div>
</div>
<!-- Minutes worked -->
<div class="form-group row">
	<label for="minutes_worked" class="col-md-4 col-form-label text-md-right">Minutes Worked</label>

	<div class="col-md-6">
		<input id="minutes_worked" class="form-control input-lg" type="number" name="minutes_worked" min="1">
	</div>
</div>