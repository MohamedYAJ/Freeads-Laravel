<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FreeAds</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    @php
        $routeName = Route::currentRouteName();
        $excludedRoutes = ['login', 'register', 'index'];
    @endphp

    @if(Auth::check() && !in_array($routeName, $excludedRoutes))
        <nav class="bg-black shadow-md">
            <div class="container mx-auto px-4 py-4 flex flex-col md:flex-row justify-between items-center">
                <h1 class="text-4xl font-bold text-white tracking-wide">FreeAds</h1>
                <ul class="flex gap-6 mt-4 md:mt-0 items-center">
                    <li>
                        <a class="text-white hover:text-gray-300 transition duration-200" href="{{ route('annonce') }}">
                            Home
                        </a>
                    </li>
                    <li>
                        <a class="text-white hover:text-gray-300 transition duration-200" href="{{ route('DisplayAds') }}">
                            Ads
                        </a>
                    </li>
                    <li>
                        <a class="text-white hover:text-gray-300 transition duration-200" href="{{ route('profile.edit') }}">
                            {{ Auth::user()->name }}
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-white hover:text-red-400 transition duration-200 focus:outline-none">
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    @endif

    <main class="py-8">
        @yield('content')
    </main>
</body>
</html>
