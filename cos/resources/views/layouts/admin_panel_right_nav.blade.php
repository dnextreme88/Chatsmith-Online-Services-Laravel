<div class="card bg-primary admin-panel-card">
	<div class="card-header admin-panel-card-header">Admin Panel</div>
	<div class="card-body admin-panel-card-body-nav">
		<ul class="list-unstyled">
			<li class="list-item {{ (url()->current() == route('admin_panel_home')) ? 'active' : '' }}"><a href="/admin/">Admin Panel Home</a></li>
			<li class="list-item {{ (url()->current() == route('announcements.index')) ? 'active' : '' }}"><a href="/announcements/">Announcements</a></li>
			<li class="list-item {{ (url()->current() == route('employees.index')) ? 'active' : '' }}"><a href="/employees/">Employees</a></li>
			<li class="list-item {{ (url()->current() == route('all_users')) ? 'active' : '' }}"><a href="/users/">Users</a></li>
			<hr id="admin-panel-hr-separator">
			<li class="list-item {{ (\Request::getRequestUri() == '/announcements/create/') ? 'active' : '' }}"><a href="/announcements/create/">Add Announcement</a></li>
			<li class="list-item {{ (\Request::getRequestUri() == '/employees/create/') ? 'active' : '' }}"><a href="/employees/create/">Add Employee</a></li>
		</ul>
	</div>
</div>