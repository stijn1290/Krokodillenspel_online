@include('layouts.header', ['title' => 'Users'])

    <!DOCTYPE html>
<html>
<head>
    <title>All Users</title>
</head>
<body>
<h1>All Users</h1>

@if($users->isEmpty())
    <p>No other users found.</p>
@else
    <ul>
        @foreach($users as $user)
            <li>
                {{ $user->name }}

                @if(in_array($user->id, $friends))
                    - Friends
                @elseif(in_array($user->id, $sentRequests))
                    - Request Sent
                @elseif(in_array($user->id, $receivedRequests))
                    <form action="/friend-accept/{{ $user->id }}" method="POST" style="display:inline">
                        @csrf
                        <button>Accept Request</button>
                    </form>
                @else
                    <form action="/friend-request/{{ $user->id }}" method="POST" style="display:inline">
                        @csrf
                        <button>Add Friend</button>
                    </form>
                @endif
            </li>
        @endforeach
    </ul>
@endif
</body>
</html>
