<div class="container">
    <div class="row">
        @foreach ($announcements as $announcement)
            <div class="mb-2">
                <h1>{{ $announcement->title }}</h1>
                <p class="text-muted">Posted by <a href="/announcements/user/{{ $announcement->user->username }}">{{ $announcement->user->username }}</a> on <small>{{ \Carbon\Carbon::parse($announcement->created_at)->format('F j, Y h:i:s A') }}</small></p>
                <hr>

                @include('Components.Announcements.includes.description', ['announcement_description' => $announcement->description])

                @auth
                    @if ($user->is_staff == 'True')
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item"><i class="fa fa-eye"></i> <a href="/announcements/{{ $announcement->id }}/">View</a></li>
                                <li class="list-inline-item"><i class="fa fa-magic"></i> <a href="/announcements/{{ $announcement->id }}/edit/">Edit</a></li>
                                <li class="list-inline-item">
                                    <form action="/announcements/{{ $announcement->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <i class="fa fa-trash"></i> <input class="text-danger delete-announcement-button" type="submit" name="submit" value="Delete" />
                                    </form>
                                </li>
                            </ul>
                        </td>
                    @endif
                @endauth
            </div>
        @endforeach
    </div>
</div>
