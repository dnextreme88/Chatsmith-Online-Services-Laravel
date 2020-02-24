@extends('layouts.app')

@section('title')
Daily Productions for {{ $date_today->format('F d, Y') }}
@endsection

@section('content')
<div class="container-fluid">
	<h1>Daily productions for {{ $date_today->format('F d, Y') }}</h1>
	<dl class="row">
		<dt class="col-md-1 mt-2">Jump to:</dt>
		<dd class="col-md-11">
			<a href="#chat_accounts_data"><button class="btn btn-info">Chat Accounts productions</button></a>
			<a href="#focal_data"><button class="btn btn-info">Focal productions</button></a>
			<a href="#plate_data"><button class="btn btn-info">Plate productions</button></a>
		</dd>
	</dl>
	<!-- Chat Accounts productions -->
	<h2><a id="chat_accounts_data">Chat Accounts Daily Productions</a></h2>
	@if ($daily_productions_chat_accounts->count() > 0)
		<table class="table table-bordered">
			<thead>
				<th>Agent</th>
				<th>Account Used</th>
				<th>Time Range</th>
				<th>Minutes Worked</th>
				<th>Chat Account Tool Used</th>
			</thead>
			<tbody>
			@foreach ($daily_productions_chat_accounts as $daily_productions_chat_data)
				<tr>
					<td>{{ $daily_productions_chat_data->employee->user->first_name }}</td>
					<td>{{ $daily_productions_chat_data->account_used }}</td>
					<td>{{ $daily_productions_chat_data->time_range->time_range }}</td>
					<td>{{ $daily_productions_chat_data->minutes_worked }}</td>
					<td>{{ $daily_productions_chat_data->chat_account_tool }}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	@else
		<p>There are no daily productions data for Live Chat / PersistIQ / Smart Alto today ({{ $date_today->format('F d, Y') }}).</p>
	@endif
	<!-- Focal productions -->
	<h2><a id="focal_data">Focal Daily Productions</a></h2>
	@if ($daily_productions_focal->count() > 0)
		<table class="table table-bordered">
			<thead>
				<th>Agent</th>
				<th>Account Used</th>
				<th>Time Range</th>
				<th>Minutes Worked</th>
				<th>OOS</th>
				<th>Not OOS</th>
				<th>Discards</th>
				<th>Total Images Processed</th>
			</thead>
			<tbody>
			@foreach ($daily_productions_focal as $daily_productions_focal_data)
				<tr>
					<td>{{ $daily_productions_focal_data->employee->user->first_name }}</td>
					<td>{{ $daily_productions_focal_data->time_range->time_range }}</td>
					<td>{{ $daily_productions_focal_data->minutes_worked }}</td>
					<td>{{ $daily_productions_focal_data->account_used }}</td>
					<td>{{ $daily_productions_focal_data->oos_count }}</td>
					<td>{{ $daily_productions_focal_data->not_oos_count }}</td>
					<td>{{ $daily_productions_focal_data->discard_count }}</td>
					<td>{{ $daily_productions_focal_data->total_count }}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	@else
		<p>There are no daily productions data for Focal today ({{ $date_today->format('F d, Y') }}).</p>
	@endif

	<!-- Plate productions -->
	<h2><a id="plate_data">Plate IQ Daily Productions</a></h2>
	@if ($daily_productions_plate->count() > 0)
		<table class="table table-bordered">
			<thead>
				<th>Agent</th>
				<th>Account Used</th>
				<th>Time Range</th>
				<th>Minutes Worked</th>
				<th>PlateIQ Tool Used</th>
				<th>Edits Made</th>
				<th>Invoices Completed</th>
				<th>Invoices Sent to Manager</th>
				<th>Total Invoices Processed</th>
			</thead>
			<tbody>
			@foreach ($daily_productions_plate as $daily_productions_plate_data)
				<tr>
					<td>{{ $daily_productions_plate_data->employee->user->first_name }}</td>
					<td>{{ $daily_productions_plate_data->account_used }}</td>
					<td>{{ $daily_productions_plate_data->time_range->time_range }}</td>
					<td>{{ $daily_productions_plate_data->minutes_worked }}</td>
					<td>{{ $daily_productions_plate_data->plateiq_tool }}</td>
					<td>{{ $daily_productions_plate_data->no_of_edits }}</td>
					<td>{{ $daily_productions_plate_data->no_of_invoices_completed }}</td>
					<td>{{ $daily_productions_plate_data->no_of_invoices_sent_to_manager }}</td>
					<td>{{ $daily_productions_plate_data->total_count }}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	@else
		<p>There are no daily productions data for Plate today ({{ $date_today->format('F d, Y') }}).</p>
	@endif
</div>
@endsection