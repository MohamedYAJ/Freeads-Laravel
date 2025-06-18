@extends('layouts.app')

@section('content')

    @if (session('success'))
        <div class="max-w-md mx-auto mt-6 p-4 text-center bg-green-100 text-green-800 border border-green-400 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')

        <div class="flex flex-col max-w-md mx-auto mt-12 bg-white shadow-lg p-8 rounded-2xl space-y-6">
            <h1 class="text-2xl font-bold text-center text-gray-800">Modifier votre profil</h1>

            <input class="border border-gray-300 p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-black" 
                   type="text" name="name" placeholder="Nom" required>

            <input class="border border-gray-300 p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-black" 
                   type="email" name="email" placeholder="Email" required>

            <input class="border border-gray-300 p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-black" 
                   type="password" name="password" placeholder="Nouveau mot de passe (optionnel)">

            <button type="submit" class="w-full bg-black hover:bg-gray-800 text-white font-semibold py-3 rounded-md transition">
                Sauvegarder
            </button>
        </div>
    </form>
    
@endsection
