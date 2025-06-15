@include('layouts.header', ['title' => 'Users'])

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Users</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 font-sans">
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">All Users</h1>

    @if($users->isEmpty())
        <div class="text-center text-gray-600">
            <p>No other users found.</p>
        </div>
    @else
        <ul class="space-y-4">
            @foreach($users as $user)
                <li class="bg-white shadow-md rounded-lg p-4 flex items-center justify-between">
                    <span class="text-lg font-medium">{{ $user->name }}</span>

                    @if(in_array($user->id, $friends))
                        <span class="text-green-600 font-semibold">Friends</span>
                    @elseif(in_array($user->id, $sentRequests))
                        <span class="text-yellow-500 font-medium">Request Sent</span>
                    @elseif(in_array($user->id, $receivedRequests))
                        <form action="/friend-accept/{{ $user->id }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-1 px-3 rounded">
                                Accept Request
                            </button>
                        </form>
                    @else
                        <form action="/friend-request/{{ $user->id }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-3 rounded">
                                Add Friend
                            </button>
                        </form>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</div>
</body>
</html>
