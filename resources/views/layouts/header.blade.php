<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'My Laravel App' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#C0D51E]">
<header class="bg-[#57B404] text-white p-5 mx-auto w-1/2 mt-20 rounded-3xl">
    <div class="container flex items-center space-x-6 ">
        <img src="loo.png" alt="" class="w-40">
        <a href="/">
            <h1 class="text-outline text-3xl font-bold">Home</h1>
        </a>
        <a href="/">
            <h1 class="text-outline text-3xl font-bold">Spelen</h1>
        </a>
        @if(auth()->check())
            <a href="{{ route('dashboard') }}">
                <h1 class="text-outline text-3xl font-bold">Mijn Account</h1>
            </a>
            <a href="{{ url('/users') }}">
                <h1 class="text-outline text-3xl font-bold">Mijn Vrienden</h1>
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')"
                                       onclick="event.preventDefault();
                                        this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>

        @else
            <a href="{{ route('login') }}">
                <h1 class="text-outline text-3xl font-bold">Log in</h1>
            </a>
            <a href="{{ route('register') }}">
                <h1 class="text-outline text-3xl font-bold">Register</h1>
            </a>
        @endif




    </div>
    <style>
        @layer utilities {
            .text-outline {
                -webkit-text-stroke: 2px #003b1f;
                color: #FECB08;
            }
        }

    </style>
</header>
