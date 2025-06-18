@extends('layouts.app')

@section('content')

<div class="min-h-screen flex flex-col justify-center items-center bg-gray-100 px-4">
    <div class="flex justify-end w-full max-w-6xl mb-10 gap-4">
        <a href="{{ route('login') }}">
            <button class="bg-black text-white px-6 py-2 rounded-lg shadow hover:bg-gray-800 transition duration-200">
                Login
            </button>
        </a>
        <a href="{{ route('register') }}">
            <button class="bg-black text-white px-6 py-2 rounded-lg shadow hover:bg-gray-800 transition duration-200">
                Register
            </button>
        </a>
    </div>

    <p class="text-4xl font-extrabold text-gray-900 text-center drop-shadow-md">
        Welcome to FreeAds
    </p>
</div>

@endsection
