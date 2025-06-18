@extends('layouts.app')
@section('content') 

<div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 px-4">
    <h1 class="text-4xl font-bold mb-8 text-gray-800">Login</h1>

    <form class="w-full max-w-sm bg-white p-6 rounded-lg shadow-md space-y-5" method="POST" action="{{ route('login') }}">
        @csrf
        <input 
            class="w-full border border-gray-300 p-3 rounded focus:outline-none focus:ring-2 focus:ring-sky-500 transition" 
            type="email" 
            name="email" 
            placeholder="Email" 
            required
        >

        <input 
            class="w-full border border-gray-300 p-3 rounded focus:outline-none focus:ring-2 focus:ring-sky-500 transition" 
            type="password" 
            name="password" 
            placeholder="Password" 
            required
        >

        <input 
            class="w-full bg-black text-white py-3 rounded hover:bg-gray-800 cursor-pointer transition" 
            type="submit" 
            value="Login"
        >
    </form>

    <a 
        href="{{ route('register') }}" 
        class="mt-6 text-sm text-blue-600 hover:underline"
    >
        Pas encore de compte ? Inscrivez-vous
    </a>
</div>

@endsection
